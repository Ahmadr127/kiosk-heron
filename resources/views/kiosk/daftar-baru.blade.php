@extends('layouts.kiosk')

@section('title', 'Pasien Baru — Rumah Sakit Azra')

@section('content')
    <div class="py-4">
        <x-kiosk-back :href="route('kiosk.daftar.status')" />
    </div>

    <main class="flex flex-1 flex-col items-center justify-center pb-10">
        <div class="w-full max-w-[640px] rounded-[22px] border border-azra-line bg-white/90 p-8 text-center shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur portrait:p-10">
            <span class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-azra-teal/10 text-azra-teal" aria-hidden="true">
                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9" /><path d="M12 8v5M12 16.5v.01" /></svg>
            </span>
            <h1 class="mt-5 text-[clamp(24px,2.8vw,32px)] font-bold text-azra-navy">Pendaftaran Pasien Baru</h1>
            <p class="mx-auto mt-3 max-w-[42ch] text-[clamp(15px,1.5vw,18px)] font-medium leading-relaxed text-azra-muted">
                Untuk pasien baru, silakan menuju <strong class="text-azra-navy">loket pendaftaran</strong> dengan membawa KTP / Kartu Keluarga agar data Anda tercatat dengan benar.
            </p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <x-kiosk-btn :href="route('home')" variant="primary">Selesai</x-kiosk-btn>
            </div>
        </div>
    </main>
@endsection
