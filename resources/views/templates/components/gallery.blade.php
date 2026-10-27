@php
    $items = $invitation->galleryItems->map(fn ($i) => ['url' => $i->url, 'type' => $i->type, 'caption' => $i->caption])->values();
@endphp
<section class="gallery py-16 px-4 max-w-5xl mx-auto" x-data="galleryLightbox(@js($items))" @keydown.escape.window="close()" @keydown.arrow-right.window="next()" @keydown.arrow-left.window="prev()">
    <h2 class="text-3xl font-bold text-center mb-10" style="font-family: var(--font-heading);">Galeri</h2>

    @if ($invitation->galleryItems->isNotEmpty())
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach ($invitation->galleryItems as $index => $item)
                <button type="button" @click="openAt({{ $index }})" class="relative block overflow-hidden rounded-lg group">
                    @if ($item->type === 'image')
                        <img src="{{ $item->url }}" alt="{{ $item->caption ?? 'Foto' }}" class="w-full h-40 object-cover transition group-hover:scale-105" loading="lazy">
                    @else
                        <video src="{{ $item->url }}" class="w-full h-40 object-cover" muted></video>
                        <span class="absolute inset-0 flex items-center justify-center bg-black/30 text-white text-3xl">▶</span>
                    @endif
                </button>
            @endforeach
        </div>
    @else
        <p class="text-center opacity-60">Belum ada foto.</p>
    @endif

    <div x-show="isOpen" x-cloak class="fixed inset-0 z-[60] bg-black/90 flex items-center justify-center p-4" @click.self="close()">
        <button @click="close()" class="absolute top-4 right-4 text-white text-3xl leading-none">&times;</button>
        <button @click="prev()" class="absolute left-4 text-white text-4xl leading-none px-2">&lsaquo;</button>
        <button @click="next()" class="absolute right-4 text-white text-4xl leading-none px-2">&rsaquo;</button>
        <div class="max-w-4xl w-full text-center">
            <template x-if="items.length && items[index].type === 'image'">
                <img :src="items[index].url" class="max-h-[80vh] mx-auto rounded" alt="">
            </template>
            <template x-if="items.length && items[index].type === 'video'">
                <video :src="items[index].url" controls autoplay class="max-h-[80vh] mx-auto rounded"></video>
            </template>
            <p class="text-white text-sm mt-3" x-text="items.length ? (items[index].caption || '') : ''"></p>
        </div>
    </div>
</section>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('galleryLightbox', (items) => ({
        items: items || [],
        index: 0,
        isOpen: false,
        openAt(i) { this.index = i; this.isOpen = true; },
        close() { this.isOpen = false; },
        next() { if (!this.isOpen) return; this.index = (this.index + 1) % this.items.length; },
        prev() { if (!this.isOpen) return; this.index = (this.index - 1 + this.items.length) % this.items.length; },
    }));
});
</script>