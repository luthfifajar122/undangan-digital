@extends('templates.layouts.invitation')

@section('content')
<div x-data="{ opened: {{ ($isPreview ?? false) ? 'true' : 'false' }} }" @envelope-opened.window="opened = true">
    {{-- Envelope overlay --}}
    <div x-show="!opened" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="text-center text-white px-6">
            <p class="mb-3 text-xs uppercase tracking-[0.3em] opacity-80">Undangan Pernikahan</p>
            <h2 class="text-4xl font-bold mb-2" style="font-family: var(--font-heading);">{{ $invitation->bride_name }} & {{ $invitation->groom_name }}</h2>
            <p class="mb-6 text-sm opacity-80">Kepada Yth. {{ $guest?->name ?? 'Tamu Undangan' }}</p>
            <button @click="opened = true" class="bg-white text-gray-900 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition">
                Buka Undangan
            </button>
        </div>
    </div>

    <div x-show="opened" x-transition.opacity.duration.700ms>
        @include('templates.components.hero')
        @include('templates.components.story')
        @include('templates.components.event')
        @include('templates.components.map')
        @include('templates.components.gallery')
        @include('templates.components.rsvp')
        @include('templates.components.wish')

        <footer class="py-10 text-center text-sm opacity-60">
            <p>Dibuat dengan penuh cinta</p>
            <p class="mt-1">{{ $invitation->bride_name }} & {{ $invitation->groom_name }} &middot; {{ $invitation->event_date->format('Y') }}</p>
        </footer>
    </div>
</div>
@endsection