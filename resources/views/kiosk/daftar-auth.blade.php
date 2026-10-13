@extends('layouts.kiosk')

@section('title', 'Otentikasi Pasien — Rumah Sakit Azra')

@section('content')
    @php
        $oldBirthdate = preg_replace('/\D/', '', (string) old('birthdate', ''));
        $birthdateDisplay = $oldBirthdate !== ''
            ? substr($oldBirthdate, 0, 2).($oldBirthdate !== '' && strlen($oldBirthdate) > 2 ? '-'.substr($oldBirthdate, 2, 2) : '').(strlen($oldBirthdate) > 4 ? '-'.substr($oldBirthdate, 4, 4) : '')
            : '';
    @endphp

    <div class="py-4">
        <x-kiosk-back :href="route('kiosk.daftar.status')" />
    </div>

    <header class="px-2 pb-5 pt-1 text-center">
        <h1 class="text-[clamp(26px,3vw,38px)] font-bold leading-snug text-azra-navy">Otentikasi Pasien</h1>
        <p class="mt-2 text-[clamp(15px,1.5vw,18px)] font-medium text-azra-muted">Masukkan NIK dan tanggal lahir, lalu tekan <strong class="text-azra-teal">Enter</strong></p>
    </header>

    @if (session('tera_error'))
        <div class="mx-auto mb-5 flex w-full max-w-[860px] items-start gap-3 rounded-2xl border border-red-200 bg-[#fff1f0] px-5 py-4 text-[15.5px] font-medium text-[#8f1d1d]" role="alert">
            <svg class="mt-0.5 h-6 w-6 flex-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="M12 8v5M12 16.5v.01" /></svg>
            <span>{{ session('tera_error') }} Silakan coba lagi atau hubungi petugas.</span>
        </div>
    @endif

    <main class="flex flex-1 flex-col pb-10">
        <form method="POST" action="{{ route('kiosk.daftar.authenticate') }}" class="mx-auto grid w-full max-w-[860px] grid-cols-1 gap-5 landscape:lg:grid-cols-[1fr_340px]" novalidate>
            @csrf

            <div class="rounded-[22px] border border-azra-line bg-white/90 p-6 shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur portrait:p-7 sm:p-7">
                <div>
                    <label for="nik" class="mb-2 block text-[17px] font-bold text-azra-navy">NIK <span class="font-medium text-azra-muted">(16 digit)</span></label>
                    <input id="nik" name="nik" type="text" inputmode="numeric" autocomplete="off" maxlength="16" placeholder="3578xxxxxxxxxxxx"
                        value="{{ old('nik') }}" data-pin-input data-pin-maxlength="16"
                        class="h-[68px] w-full rounded-2xl border-2 bg-[#f7f9fb] px-5 text-[24px] font-semibold tabular-nums tracking-[0.08em] text-azra-navy placeholder:text-azra-muted/40 focus:border-azra-teal focus:outline-none {{ $errors->has('nik') ? 'border-red-400' : 'border-azra-line' }}">
                    @error('nik')
                        <p class="mt-2 text-[14.5px] font-semibold text-[#c81e1e]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="birthdate" class="mb-2 block text-[17px] font-bold text-azra-navy">Tanggal Lahir <span class="font-medium text-azra-muted">(DD-MM-YYYY)</span></label>
                    <input id="birthdate" name="birthdate" type="text" inputmode="numeric" autocomplete="off" maxlength="10" placeholder="17-08-1990"
                        value="{{ $birthdateDisplay }}" data-pin-input data-pin-format="date" data-pin-maxlength="8"
                        class="h-[68px] w-full rounded-2xl border-2 bg-[#f7f9fb] px-5 text-[24px] font-semibold tabular-nums tracking-[0.08em] text-azra-navy placeholder:text-azra-muted/40 focus:border-azra-teal focus:outline-none {{ $errors->has('birthdate') ? 'border-red-400' : 'border-azra-line' }}">
                    @error('birthdate')
                        <p class="mt-2 text-[14.5px] font-semibold text-[#c81e1e]">{{ $message }}</p>
                    @enderror
                </div>

                <x-kiosk-btn type="submit" variant="primary" wide class="mt-6">
                    Cari Jadwal Saya
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
                </x-kiosk-btn>
            </div>

            <x-pin-pad />
        </form>
    </main>
@endsection
