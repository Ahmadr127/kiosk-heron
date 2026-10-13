@extends('layouts.kiosk')

@section('title', 'Antrian — Rumah Sakit Azra')

@section('content')
    <div class="py-3">
        <x-kiosk-back :href="route('home')" />
    </div>

    <main class="flex flex-1 flex-col items-center justify-center pb-10">
        <div class="w-full max-w-[640px] rounded-[22px] border border-azra-line bg-white/90 p-8 text-center shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur portrait:p-10">
            <img class="mx-auto block h-[150px] w-auto object-contain portrait:h-[175px]" src="{{ asset('images/ilustrasi/Waiting-bro.png') }}" alt="" loading="lazy">
            <h1 class="mt-5 text-[clamp(22px,2.8vw,30px)] font-bold text-azra-navy">Layanan Antrian Segera Hadir</h1>
            <p class="mx-auto mt-3 max-w-[42ch] text-[clamp(13.5px,1.5vw,16px)] font-medium leading-relaxed text-azra-muted">
                Pengambilan nomor antrean dari kiosk sedang disiapkan. Untuk saat ini silakan gunakan layanan <strong class="text-azra-navy">Daftar Hari Ini</strong> atau <strong class="text-azra-navy">Check-In</strong>, atau hubungi petugas.
            </p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <x-kiosk-btn :href="route('home')" variant="primary">Selesai</x-kiosk-btn>
            </div>
        </div>
    </main>
@endsection
