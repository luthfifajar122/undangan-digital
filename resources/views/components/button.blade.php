@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
    'size' => 'md',
])

@php
    $variantClasses = [
        'primary' => 'bg-primary text-white hover:bg-primary-dark focus:ring-primary',
        'secondary' => 'border-2 border-primary text-primary hover:bg-primary hover:text-white focus:ring-primary',
        'ghost' => 'text-primary hover:bg-surface-elevated focus:ring-primary',
        'whatsapp' => 'bg-whatsapp text-white hover:bg-[#0D7A6D] focus:ring-whatsapp',
    ][$variant] ?? 'bg-primary text-white hover:bg-primary-dark focus:ring-primary';

    $sizeClasses = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
    ][$size] ?? 'px-6 py-3 text-base';
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        class="inline-flex items-center justify-center gap-2 font-semibold rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $variantClasses }} {{ $sizeClasses }}"
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        class="inline-flex items-center justify-center gap-2 font-semibold rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $variantClasses }} {{ $sizeClasses }}"
    >
        {{ $slot }}
    </button>
@endif