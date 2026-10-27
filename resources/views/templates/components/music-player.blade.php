@props(['src', 'volume' => 0.3])
<div x-data="musicPlayer(@js($src), {{ $volume }})" x-init="init()" class="fixed bottom-4 right-4 z-40">
    <button type="button" @click="toggle()" :class="playing ? 'animate-spin-slow' : ''"
            class="w-12 h-12 rounded-full flex items-center justify-center shadow-lg text-white"
            style="background: var(--color-primary);"
            :aria-label="playing ? 'Jeda musik' : 'Putar musik'">
        <svg x-show="!playing" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        <svg x-show="playing" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M6 5h4v14H6zM14 5h4v14h-4z"/></svg>
    </button>
</div>

<style>
    @keyframes spin-slow { to { transform: rotate(360deg); } }
    .animate-spin-slow { animation: spin-slow 4s linear infinite; }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('musicPlayer', (src, volume) => ({
        audio: null,
        playing: false,
        init() {
            this.audio = new Audio(src);
            this.audio.loop = true;
            this.audio.volume = volume;
            // Try autoplay on first user interaction
            const start = () => {
                this.audio.play().then(() => { this.playing = true; }).catch(() => {});
                document.removeEventListener('click', start);
                document.removeEventListener('touchstart', start);
            };
            document.addEventListener('click', start, { once: true });
            document.addEventListener('touchstart', start, { once: true });
        },
        toggle() {
            if (!this.audio) return;
            if (this.playing) { this.audio.pause(); this.playing = false; }
            else { this.audio.play().then(() => { this.playing = true; }).catch(() => {}); }
        },
    }));
});
</script>