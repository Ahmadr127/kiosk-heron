@extends('layouts.kiosk')

@section('title', 'Pilih Status Pasien — Rumah Sakit Azra')

@section('content')
    <div class="py-3">
        <x-kiosk-back :href="route('home')" />
    </div>

    <header class="px-2 pb-4 pt-1 text-center">
        <h1 class="text-[clamp(19px,4.8vw,30px)] font-bold leading-tight text-azra-navy">Pilih Status Pasien Anda</h1>
        <p class="mt-1 text-[clamp(13px,3.2vw,16px)] font-medium text-azra-muted">Silakan pilih salah satu tombol di bawah ini</p>
    </header>

    <main class="flex flex-1 flex-col pb-8">
        <div class="grid grid-cols-1 gap-3 sm:gap-4 landscape:lg:grid-cols-2 landscape:lg:gap-5">

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-2xl bg-azra-teal p-4 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-5 sm:pr-3 lg:min-h-[150px] lg:p-6" href="{{ route('kiosk.daftar.auth') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(19px,4.8vw,28px)] font-bold leading-[1.15]">Pasien Terdaftar</h2>
                    <p class="mt-1 max-w-[26ch] text-[clamp(13px,3.2vw,15px)] font-medium leading-relaxed text-white/90">Sudah punya NIK / nomor rekam medis</p>
                    <span class="mt-2 flex h-9 w-9 items-center justify-center rounded-full bg-white/25" aria-hidden="true">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[36%] max-w-[170px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[100px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.25)] sm:max-h-[120px] lg:max-h-[140px]" src="{{ asset('images/ilustrasi/Person%20with%20a%20cold-pana.png') }}" alt="" loading="eager">
                </span>
            </a>

            <a class="group flex items-stretch gap-1 overflow-hidden rounded-2xl bg-azra-navy p-4 pr-3 text-white no-underline transition duration-150 ease-out hover:-translate-y-1 hover:shadow-[0_20px_32px_-14px_rgba(31,43,77,0.45)] active:translate-y-0 active:scale-[0.998] focus-visible:outline-[3px] focus-visible:outline-offset-4 focus-visible:outline-azra-navy sm:p-5 sm:pr-3 lg:min-h-[150px] lg:p-6" href="{{ route('kiosk.daftar.baru') }}">
                <span class="flex min-w-0 flex-1 flex-col justify-center">
                    <h2 class="text-[clamp(19px,4.8vw,28px)] font-bold leading-[1.15]">Pasien Baru</h2>
                    <p class="mt-1 max-w-[26ch] text-[clamp(13px,3.2vw,15px)] font-medium leading-relaxed text-white/90">Belum pernah berobat di RS Azra</p>
                    <span class="mt-2 flex h-9 w-9 items-center justify-center rounded-full bg-white/25" aria-hidden="true">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                    </span>
                </span>
                <span class="flex w-[36%] max-w-[170px] flex-none items-center justify-center" aria-hidden="true">
                    <img class="block h-auto max-h-[100px] w-full object-contain drop-shadow-[0_10px_14px_rgba(0,0,0,0.25)] sm:max-h-[120px] lg:max-h-[140px]" src="{{ asset('images/ilustrasi/Gynecology%20consultation-amico%20(1).png') }}" alt="" loading="eager">
                </span>
            </a>

        </div>
    </main>
@endsection
