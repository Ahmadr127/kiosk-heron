@extends('layouts.kiosk')

@section('content')
    {{-- Sambutan: logo + judul, rata kiri, skala ringkas --}}
    <header class="flex items-center gap-3 px-2 py-3 sm:py-4">
        <img class="block h-12 w-auto max-w-[36vw] flex-none object-contain sm:h-14 lg:h-16" src="{{ asset('images/logo.png') }}" alt="Logo Rumah Sakit Azra">
        <div class="min-w-0">
            <h1 class="text-[clamp(18px,4.5vw,28px)] font-bold leading-tight text-azra-navy">Selamat Datang di Rumah Sakit Azra</h1>
            <p class="mt-0.5 text-[clamp(12.5px,3vw,15px)] font-medium text-azra-muted">Bagaimana kami bisa membantu Anda hari ini?</p>
        </div>
    </header>

    {{-- Pembatas: garis + badge pill ringkas --}}
    <div class="flex items-center gap-3 px-2 pb-3 sm:pb-4" aria-hidden="true">
        <span class="h-[2px] flex-1 rounded-full bg-gradient-to-r from-transparent via-azra-line to-azra-line"></span>
        <span class="rounded-full bg-azra-navy px-5 py-1.5 text-[12px] font-bold uppercase tracking-[0.16em] text-white shadow-[0_8px_16px_-8px_rgba(31,43,77,0.6)]">Pilih Layanan</span>
        <span class="h-[2px] flex-1 rounded-full bg-gradient-to-l from-transparent via-azra-line to-azra-line"></span>
    </div>

    <main class="flex flex-1 flex-col py-2">
        {{-- 1 kolom (mobile/portrait) · 2 kolom (landscape ≥1024px, seperti desain desktop) --}}
        <div class="grid grid-cols-1 gap-3 sm:gap-4 landscape:lg:grid-cols-2 landscape:lg:gap-5">

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-2xl bg-card-antrian p-4 pr-3 text-[#1e2a44] no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-5 sm:pr-3 lg:min-h-[150px] lg:p-6" id="menu-antrian" data-menu="antrian" href="{{ route('kiosk.antrian.info') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(19px,4.8vw,28px)] font-bold leading-[1.15]">Antrian</h2>
                    <p class="mt-1 max-w-[26ch] text-[clamp(13px,3.2vw,15px)] font-medium leading-relaxed text-[#1e2a44]/80">Ambil nomor antrean Anda di sini</p>
                    <span class="mt-2 flex h-9 w-9 items-center justify-center rounded-full bg-[#1e2a44]/10" aria-hidden="true">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[36%] max-w-[170px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[100px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.18)] sm:max-h-[120px] lg:max-h-[140px]" src="{{ asset('images/ilustrasi/Waiting-bro.png') }}" alt="" loading="eager">
                </span>
            </a>

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-2xl bg-card-daftar p-4 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-5 sm:pr-3 lg:min-h-[150px] lg:p-6" id="menu-daftar" data-menu="daftar" href="{{ route('kiosk.daftar.status') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(19px,4.8vw,28px)] font-bold leading-[1.15]">Daftar Hari Ini</h2>
                    <p class="mt-1 max-w-[26ch] text-[clamp(13px,3.2vw,15px)] font-medium leading-relaxed text-white/90">Pendaftaran langsung untuk hari ini</p>
                    <span class="mt-2 flex h-9 w-9 items-center justify-center rounded-full bg-white/25" aria-hidden="true">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[36%] max-w-[170px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[100px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.18)] sm:max-h-[120px] lg:max-h-[140px]" src="{{ asset('images/ilustrasi/Fill out-rafiki.png') }}" alt="" loading="eager">
                </span>
            </a>

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-2xl bg-card-checkin p-4 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-5 sm:pr-3 lg:min-h-[150px] lg:p-6" id="menu-checkin" data-menu="checkin" href="{{ route('kiosk.checkin.index') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(19px,4.8vw,28px)] font-bold leading-[1.15]">Check-In</h2>
                    <p class="mt-1 max-w-[26ch] text-[clamp(13px,3.2vw,15px)] font-medium leading-relaxed text-white/90">Verifikasi pendaftaran Anda</p>
                    <span class="mt-2 flex h-9 w-9 items-center justify-center rounded-full bg-white/25" aria-hidden="true">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[36%] max-w-[170px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[100px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.18)] sm:max-h-[120px] lg:max-h-[140px]" src="{{ asset('images/ilustrasi/Hospital wheelchair-amico.png') }}" alt="" loading="eager">
                </span>
            </a>

            {{-- Sel kosong kanan kartu Check-In pada landscape, mengikuti komposisi referensi --}}
            <div class="hidden min-h-[1px] landscape:lg:block" aria-hidden="true"></div>

        </div>
    </main>
@endsection
