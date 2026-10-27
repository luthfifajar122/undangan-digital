@php
    $approvedWishes = $invitation->wishes->where('is_approved', true)->where('is_public', true);
@endphp
<section class="wishes py-16 px-4 max-w-2xl mx-auto" x-data="wishForm(@js(route('wish.store', ['slug' => $invitation->slug])))">
    <h2 class="text-3xl font-bold text-center mb-8" style="font-family: var(--font-heading);">Ucapan & Doa</h2>

    @if ($approvedWishes->isNotEmpty())
        <div class="space-y-3 mb-8 max-h-80 overflow-y-auto pr-1">
            @foreach ($approvedWishes as $wish)
                <div class="rounded-lg p-4 border text-sm" style="border-color: var(--color-secondary);">
                    <p class="font-semibold mb-1" style="color: var(--color-primary);">{{ $wish->guest_name }}</p>
                    <p class="opacity-80">{{ $wish->message }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <form @submit.prevent="submit()" class="rounded-lg p-6 border space-y-4" style="border-color: var(--color-secondary);">
        <div x-show="submitted" x-cloak class="p-3 rounded text-sm" :class="success ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'" x-text="message"></div>
        <div>
            <label class="block font-medium mb-1 text-sm">Nama</label>
            <input type="text" x-model="form.guest_name" maxlength="100" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1 text-sm">Ucapan / Doa</label>
            <textarea x-model="form.message" rows="3" maxlength="1000" required class="w-full border rounded px-3 py-2"></textarea>
        </div>
        <button type="submit" :disabled="loading" class="w-full py-3 rounded text-white font-medium disabled:opacity-60" style="background: var(--color-primary);">
            <span x-show="!loading">Kirim Ucapan</span>
            <span x-show="loading" x-cloak>Mengirim...</span>
        </button>
    </form>
</section>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('wishForm', (url) => ({
        url: url,
        loading: false,
        submitted: false,
        success: false,
        message: '',
        form: { guest_name: '', message: '' },
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
                    this.success = true;
                    this.message = data.message;
                    this.form = { guest_name: '', message: '' };
                } else {
                    this.success = false;
                    this.message = data.message || 'Terjadi kesalahan.';
                }
                this.submitted = true;
            } catch (e) {
                this.success = false;
                this.submitted = true;
                this.message = 'Gagal mengirim. Coba lagi.';
            } finally {
                this.loading = false;
            }
        },
    }));
});
</script>