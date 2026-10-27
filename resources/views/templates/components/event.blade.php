<section class="events py-16 px-4 max-w-3xl mx-auto">
    <h2 class="text-3xl font-bold text-center mb-10" style="font-family: var(--font-heading);">Rangkaian Acara</h2>

    <div class="space-y-6">
        @forelse ($invitation->events as $event)
            <div class="event-card rounded-lg p-6 border" style="border-color: var(--color-secondary); background: color-mix(in srgb, var(--color-background) 92%, var(--color-secondary) 8%);">
                <h3 class="text-2xl font-bold mb-3" style="font-family: var(--font-heading); color: var(--color-primary);">
                    {{ $event->name }}
                </h3>
                <div class="space-y-2 text-sm">
                    <p class="flex items-start gap-2">
                        <span aria-hidden="true">📅</span>
                        <span>{{ $event->date->translatedFormat('l, d F Y') }}</span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span aria-hidden="true">🕐</span>
                        <span>{{ $event->time->format('H:i') }} WIB</span>
                    </p>
                    <p class="flex items-start gap-2">
                        <span aria-hidden="true">📍</span>
                        <span>
                            <strong>{{ $event->venue_name }}</strong><br>
                            {{ $event->address }}
                        </span>
                    </p>
                </div>
                @if ($event->maps_link)
                    <a href="{{ $event->maps_link }}" target="_blank" rel="noopener noreferrer"
                       class="inline-block mt-4 px-4 py-2 rounded text-white text-sm"
                       style="background: var(--color-primary);">
                        Lihat Lokasi
                    </a>
                @endif
            </div>
        @empty
            <p class="text-center opacity-60">Belum ada acara.</p>
        @endforelse
    </div>
</section>