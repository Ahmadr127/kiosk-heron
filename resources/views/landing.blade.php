@extends('layouts.kiosk')

@section('content')
    {{-- Sambutan: logo + judul, rata kiri, skala adaptif --}}
    <header class="flex items-center gap-3 px-2 py-4 sm:gap-4 sm:py-5">
        <img class="block h-14 w-auto max-w-[36vw] flex-none object-contain sm:h-16 sm:max-w-none portrait:sm:h-[72px] lg:h-[84px]" src="{{ asset('images/logo.png') }}" alt="Logo Rumah Sakit Azra">
        <div class="min-w-0">
            <h1 class="text-[clamp(20px,5.2vw,34px)] font-bold leading-tight text-azra-navy">Selamat Datang di Rumah Sakit Azra</h1>
            <p class="mt-1 text-[clamp(13px,3.4vw,17px)] font-medium text-azra-muted">Bagaimana kami bisa membantu Anda hari ini?</p>
        </div>
    </header>

    {{-- Pembatas: garis + badge pill ringkas --}}
    <div class="flex items-center gap-3 px-2 pb-4 sm:pb-5" aria-hidden="true">
        <span class="h-[2px] flex-1 rounded-full bg-gradient-to-r from-transparent via-azra-line to-azra-line"></span>
        <span class="rounded-full bg-azra-navy px-5 py-1.5 text-[12px] font-bold uppercase tracking-[0.16em] text-white shadow-[0_8px_16px_-8px_rgba(31,43,77,0.6)]">Pilih Layanan</span>
        <span class="h-[2px] flex-1 rounded-full bg-gradient-to-l from-transparent via-azra-line to-azra-line"></span>
    </div>

    <main class="flex flex-1 flex-col py-2 sm:py-3">
        {{-- 1 kolom (mobile/portrait) · 2 kolom (landscape ≥1024px, seperti desain desktop) --}}
        <div class="grid grid-cols-1 gap-3 sm:gap-4 landscape:lg:grid-cols-2 landscape:lg:gap-[22px]">

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-[18px] bg-card-antrian p-5 pr-3 text-[#1e2a44] no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-6 sm:pr-4 lg:min-h-[190px] lg:p-7" id="menu-antrian" data-menu="antrian" href="{{ route('dashboard') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(22px,5.5vw,34px)] font-bold leading-[1.15]">Antrian</h2>
                    <p class="mt-1.5 max-w-[26ch] text-[clamp(13.5px,3.4vw,16px)] font-medium leading-relaxed text-[#1e2a44]/80">Ambil nomor antrean Anda di sini</p>
                    <span class="mt-3 flex h-10 w-10 items-center justify-center rounded-full bg-[#1e2a44]/10 sm:h-10 sm:w-10" aria-hidden="true">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[42%] max-w-[200px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[130px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.18)] sm:max-h-[160px] lg:max-h-[190px]" src="{{ asset('images/ilustrasi/Waiting-bro.png') }}" alt="" loading="eager">
                </span>
            </a>

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-[18px] bg-card-daftar p-5 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-6 sm:pr-4 lg:min-h-[190px] lg:p-7" id="menu-daftar" data-menu="daftar" href="{{ route('kiosk.daftar.status') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(22px,5.5vw,34px)] font-bold leading-[1.15]">Daftar Hari Ini</h2>
                    <p class="mt-1.5 max-w-[26ch] text-[clamp(13.5px,3.4vw,16px)] font-medium leading-relaxed text-white/90">Pendaftaran langsung untuk hari ini</p>
                    <span class="mt-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/25 sm:h-10 sm:w-10" aria-hidden="true">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[42%] max-w-[200px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[130px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.18)] sm:max-h-[160px] lg:max-h-[190px]" src="{{ asset('images/ilustrasi/Fill out-rafiki.png') }}" alt="" loading="eager">
                </span>
            </a>

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-[18px] bg-card-checkin p-5 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-6 sm:pr-4 lg:min-h-[190px] lg:p-7" id="menu-checkin" data-menu="checkin" href="{{ route('kiosk.checkin.index') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(22px,5.5vw,34px)] font-bold leading-[1.15]">Check-In</h2>
                    <p class="mt-1.5 max-w-[26ch] text-[clamp(13.5px,3.4vw,16px)] font-medium leading-relaxed text-white/90">Verifikasi pendaftaran Anda</p>
                    <span class="mt-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/25 sm:h-10 sm:w-10" aria-hidden="true">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[42%] max-w-[200px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[130px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.18)] sm:max-h-[160px] lg:max-h-[190px]" src="{{ asset('images/ilustrasi/Hospital wheelchair-amico.png') }}" alt="" loading="eager">
                </span>
            </a>

            {{-- Sel kosong kanan kartu Check-In pada landscape, mengikuti komposisi referensi --}}
            <div class="hidden min-h-[1px] landscape:lg:block" aria-hidden="true"></div>

        </div>
    </main>
@endsection
