@extends('layouts.kiosk')

@section('title', 'Check-In — Rumah Sakit Azra')

@section('content')
    <div class="py-4">
        <x-kiosk-back :href="route('home')" />
    </div>

    <header class="px-2 pb-5 pt-1 text-center">
        <h1 class="text-[clamp(26px,3vw,38px)] font-bold leading-snug text-azra-navy">Check-In Pendaftaran</h1>
        <p class="mt-2 text-[clamp(15px,1.5vw,18px)] font-medium text-azra-muted">Ketuk kolom di bawah, ketik kode booking, lalu tekan <strong class="text-azra-teal">Enter</strong></p>
    </header>

    <main class="flex flex-1 flex-col pb-10">
        <form method="POST" action="{{ route('kiosk.checkin.store') }}" class="mx-auto w-full max-w-[680px] rounded-[22px] border border-azra-line bg-white/90 p-6 shadow-[0_18px_36px_-18px_rgba(31,43,77,0.45)] backdrop-blur portrait:p-7 sm:p-7">
            @csrf

            <label for="kode_booking" class="mb-2 block text-[17px] font-bold text-azra-navy">Kode Booking</label>
            <input id="kode_booking" name="kode_booking" type="text" autocomplete="off" maxlength="50" placeholder="Ketuk untuk mengetik…"
                value="{{ old('kode_booking', $kode) }}" data-keyboard
                class="h-[72px] w-full rounded-2xl border-2 bg-[#f7f9fb] px-5 text-center text-[26px] font-bold uppercase tracking-[0.12em] text-azra-navy placeholder:normal-case placeholder:font-medium placeholder:tracking-normal placeholder:text-azra-muted/40 focus:border-azra-teal focus:outline-none {{ $errors->has('kode_booking') ? 'border-red-400' : 'border-azra-line' }}">
            @error('kode_booking')
                <p class="mt-2 text-center text-[14.5px] font-semibold text-[#c81e1e]">{{ $message }}</p>
            @enderror

            <x-kiosk-btn type="submit" variant="checkin" wide class="mt-6">
                Verifikasi Kode
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5.5 15.5 12 9 18.5" /></svg>
            </x-kiosk-btn>
        </form>
    </main>

    <x-virtual-keyboard />
@endsection
