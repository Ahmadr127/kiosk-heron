{{-- Tombol standar kiosk: konsisten, ramah sentuh tanpa berlebihan.
     Props:
       href      bila diisi -> render <a>, bila tidak -> <button>
       type      tipe button (submit|button), default submit
       variant   primary (navy) | teal | checkin (pink) | secondary | ghost
       size      sm (40px) | md (48px, default) | lg (56px)
       wide      true -> full width (w-full)
     Kelas tambahan bisa ditambah via atribut class biasa. --}}
@props(['href' => null, 'type' => 'submit', 'variant' => 'primary', 'size' => 'md', 'wide' => false])

@php
$base = 'inline-flex items-center justify-center gap-2 rounded-2xl font-bold no-underline transition duration-150 hover:-translate-y-0.5 active:translate-y-0 focus-visible:outline-[3px] focus-visible:outline-offset-[3px] focus-visible:outline-azra-navy';
$sizes = [
    'sm' => 'h-9 px-4 text-[14px]',
    'md' => 'h-11 px-6 text-[15px]',
    'lg' => 'h-12 px-7 text-[16px]',
];
$variants = [
    'primary' => 'bg-azra-navy text-white shadow-[0_8px_18px_-10px_rgba(31,43,77,0.7)] hover:brightness-110',
    'teal' => 'bg-azra-teal text-white shadow-[0_8px_18px_-10px_rgba(0,119,116,0.7)] hover:brightness-110',
    'checkin' => 'bg-card-checkin text-white shadow-[0_8px_18px_-10px_rgba(213,0,104,0.7)] hover:brightness-110',
    'secondary' => 'border-2 border-azra-line bg-white text-azra-navy shadow-[0_6px_14px_-8px_rgba(31,43,77,0.4)] hover:border-azra-navy',
    'ghost' => 'px-2 text-azra-muted hover:text-azra-navy',
];
$class = trim($base.' '.($sizes[$size] ?? $sizes['md']).' '.($variants[$variant] ?? $variants['primary']).($wide ? ' w-full' : ''));
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</button>
@endif
