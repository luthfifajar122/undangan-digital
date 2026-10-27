@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Daftar Undangan</h2>
    <a href="{{ route('admin.invitations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Buat Undangan</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Pasangan</th>
                <th class="px-4 py-3 text-left">Template</th>
                <th class="px-4 py-3 text-left">Tanggal Acara</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Views</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invitations as $invitation)
            <tr class="border-t">
                <td class="px-4 py-3">
                    <span class="font-medium">{{ $invitation->bride_name }} & {{ $invitation->groom_name }}</span>
                    <br><span class="text-sm text-gray-500 font-mono">{{ $invitation->slug }}</span>
                </td>
                <td class="px-4 py-3">{{ $invitation->template->name }}</td>
                <td class="px-4 py-3">{{ $invitation->event_date->format('d M Y') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs
                        {{ $invitation->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $invitation->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $invitation->status === 'archived' ? 'bg-gray-100 text-gray-800' : '' }}">
                        {{ ucfirst($invitation->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $invitation->views_count }}</td>
                <td class="px-4 py-3 space-x-2">
                    <a href="{{ route('admin.invitations.edit', $invitation) }}" class="text-blue-600 hover:underline">Edit</a>
                    <a href="{{ url($invitation->slug) }}" target="_blank" class="text-green-600 hover:underline">Lihat</a>
                    <form action="{{ route('admin.invitations.destroy', $invitation) }}" method="POST" class="inline" onsubmit="return confirm('Hapus undangan?')">
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

{{ $invitations->links() }}
@endsection