@extends('templates.layouts.invitation')

@section('content')
<div x-data="{ opened: {{ ($isPreview ?? false) ? 'true' : 'false' }} }" @envelope-opened.window="opened = true">
    {{-- Minimalist envelope --}}
    <div x-show="!opened" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-[var(--color-background)]">
        <div class="text-center px-6">
            <div class="w-16 h-16 mx-auto mb-6 rounded-full flex items-center justify-center" style="background: var(--color-secondary);">
                <span class="text-2xl" style="color: var(--color-primary);">&#10084;</span>
            </div>
            <p class="mb-2 text-xs uppercase tracking-[0.3em] opacity-60">The Wedding Of</p>
            <h2 class="text-4xl font-bold mb-6" style="font-family: var(--font-heading);">{{ $invitation->bride_name }} & {{ $invitation->groom_name }}</h2>
            <p class="mb-6 text-sm opacity-70">Kepada Yth. {{ $guest?->name ?? 'Tamu Undangan' }}</p>
            <button @click="opened = true" class="px-8 py-3 rounded-full font-medium text-white" style="background: var(--color-primary);">
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
            <p>{{ $invitation->bride_name }} & {{ $invitation->groom_name }}</p>
            <p class="mt-1">{{ $invitation->event_date->format('Y') }}</p>
        </footer>
    </div>
</div>
@endsection