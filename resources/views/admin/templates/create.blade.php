@extends('admin.layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Tambah Template Baru</h2>

<form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-2xl">
    @csrf
    <div class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Nama Template</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border rounded px-3 py-2" required>
            <p class="text-sm text-gray-500">Contoh: jawa, minimalis, islami (huruf kecil, tanpa spasi)</p>
        </div>
        <div>
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category" class="w-full border rounded px-3 py-2" required>
                <option value="Klasik">Klasik</option>
                <option value="Modern">Modern</option>
                <option value="Islami">Islami</option>
                <option value="Custom">Custom</option>
            </select>
        </div>
        <div>
            <label class="block font-medium mb-1">Preview Image</label>
            <input type="file" name="preview_image" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Blade Path</label>
            <input type="text" name="blade_path" value="{{ old('blade_path') }}" class="w-full border rounded px-3 py-2" required placeholder="templates.jawa.layout">
            <p class="text-sm text-gray-500">Path view blade. Contoh: templates.jawa.layout</p>
        </div>
        <div>
            <label class="block font-medium mb-1">Config JSON (opsional)</label>
            <textarea name="config_json" rows="8" class="w-full border rounded px-3 py-2 font-mono text-sm">{{ old('config_json') }}</textarea>
            <p class="text-sm text-gray-500">Format JSON: colors, fonts, layout, defaults</p>
        </div>
        <div>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" checked>
                <span>Aktif (tampil di landing page)</span>
            </label>
        </div>
    </div>
    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Template</button>
        <a href="{{ route('admin.templates.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection