@extends('admin.layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Template: {{ $template->name }}</h2>

<form action="{{ route('admin.templates.update', $template) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-2xl">
    @csrf
    @method('PUT')
    <div class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Nama Template</label>
            <input type="text" name="name" value="{{ old('name', $template->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Tema</label>
            <input type="text" name="slug" value="{{ old('slug', $template->slug) }}" class="w-full border rounded px-3 py-2">
            <p class="text-sm text-gray-500">Kode tema (huruf kecil, tanpa spasi). Kosongkan untuk mempertahankan tema saat ini.</p>
        </div>
        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category" class="w-full border rounded px-3 py-2" required>
                @foreach (['Klasik', 'Modern', 'Islami', 'Custom'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $template->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium mb-1">Preview Image</label>
            @if ($template->preview_image)
                <img src="{{ asset('storage/' . $template->preview_image) }}" alt="Preview" class="w-32 h-20 object-cover mb-2 rounded">
            @endif
            <input type="file" name="preview_image" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Blade Path</label>
            <input type="text" name="blade_path" value="{{ old('blade_path', $template->blade_path) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Config JSON (opsional)</label>
            <textarea name="config_json" rows="8" class="w-full border rounded px-3 py-2 font-mono text-sm">{{ old('config_json', json_encode($template->config_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
        </div>
        <div>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $template->is_active) ? 'checked' : '' }}>
                <span>Aktif</span>
            </label>
        </div>
    </div>
    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Template</button>
        <a href="{{ route('admin.templates.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection