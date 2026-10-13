@extends('layouts.kiosk')

@section('title', 'Jadwal Pasien — Rumah Sakit Azra')

@section('content')
    @php
        $pick = function ($item, array $keys, $default = '-') {
            if (! is_array($item)) return $default;
            $lower = [];
            foreach ($item as $k => $v) { $lower[strtolower((string) $k)] = $v; }
            foreach ($keys as $k) {
                $lk = strtolower($k);
                if (array_key_exists($lk, $lower) && $lower[$lk] !== null && $lower[$lk] !== '') {
                    $v = $lower[$lk];
                    return is_scalar($v) ? (string) $v : json_encode($v);
                }
            }
            return $default;
        };
        $maskedNik = strlen($nik) === 16 ? substr($nik, 0, 4).str_repeat('*', 10).substr($nik, 14, 2) : $nik;
    @endphp

    <div class="flex flex-wrap items-center justify-between gap-3 py-4">
        <x-kiosk-back :href="route('kiosk.daftar.auth')" label="Ulangi" />
        <x-kiosk-btn :href="route('home')" variant="ghost" size="sm">Beranda</x-kiosk-btn>
    </div>

    <header class="px-2 pb-5 pt-1 text-center">
        <h1 class="text-[clamp(26px,3vw,38px)] font-bold leading-snug text-azra-navy">
            {{ count($appointments) > 0 ? 'Jadwal Ditemukan' : 'Jadwal Tidak Ditemukan' }}
        </h1>
        <p class="mt-2 text-[clamp(15px,1.5vw,18px)] font-medium tabular-nums text-azra-muted">NIK {{ $maskedNik }} · Lahir {{ $birthdateDisplay }}</p>
    </header>

    <main class="flex flex-1 flex-col gap-4 pb-10">
        @forelse ($appointments as $item)
            @php
                $nama = $pick($item, ['patient_name', 'nama_pasien', 'nama', 'name', 'pasien']);
                $tanggal = $pick($item, ['appointment_date', 'tanggal', 'visit_date', 'tgl', 'date', 'jadwal']);
                $jam = $pick($item, ['jam', 'time', 'appointment_time', 'pukul']);
                $dokter = $pick($item, ['doctor_name', 'nama_dokter', 'dokter', 'doctor']);
                $poli = $pick($item, ['poli', 'unit', 'department', 'departemen', 'klinik', 'layanan']);
                $kode = $pick($item, ['booking_code', 'kode_booking', 'bookingcode', 'kode', 'code', 'no_booking'], '');
            @endphp
            <article class="rounded-[22px] border border-azra-line bg-white/90 p-6 shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur sm:p-7">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="min-w-0">
                        <h2 class="text-[clamp(20px,2.2vw,26px)] font-bold text-azra-navy">{{ $nama }}</h2>
                        <div class="mt-3 grid grid-cols-1 gap-x-8 gap-y-2 text-[16px] font-medium text-azra-ink sm:grid-cols-2">
                            <p><span class="font-bold text-azra-muted">Tanggal:</span> <span class="tabular-nums">{{ $tanggal }}</span></p>
                            <p><span class="font-bold text-azra-muted">Jam:</span> <span class="tabular-nums">{{ $jam }}</span></p>
                            <p><span class="font-bold text-azra-muted">Dokter:</span> {{ $dokter }}</p>
                            <p><span class="font-bold text-azra-muted">Poli/Unit:</span> {{ $poli }}</p>
                            @if ($kode !== '')
                                <p><span class="font-bold text-azra-muted">Kode Booking:</span> <span class="font-bold tabular-nums text-azra-teal">{{ $kode }}</span></p>
                            @endif
                        </div>
                    </div>
                    <x-kiosk-btn :href="$kode !== '' ? route('kiosk.checkin.index', ['kode' => $kode]) : route('kiosk.checkin.index')" variant="teal" class="self-center">
                        Checkin
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </x-kiosk-btn>
                </div>
                @if (is_array($item))
                    <details class="mt-4 rounded-xl bg-[#f4f6f9] px-4 py-3 text-[14px] text-azra-muted">
                        <summary class="cursor-pointer font-bold text-azra-navy">Detail data</summary>
                        <dl class="mt-2 grid grid-cols-1 gap-1 sm:grid-cols-2">
                            @foreach ($item as $k => $v)
                                @if (is_scalar($v) && $v !== null && $v !== '')
                                    <div class="flex gap-2"><dt class="font-semibold">{{ ucwords(str_replace('_', ' ', (string) $k)) }}:</dt><dd class="tabular-nums">{{ (string) $v }}</dd></div>
                                @endif
                            @endforeach
                        </dl>
                    </details>
                @endif
            </article>
        @empty
            <div class="mx-auto w-full max-w-[640px] rounded-[22px] border border-azra-line bg-white/90 p-8 text-center shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur">
                <img class="mx-auto block h-[150px] w-auto object-contain portrait:h-[175px]" src="{{ asset('images/ilustrasi/Thinking%20face-rafiki.png') }}" alt="" loading="lazy">
                <h2 class="mt-5 text-[clamp(20px,2.4vw,26px)] font-bold text-azra-navy">Tidak ada jadwal hari ini</h2>
                <p class="mx-auto mt-3 max-w-[44ch] text-[15.5px] font-medium leading-relaxed text-azra-muted">Periksa kembali NIK dan tanggal lahir, atau hubungi petugas bila Anda yakin sudah terdaftar.</p>
            </div>
        @endforelse
    </main>
@endsection
