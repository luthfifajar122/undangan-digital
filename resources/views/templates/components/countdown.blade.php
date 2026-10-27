@php
    $target = $invitation->event_date->format('Y-m-d') . 'T' . $invitation->event_time->format('H:i:s');
@endphp
<div x-data="countdown('{{ $target }}')" x-init="start()" class="flex gap-4 justify-center">
    <div class="text-center">
        <span class="text-3xl font-bold" x-text="days">0</span>
        <p class="text-xs uppercase tracking-widest opacity-70">Hari</p>
    </div>
    <div class="text-center">
        <span class="text-3xl font-bold" x-text="hours">0</span>
        <p class="text-xs uppercase tracking-widest opacity-70">Jam</p>
    </div>
    <div class="text-center">
        <span class="text-3xl font-bold" x-text="minutes">0</span>
        <p class="text-xs uppercase tracking-widest opacity-70">Menit</p>
    </div>
    <div class="text-center">
        <span class="text-3xl font-bold" x-text="seconds">0</span>
        <p class="text-xs uppercase tracking-widest opacity-70">Detik</p>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('countdown', (target) => ({
        target: new Date(target).getTime(),
        days: 0, hours: 0, minutes: 0, seconds: 0,
        interval: null,
        start() {
            this.update();
            this.interval = setInterval(() => this.update(), 1000);
        },
        update() {
            const now = new Date().getTime();
            const diff = this.target - now;
            if (diff <= 0) {
                this.days = this.hours = this.minutes = this.seconds = 0;
                if (this.interval) clearInterval(this.interval);
                return;
            }
            this.days = Math.floor(diff / (1000 * 60 * 60 * 24));
            this.hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            this.minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            this.seconds = Math.floor((diff % (1000 * 60)) / 1000);
        }
    }));
});
</script>