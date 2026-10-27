@extends('admin.layouts.app')

@section('content')
<div class="mb-7"><p class="mb-1 text-sm font-medium text-[#9d8f7f]">DESAIN</p><h2 class="text-3xl font-semibold tracking-tight text-[#29241f]">Tambah Template</h2><p class="mt-1 text-sm text-gray-500">Tambahkan pilihan desain undangan.</p></div>

<form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data" class="admin-card max-w-3xl p-5 sm:p-7">
    @csrf
    <div class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Nama Template</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Tema</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border rounded px-3 py-2">
            <p class="text-sm text-gray-500">Kode tema (huruf kecil, tanpa spasi). Kosongkan untuk dibuat otomatis dari nama template. Contoh: jawa, minimalis, islami</p>
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
