@extends('layouts.kiosk')

@section('title', 'Check-In Diterima — Rumah Sakit Azra')

@section('content')
    <div class="py-4">
        <x-kiosk-back :href="route('home')" label="Selesai" />
    </div>

    <main class="flex flex-1 flex-col items-center justify-center pb-10">
        <div class="w-full max-w-[640px] rounded-[22px] border border-azra-line bg-white/90 p-8 text-center shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur portrait:p-10">
            <span class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-azra-teal/10 text-azra-teal" aria-hidden="true">
                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m4.5 12.5 5 5 10-11" /></svg>
            </span>
            <h1 class="mt-5 text-[clamp(24px,2.8vw,32px)] font-bold text-azra-navy">Kode Booking Diterima</h1>
            <p class="mx-auto mt-4 inline-block rounded-2xl bg-[#f4f6f9] px-8 py-4 text-[clamp(26px,3.4vw,38px)] font-bold uppercase tabular-nums tracking-[0.12em] text-azra-navy">{{ $kode }}</p>
            <p class="mx-auto mt-4 max-w-[44ch] text-[clamp(15px,1.5vw,18px)] font-medium leading-relaxed text-azra-muted">
                Silakan menunggu dan perhatikan panggilan nomor antrean Anda. Bila ada kendala, hubungi petugas.
            </p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <x-kiosk-btn :href="route('kiosk.checkin.index')" variant="secondary">Kode Lain</x-kiosk-btn>
                <x-kiosk-btn :href="route('home')" variant="primary">Selesai</x-kiosk-btn>
            </div>
        </div>
    </main>
@endsection
