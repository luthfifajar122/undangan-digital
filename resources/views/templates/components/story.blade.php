<section class="story py-16 px-4 max-w-3xl mx-auto text-center">
    @if ($invitation->bride_parents || $invitation->groom_parents)
        <div class="mb-8">
            @if ($invitation->bride_parents)
                <p class="text-sm opacity-70 mb-1">Putri dari</p>
                <p class="font-medium">{{ $invitation->bride_parents }}</p>
            @endif
            @if ($invitation->groom_parents)
                <p class="text-sm opacity-70 mt-4 mb-1">Putra dari</p>
                <p class="font-medium">{{ $invitation->groom_parents }}</p>
            @endif
        </div>
    @endif
    @if ($invitation->story)
        <div class="leading-relaxed">
            <p>{{ $invitation->story }}</p>
        </div>
    @endif
</section>