@php
    $envelopeId = 'envelope-' . ($invitation->id ?? uniqid());
@endphp
<div x-data="{ opened: false }" x-cloak>
    <div x-show="!opened" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-500">
        <div class="text-center text-white">
            <p class="mb-4 text-sm uppercase tracking-widest">Undangan Pernikahan</p>
            <h2 class="text-3xl font-bold mb-2">{{ $invitation->bride_name }} & {{ $invitation->groom_name }}</h2>
            <p class="mb-6 text-sm opacity-80">Kepada Yth. {{ $guest?->name ?? 'Tamu Undangan' }}</p>
            <button @click="opened = true; $dispatch('envelope-opened')" class="bg-white text-gray-900 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition">
                Buka Undangan
            </button>
        </div>
    </div>
    <div x-show="opened" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        {{ $slot ?? '' }}
    </div>
</div>