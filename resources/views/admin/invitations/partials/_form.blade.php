<!-- Detail fields (shown in detail tab) -->
<div x-show="tab==='detail' || !tab">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-medium mb-1">Template</label>
            <select name="template_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($templates as $template)
                    <option value="{{ $template->id }}" {{ old('template_id', $invitation?->template_id) == $template->id ? 'selected' : '' }}>
                        {{ $template->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium mb-1">Slug (URL)</label>
            <input type="text" name="slug" value="{{ old('slug', $invitation?->slug) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Nama Mempelai Wanita</label>
            <input type="text" name="bride_name" value="{{ old('bride_name', $invitation?->bride_name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Nama Mempelai Pria</label>
            <input type="text" name="groom_name" value="{{ old('groom_name', $invitation?->groom_name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Orang Tua Mempelai Wanita</label>
            <input type="text" name="bride_parents" value="{{ old('bride_parents', $invitation?->bride_parents) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Orang Tua Mempelai Pria</label>
            <input type="text" name="groom_parents" value="{{ old('groom_parents', $invitation?->groom_parents) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Tanggal Acara</label>
            <input type="date" name="event_date" value="{{ old('event_date', $invitation?->event_date?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Waktu Acara</label>
            <input type="time" name="event_time" value="{{ old('event_time', $invitation?->event_time?->format('H:i')) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Nama Venue</label>
            <input type="text" name="venue_name" value="{{ old('venue_name', $invitation?->venue_name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Alamat</label>
            <textarea name="address" rows="2" class="w-full border rounded px-3 py-2" required>{{ old('address', $invitation?->address) }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-1">Google Maps Link</label>
            <input type="url" name="maps_link" value="{{ old('maps_link', $invitation?->maps_link) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Maps Embed (iframe src)</label>
            <input type="text" name="maps_embed" value="{{ old('maps_embed', $invitation?->maps_embed) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="col-span-2">
            <label class="block font-medium mb-1">Kisah/Cerita Pasangan</label>
            <textarea name="story" rows="4" class="w-full border rounded px-3 py-2">{{ old('story', $invitation?->story) }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-1">File Musik (MP3/OGG)</label>
            <input type="file" name="music_file" accept=".mp3,.ogg" class="w-full border rounded px-3 py-2">
            @if ($invitation?->music_path)
                <p class="text-sm text-gray-500 mt-1">File saat ini: {{ $invitation->music_path }}</p>
            @endif
        </div>
        <div>
            <label class="block font-medium mb-1">Background Image</label>
            <input type="file" name="background_image" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>
    </div>
</div>

<!-- Settings Tab Content -->
<div x-show="tab==='settings'">
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block font-medium mb-1">Nomor WhatsApp (opsional, override global)</label>
            <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $invitation?->whatsapp_number) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Kadaluarsa (opsional)</label>
            <input type="datetime-local" name="expires_at" value="{{ old('expires_at', $invitation?->expires_at?->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2" required>
                @foreach (['draft', 'published', 'archived'] as $status)
                    <option value="{{ $status }}" {{ old('status', $invitation?->status ?? 'draft') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-2">
            <label class="block font-medium mb-1">Settings JSON (opsional)</label>
            <textarea name="settings_json" rows="6" class="w-full border rounded px-3 py-2 font-mono text-sm">{{ old('settings_json', json_encode($invitation?->settings_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
        </div>
    </div>
</div>