@extends('admin.layouts.app')

@section('content')
<div x-data="{ tab: 'detail' }">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Edit Undangan: {{ $invitation->bride_name }} & {{ $invitation->groom_name }}</h2>
        <div class="space-x-2">
            <button type="button" onclick="submitPreview()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Pratinjau</button>
            <a href="{{ url($invitation->slug) }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lihat Live</a>
        </div>
    </div>

    <!-- Tabs -->
    <div class="mb-6 border-b border-gray-200">
        <nav class="flex space-x-4">
            @foreach (['detail' => 'Detail', 'events' => 'Acara', 'guests' => 'Tamu', 'gallery' => 'Galeri', 'wishes' => 'Ucapan', 'settings' => 'Pengaturan'] as $key => $label)
                <button type="button" @click="tab='{{ $key }}'"
                        :class="tab==='{{ $key }}' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-600'"
                        class="px-4 py-2 border-b-2 font-medium">{{ $label }}</button>
            @endforeach
        </nav>
    </div>

    <form id="invitation-form" action="{{ route('admin.invitations.update', $invitation) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')
        @include('admin.invitations.partials._form', ['invitation' => $invitation])

        <!-- Events Tab Content -->
        <div x-show="tab==='events'" x-cloak class="mt-6">
            <h3 class="text-lg font-bold mb-4">Daftar Acara</h3>
            <div id="events-container">
                @foreach ($invitation->events as $index => $event)
                <div class="event-row border rounded p-4 mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Nama Acara</label>
                            <input type="text" name="events[{{ $index }}][name]" value="{{ $event->name }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Tanggal</label>
                            <input type="date" name="events[{{ $index }}][date]" value="{{ $event->date->format('Y-m-d') }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Waktu</label>
                            <input type="time" name="events[{{ $index }}][time]" value="{{ $event->time->format('H:i') }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Venue</label>
                            <input type="text" name="events[{{ $index }}][venue_name]" value="{{ $event->venue_name }}" class="w-full border rounded px-3 py-2">
                        </div>
                        <div class="col-span-2">
                            <label class="block font-medium mb-1">Alamat</label>
                            <textarea name="events[{{ $index }}][address]" rows="2" class="w-full border rounded px-3 py-2">{{ $event->address }}</textarea>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Google Maps Link</label>
                            <input type="url" name="events[{{ $index }}][maps_link]" value="{{ $event->maps_link }}" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addEvent()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">+ Tambah Acara</button>
        </div>

        <div class="mt-6" x-show="tab==='detail' || tab==='events' || tab==='settings'" x-cloak>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>

    <!-- Guests Tab -->
    <div x-show="tab==='guests'" x-cloak class="mt-2 bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Daftar Tamu</h3>
            <a href="{{ route('admin.invitations.guests.export', $invitation) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Export CSV</a>
        </div>

        <form action="{{ route('admin.invitations.guests.import', $invitation) }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="flex gap-2">
                <input type="file" name="csv_file" accept=".csv,.txt" class="border rounded px-3 py-2" required>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Import CSV</button>
            </div>
            <p class="text-sm text-gray-500 mt-1">Format header: name,category,phone</p>
        </form>

        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left">Nama</th>
                    <th class="px-3 py-2 text-left">Kategori</th>
                    <th class="px-3 py-2 text-left">Telepon</th>
                    <th class="px-3 py-2 text-left">Link RSVP</th>
                    <th class="px-3 py-2 text-left">RSVP</th>
                    <th class="px-3 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invitation->guests as $guest)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $guest->name }}</td>
                    <td class="px-3 py-2">{{ $guest->category }}</td>
                    <td class="px-3 py-2">{{ $guest->phone }}</td>
                    <td class="px-3 py-2">
                        <a href="{{ route('invitation.rsvp', ['slug' => $invitation->slug, 'token' => $guest->token]) }}" target="_blank" class="text-blue-600 hover:underline text-xs">Buka</a>
                    </td>
                    <td class="px-3 py-2">
                        @if ($guest->rsvp)
                            <span class="text-xs {{ $guest->rsvp->status === 'hadir' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $guest->rsvp->status }} ({{ $guest->rsvp->guest_count }})
                            </span>
                        @else
                            <span class="text-xs text-gray-400">Belum</span>
                        @endif
                    </td>
                    <td class="px-3 py-2">
                        <form action="{{ route('admin.guests.destroy', $guest) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tamu?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-3 py-4 text-center text-gray-400">Belum ada tamu. Import CSV untuk menambahkan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Gallery Tab -->
    <div x-show="tab==='gallery'" x-cloak class="mt-2 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold mb-4">Galeri Foto/Video</h3>
        <div id="gallery-container" class="grid grid-cols-4 gap-4 mb-4">
            @foreach ($invitation->galleryItems as $item)
            <div class="relative border rounded overflow-hidden">
                @if ($item->type === 'image')
                    <img src="{{ $item->url }}" alt="{{ $item->caption }}" class="w-full h-32 object-cover">
                @else
                    <video src="{{ $item->url }}" class="w-full h-32 object-cover"></video>
                @endif
                <div class="p-2 text-xs">
                    <p>{{ $item->caption }}</p>
                    <button type="button" onclick="deleteGalleryItem({{ $item->id }})" class="text-red-600 hover:underline">Hapus</button>
                </div>
            </div>
            @endforeach
        </div>
        <form id="gallery-upload-form" enctype="multipart/form-data" class="flex gap-2 flex-wrap">
            @csrf
            <input type="file" name="file" accept="image/*,video/*" class="border rounded px-3 py-2" required>
            <input type="text" name="caption" placeholder="Caption (opsional)" class="border rounded px-3 py-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upload</button>
        </form>
    </div>

    <!-- Wishes Tab -->
    <div x-show="tab==='wishes'" x-cloak class="mt-2 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold mb-4">Ucapan Tamu</h3>
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-2 text-left">Nama</th>
                    <th class="px-3 py-2 text-left">Pesan</th>
                    <th class="px-3 py-2 text-left">Status</th>
                    <th class="px-3 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invitation->wishes as $wish)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $wish->guest_name }}</td>
                    <td class="px-3 py-2">{{ \Illuminate\Support\Str::limit($wish->message, 60) }}</td>
                    <td class="px-3 py-2">
                        <span class="px-2 py-1 rounded text-xs {{ $wish->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $wish->is_approved ? 'Disetujui' : 'Menunggu' }}
                        </span>
                    </td>
                    <td class="px-3 py-2 space-x-2">
                        <button type="button" onclick="toggleWish({{ $wish->id }}, {{ $wish->is_approved ? 'false' : 'true' }})" class="text-blue-600 hover:underline text-xs">
                            {{ $wish->is_approved ? 'Tolak' : 'Setujui' }}
                        </button>
                        <form action="{{ route('admin.wishes.destroy', $wish) }}" method="POST" class="inline" onsubmit="return confirm('Hapus ucapan?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-3 py-4 text-center text-gray-400">Belum ada ucapan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

function addEvent() {
    const container = document.getElementById('events-container');
    const index = Date.now();
    const html = `
    <div class="event-row border rounded p-4 mb-4">
        <div class="grid grid-cols-2 gap-4">
            <div><label class="block font-medium mb-1">Nama Acara</label><input type="text" name="events[${index}][name]" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Tanggal</label><input type="date" name="events[${index}][date]" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Waktu</label><input type="time" name="events[${index}][time]" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Venue</label><input type="text" name="events[${index}][venue_name]" class="w-full border rounded px-3 py-2"></div>
            <div class="col-span-2"><label class="block font-medium mb-1">Alamat</label><textarea name="events[${index}][address]" rows="2" class="w-full border rounded px-3 py-2"></textarea></div>
            <div><label class="block font-medium mb-1">Google Maps Link</label><input type="url" name="events[${index}][maps_link]" class="w-full border rounded px-3 py-2"></div>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
}

function toggleWish(id, approve) {
    fetch(`/admin/wishes/${id}`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body: JSON.stringify({ is_approved: approve })
    }).then(r => r.json()).then(data => { if (data.success) location.reload(); });
}

function deleteGalleryItem(id) {
    if (!confirm('Hapus item galeri?')) return;
    fetch(`/admin/gallery/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' } })
        .then(r => r.json()).then(data => { if (data.success) location.reload(); });
}

document.getElementById('gallery-upload-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('{{ route("admin.invitations.gallery.store", $invitation) }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body: formData
    }).then(r => r.json()).then(data => { if (data.success) location.reload(); });
});

function submitPreview() {
    const src = document.getElementById('invitation-form');
    const preview = document.createElement('form');
    preview.method = 'POST';
    preview.action = '{{ route("admin.invitations.preview") }}';
    preview.target = '_blank';

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = CSRF;
    preview.appendChild(csrf);

    const skip = ['_token', '_method', 'music_file', 'background_image', 'csv_file'];
    for (const el of src.elements) {
        if (!el.name || skip.includes(el.name)) continue;
        if (el.type === 'radio' && !el.checked) continue;
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = el.name;
        input.value = el.value;
        preview.appendChild(input);
    }
    document.body.appendChild(preview);
    preview.submit();
    document.body.removeChild(preview);
}
</script>
@endsection
