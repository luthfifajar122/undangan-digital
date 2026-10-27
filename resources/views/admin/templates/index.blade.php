@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Template Undangan</h2>
    <a href="{{ route('admin.templates.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Template</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Slug</th>
                <th class="px-4 py-3 text-left">Kategori</th>
                <th class="px-4 py-3 text-left">Blade Path</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($templates as $template)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $template->name }}</td>
                <td class="px-4 py-3 font-mono text-sm">{{ $template->slug }}</td>
                <td class="px-4 py-3">{{ $template->category }}</td>
                <td class="px-4 py-3 font-mono text-sm">{{ $template->blade_path }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs {{ $template->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $template->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-4 py-3 space-x-2">
                    <a href="{{ route('admin.templates.edit', $template) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.templates.destroy', $template) }}" method="POST" class="inline" onsubmit="return confirm('Hapus template?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $templates->links() }}
@endsection