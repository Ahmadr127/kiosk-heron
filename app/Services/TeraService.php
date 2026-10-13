<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Klien webservice TERA Mobile (RS Azra).
 *
 * Alur: login multipart (username + password) -> token di-cache ->
 * dipakai sebagai Bearer untuk endpoint seperti listappointment.
 * Bentuk respons dibuat toleran (beberapa varian nama field) karena
 * tidak ada dokumentasi publik; respons mentah dicatat di log
 * (tanpa password) untuk diagnosis.
 */
class TeraService
{
    public function baseUrl(): string
    {
        return rtrim((string) config('tera.base_url'), '/');
    }

    /**
     * Ambil token login (dari cache bila masih ada).
     *
     * @throws \RuntimeException bila login gagal
     */
    public function token(): string
    {
        $cached = Cache::get('tera_api_token');
        if (is_string($cached) && $cached !== '') {
            return $cached;
        }

        return $this->login();
    }

    public function forgetToken(): void
    {
        Cache::forget('tera_api_token');
    }

    /**
     * Login ulang ke TERA dan simpan token ke cache.
     *
     * @throws \RuntimeException bila login gagal
     */
    public function login(): string
    {
        try {
            $response = Http::timeout((int) config('tera.timeout', 15))
                ->asMultipart()
                ->post($this->baseUrl().'/login', [
                    'username' => (string) config('tera.username'),
                    'password' => (string) config('tera.password'),
                ]);
        } catch (\Throwable $e) {
            Log::error('TERA login gagal (koneksi)', ['error' => $e->getMessage()]);
            throw new \RuntimeException('Tidak dapat menghubungi server TERA.');
        }

        if (! $response->successful()) {
            Log::warning('TERA login ditolak', ['status' => $response->status()]);
            throw new \RuntimeException('Login TERA ditolak (HTTP '.$response->status().').');
        }

        $token = $this->extractToken($response->json());
        if ($token === null) {
            Log::warning('TERA login tanpa token', ['body' => $this->safeBody($response)]);
            throw new \RuntimeException('Respons login TERA tidak berisi token.');
        }

        Cache::put('tera_api_token', $token, (int) config('tera.token_ttl', 3300));

        return $token;
    }

    /**
     * Ambil daftar appointment pasien (mrid = NIK).
     *
     * @return array<int, mixed>
     *
     * @throws \RuntimeException bila gagal
     */
    public function listAppointments(string $mrid, string $birthdate): array
    {
        $result = $this->fetchAppointments($this->token(), $mrid, $birthdate);

        if ($result['unauthorized']) {
            // Token basi: login ulang sekali lalu coba lagi.
            $this->forgetToken();
            $result = $this->fetchAppointments($this->token(), $mrid, $birthdate);
        }

        if (! $result['ok']) {
            throw new \RuntimeException($result['message']);
        }

        return $result['items'];
    }

    /**
     * @return array{ok: bool, unauthorized: bool, message: string, items: array<int, mixed>}
     */
    private function fetchAppointments(string $token, string $mrid, string $birthdate): array
    {
        try {
            $response = Http::timeout((int) config('tera.timeout', 15))
                ->acceptJson()
                ->withToken($token)
                ->get($this->baseUrl().'/listappointment', [
                    'mrid' => $mrid,
                    'birthdate' => $birthdate,
                ]);
        } catch (\Throwable $e) {
            Log::error('TERA listappointment gagal (koneksi)', ['error' => $e->getMessage()]);

            return ['ok' => false, 'unauthorized' => false, 'message' => 'Tidak dapat menghubungi server TERA.', 'items' => []];
        }

        if ($response->status() === 401) {
            return ['ok' => false, 'unauthorized' => true, 'message' => 'Sesi TERA kedaluwarsa.', 'items' => []];
        }

        if (! $response->successful()) {
            Log::warning('TERA listappointment gagal', ['status' => $response->status(), 'body' => $this->safeBody($response)]);

            return ['ok' => false, 'unauthorized' => false, 'message' => 'Gagal mengambil jadwal (HTTP '.$response->status().').', 'items' => []];
        }

        return ['ok' => true, 'unauthorized' => false, 'message' => '', 'items' => $this->extractItems($response->json())];
    }

    /**
     * Cari token dari beberapa varian bentuk respons login.
     */
    private function extractToken(mixed $json): ?string
    {
        if (! is_array($json)) {
            return null;
        }

        foreach (['token', 'access_token', 'accessToken', 'jwt', 'id_token'] as $key) {
            if (isset($json[$key]) && is_string($json[$key]) && $json[$key] !== '') {
                return $json[$key];
            }
        }

        foreach (['data', 'result', 'payload'] as $wrap) {
            if (isset($json[$wrap]) && is_array($json[$wrap])) {
                $found = $this->extractToken($json[$wrap]);
                if ($found !== null) {
                    return $found;
                }
            }
        }

        return null;
    }

    /**
     * @return array<int, mixed>
     */
    private function extractItems(mixed $json): array
    {
        if (is_array($json) && array_is_list($json)) {
            return $json;
        }

        if (! is_array($json)) {
            return [];
        }

        foreach (['data', 'result', 'appointments', 'items', 'payload'] as $key) {
            if (! isset($json[$key]) || ! is_array($json[$key])) {
                continue;
            }
            $value = $json[$key];
            if (array_is_list($value)) {
                return $value;
            }
            if ($this->looksLikeAppointment($value)) {
                return [$value];
            }
        }

        if ($this->looksLikeAppointment($json)) {
            return [$json];
        }

        return [];
    }

    /**
     * @param  array<mixed>  $row
     */
    private function looksLikeAppointment(array $row): bool
    {
        $keys = array_map('strval', array_keys($row));
        $known = ['nama', 'name', 'patient', 'pasien', 'tanggal', 'date', 'dokter', 'doctor', 'poli', 'booking', 'kode', 'code', 'mrid', 'nik', 'jam', 'time', 'jadwal', 'schedule'];

        foreach ($keys as $key) {
            foreach ($known as $needle) {
                if (stripos($key, $needle) !== false) {
                    return true;
                }
            }
        }

        return false;
    }

    private function safeBody(Response $response): string
    {
        return mb_substr((string) $response->body(), 0, 2000);
    }
}
