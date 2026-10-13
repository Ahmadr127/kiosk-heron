<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Layanan Mandiri — Rumah Sakit Azra')</title>
    <meta name="description" content="@yield('description', 'Layanan mandiri (self-service) Rumah Sakit Azra: ambil antrean, pendaftaran langsung, dan check-in pendaftaran.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}">
    @vite(['resources/css/kiosk.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Font Poppins, non-blocking; fallback system font saat kiosk offline --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap">
    </noscript>
    @stack('styles')
</head>
<body class="flex min-h-dvh flex-col overflow-x-clip bg-page-bg font-kiosk text-azra-ink antialiased">

{{-- Tekstur latar: asset bg-texture.svg, tampil polos sesuai persetujuan --}}
<div aria-hidden="true" class="pointer-events-none fixed inset-0 z-0 bg-cover bg-center bg-no-repeat" style="background-image:url('{{ asset('images/bg-texture.svg') }}')"></div>

{{-- Strip warna khas RS Azra --}}
<div class="relative z-10 flex h-1.5" aria-hidden="true"><span class="flex-1 bg-[#ffe600]"></span><span class="flex-1 bg-[#9fe86c]"></span><span class="flex-1 bg-[#4cc2a7]"></span><span class="flex-1 bg-[#27a3b6]"></span></div>

<x-kiosk-navbar />

<div class="relative z-10 mx-auto flex w-full max-w-[1200px] flex-1 flex-col px-4 portrait:max-w-none landscape:max-w-none sm:px-7">
    @yield('content')
</div>

@stack('scripts')

</body>
</html>
