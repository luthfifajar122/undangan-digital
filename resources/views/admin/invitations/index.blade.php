@extends('admin.layouts.app')

@section('content')
<div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div><p class="mb-1 text-sm font-medium text-[#9d8f7f]">KELOLA ACARA</p><h2 class="text-3xl font-semibold tracking-tight text-[#29241f]">Daftar Undangan</h2><p class="mt-1 text-sm text-gray-500">Kelola undangan dan pantau performanya.</p></div>
    <a href="{{ route('admin.invitations.create') }}" class="admin-primary inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm text-white shadow-sm">＋ Buat Undangan</a>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto"><table class="admin-table w-full text-sm">
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
            <tr>
                <td class="px-4 py-3">
                    <span class="font-semibold text-gray-800">{{ $invitation->bride_name }} & {{ $invitation->groom_name }}</span>
                    <br><span class="text-sm text-gray-500 font-mono">{{ $invitation->slug }}</span>
                </td>
                <td class="px-4 py-3">{{ $invitation->template->name }}</td>
                <td class="px-4 py-3">{{ $invitation->event_date->format('d M Y') }}</td>
                <td class="px-4 py-3">
                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium
                        {{ $invitation->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $invitation->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $invitation->status === 'archived' ? 'bg-gray-100 text-gray-800' : '' }}">
                        {{ ucfirst($invitation->status) }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $invitation->views_count }}</td>
                <td class="px-4 py-3 space-x-2">
                    <a href="{{ route('admin.invitations.edit', $invitation) }}" class="font-medium text-[#6b4e3d] hover:underline">Edit</a>
                    <a href="{{ url($invitation->slug) }}" target="_blank" class="font-medium text-emerald-700 hover:underline">Lihat</a>
                    <form action="{{ route('admin.invitations.destroy', $invitation) }}" method="POST" class="inline" onsubmit="return confirm('Hapus undangan?')">
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

{{ $invitations->links() }}
@endsection
