<?php

namespace App\Http\Controllers\Kiosk;

use App\Http\Controllers\Controller;
use App\Services\TeraService;
use DateTimeImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DaftarController extends Controller
{
    /**
     * Halaman "Pilih Status Pasien Anda".
     */
    public function status(): View
    {
        return view('kiosk.daftar-status');
    }

    /**
     * Informasi untuk pasien baru (diarahkan ke loket).
     */
    public function baru(): View
    {
        return view('kiosk.daftar-baru');
    }

    /**
     * Form otentikasi pasien terdaftar (NIK + tanggal lahir + PIN pad).
     */
    public function authForm(): View
    {
        return view('kiosk.daftar-auth');
    }

    /**
     * Verifikasi NIK + tanggal lahir ke TERA lalu tampilkan jadwal.
     */
    public function authenticate(Request $request, TeraService $tera): View|RedirectResponse
    {
        $data = $request->validate([
            'nik' => ['required', 'digits:16'],
            'birthdate' => ['required', 'digits:8'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'birthdate.required' => 'Tanggal lahir wajib diisi.',
            'birthdate.digits' => 'Tanggal lahir harus 8 digit (DDMMYYYY).',
        ]);

        /** @var string $nik */
        $nik = $data['nik'];
        /** @var string $raw */
        $raw = $data['birthdate'];

        $day = (int) substr($raw, 0, 2);
        $month = (int) substr($raw, 2, 2);
        $year = (int) substr($raw, 4, 4);

        if (! checkdate($month, $day, $year)) {
            return back()->withInput()->withErrors(['birthdate' => 'Tanggal lahir tidak valid.']);
        }

        $date = new DateTimeImmutable(sprintf('%04d-%02d-%02d', $year, $month, $day));
        $sentBirthdate = $date->format((string) config('tera.birthdate_format', 'Y-m-d'));
        $displayBirthdate = $date->format('d-m-Y');

        try {
            $appointments = $tera->listAppointments($nik, $sentBirthdate);
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('tera_error', $e->getMessage());
        }

        return view('kiosk.daftar-hasil', [
            'nik' => $nik,
            'birthdateDisplay' => $displayBirthdate,
            'appointments' => $appointments,
        ]);
    }
}
