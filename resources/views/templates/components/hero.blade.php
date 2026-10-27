<section class="invitation-hero py-16 text-center">
    <p class="text-sm uppercase tracking-widest opacity-70 mb-2">The Wedding Of</p>
    <h1 class="text-5xl md:text-7xl font-bold mb-4" style="font-family: var(--font-heading);">
        {{ $invitation->bride_name }} <span class="text-[var(--color-secondary)]">&</span> {{ $invitation->groom_name }}
    </h1>
    <p class="text-lg mb-8 opacity-80">
        {{ $invitation->event_date->translatedFormat('l, d F Y') }}
    </p>
    @if ($config['defaults']['countdown_show'] ?? true)
        @include('templates.components.countdown')
    @endif
</section>