@extends('layouts.kiosk')

@section('title', 'Pilih Status Pasien — Rumah Sakit Azra')

@section('content')
    <div class="py-3 sm:py-4">
        <x-kiosk-back :href="route('home')" />
    </div>

    <header class="px-2 pb-4 pt-1 text-center sm:pb-6">
        <h1 class="text-[clamp(22px,5.5vw,38px)] font-bold leading-tight text-azra-navy">Pilih Status Pasien Anda</h1>
        <p class="mt-1.5 text-[clamp(13.5px,3.6vw,18px)] font-medium text-azra-muted">Silakan pilih salah satu tombol di bawah ini</p>
    </header>

    <main class="flex flex-1 flex-col pb-8">
        <div class="grid grid-cols-1 gap-3 sm:gap-4 landscape:lg:grid-cols-2 landscape:lg:gap-[22px]">

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-[18px] bg-azra-teal p-5 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-6 sm:pr-4 lg:min-h-[190px] lg:p-7" href="{{ route('kiosk.daftar.auth') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(22px,5.5vw,34px)] font-bold leading-[1.15]">Pasien Terdaftar</h2>
                    <p class="mt-1.5 max-w-[26ch] text-[clamp(13.5px,3.4vw,16px)] font-medium leading-relaxed text-white/90">Sudah punya NIK / nomor rekam medis</p>
                    <span class="mt-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/25 sm:h-10 sm:w-10" aria-hidden="true">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[42%] max-w-[200px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[130px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.25)] sm:max-h-[160px] lg:max-h-[190px]" src="{{ asset('images/ilustrasi/Person%20with%20a%20cold-pana.png') }}" alt="" loading="eager">
                </span>
            </a>

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-[18px] bg-azra-navy p-5 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-6 sm:pr-4 lg:min-h-[190px] lg:p-7" href="{{ route('kiosk.daftar.baru') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(22px,5.5vw,34px)] font-bold leading-[1.15]">Pasien Baru</h2>
                    <p class="mt-1.5 max-w-[26ch] text-[clamp(13.5px,3.4vw,16px)] font-medium leading-relaxed text-white/90">Belum pernah berobat di RS Azra</p>
                    <span class="mt-3 flex h-10 w-10 items-center justify-center rounded-full bg-white/25 sm:h-10 sm:w-10" aria-hidden="true">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[42%] max-w-[200px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[130px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.25)] sm:max-h-[160px] lg:max-h-[190px]" src="{{ asset('images/ilustrasi/Gynecology%20consultation-amico%20(1).png') }}" alt="" loading="eager">
                </span>
            </a>

        </div>
    </main>
@endsection
