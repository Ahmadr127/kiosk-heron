{{-- Tombol kembali yang konsisten di seluruh halaman kiosk. --}}
@props(['href' => '/', 'label' => 'Kembali'])

<x-kiosk-btn :href="$href" variant="secondary" size="sm">
    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 5.5 8.5 12l6.5 6.5" /></svg>
    {{ $label }}
</x-kiosk-btn>
