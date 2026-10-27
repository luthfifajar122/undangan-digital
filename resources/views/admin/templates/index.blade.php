@extends('admin.layouts.app')

@section('content')
<div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div><p class="mb-1 text-sm font-medium text-[#9d8f7f]">DESAIN</p><h2 class="text-3xl font-semibold tracking-tight text-[#29241f]">Template Undangan</h2><p class="mt-1 text-sm text-gray-500">Atur pilihan tampilan untuk undangan.</p></div>
    <a href="{{ route('admin.templates.create') }}" class="admin-primary inline-flex items-center justify-center px-4 py-2.5 text-sm text-white shadow-sm">＋ Tambah Template</a>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto"><table class="admin-table w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Tema</th>
                <th class="px-4 py-3 text-left">Kategori</th>
                <th class="px-4 py-3 text-left">Blade Path</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($templates as $template)
            <tr>
                <td class="px-4 py-3">{{ $template->name }}</td>
                <td class="px-4 py-3 font-mono text-sm">{{ $template->slug }}</td>
                <td class="px-4 py-3">{{ $template->category }}</td>
                <td class="px-4 py-3 font-mono text-sm">{{ $template->blade_path }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $template->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
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
    </table></div>
</div>

{{ $templates->links() }}
@endsection
