@php
    $mapsEmbed = $invitation->maps_embed ?: ($invitation->events->first()->maps_embed ?? null);
@endphp
@if ($mapsEmbed)
<section class="map-section py-8 px-4 max-w-3xl mx-auto">
    <div class="rounded-lg overflow-hidden border" style="border-color: var(--color-secondary);">
        @if (str_contains($mapsEmbed, '<iframe'))
            {!! $mapsEmbed !!}
        @else
            <iframe src="{{ $mapsEmbed }}" width="100%" height="350" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @endif
    </div>
</section>
@endif