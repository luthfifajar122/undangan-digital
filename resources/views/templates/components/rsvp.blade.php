<section class="rsvp py-16 px-4 max-w-xl mx-auto" id="rsvp">
    <h2 class="text-3xl font-bold text-center mb-8" style="font-family: var(--font-heading);">Konfirmasi Kehadiran</h2>

    @if ($guest)
        <div x-data="rsvpForm(@js(route('rsvp.store', ['slug' => $invitation->slug, 'token' => $guest->token])), @js($guest->rsvp?->status), @js($guest->rsvp?->guest_count))" class="rounded-lg p-6 border" style="border-color: var(--color-secondary);">
            <p class="mb-4 text-sm">Kepada: <strong>{{ $guest->name }}</strong></p>

            <div x-show="submitted" x-cloak class="p-4 rounded bg-green-50 text-green-800 text-sm mb-4" x-text="message"></div>

            <form @submit.prevent="submit()" class="space-y-4">
                <div>
                    <label class="block font-medium mb-1 text-sm">Kehadiran</label>
                    <div class="flex gap-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="hadir" x-model="form.status" required>
                            <span>Hadir</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="tidak_hadir" x-model="form.status">
                            <span>Tidak Hadir</span>
                        </label>
                    </div>
                </div>
                <div x-show="form.status === 'hadir'">
                    <label class="block font-medium mb-1 text-sm">Jumlah Orang</label>
                    <input type="number" min="1" x-model.number="form.guest_count" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium mb-1 text-sm">Pesan (opsional)</label>
                    <textarea x-model="form.message" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <button type="submit" :disabled="loading" class="w-full py-3 rounded text-white font-medium disabled:opacity-60" style="background: var(--color-primary);">
                    <span x-show="!loading">Kirim Konfirmasi</span>
                    <span x-show="loading" x-cloak>Mengirim...</span>
                </button>
            </form>
        </div>
    @else
        <p class="text-center text-sm opacity-70">Silakan buka undangan melalui link personal dari admin untuk mengonfirmasi kehadiran.</p>
    @endif
</section>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('rsvpForm', (url, status, count) => ({
        url: url,
        loading: false,
        submitted: false,
        message: '',
        form: {
            status: status || 'hadir',
            guest_count: count || 1,
            message: '',
        },
        async submit() {
            this.loading = true;
            this.submitted = false;
            try {
                const res = await fetch(this.url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify(this.form),
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    this.submitted = true;
                    this.message = data.message;
                } else {
                    this.submitted = true;
                    this.message = data.message || 'Terjadi kesalahan.';
                }
            } catch (e) {
                this.submitted = true;
                this.message = 'Gagal mengirim. Coba lagi.';
            } finally {
                this.loading = false;
            }
        },
    }));
});
</script>