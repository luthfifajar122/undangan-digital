@extends('admin.layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard RSVP</h2>

<!-- Stats -->
<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Total RSVP</p>
        <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Hadir</p>
        <p class="text-2xl font-bold text-green-600">{{ $stats['hadir'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Tidak Hadir</p>
        <p class="text-2xl font-bold text-red-600">{{ $stats['tidak_hadir'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-sm text-gray-500">Total Tamu Hadir</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['total_guests'] }}</p>
    </div>
</div>

<!-- Filter -->
<form method="GET" class="bg-white rounded-lg shadow p-4 mb-6 flex gap-4">
    <select name="invitation_id" class="border rounded px-3 py-2">
        <option value="">Semua Undangan</option>
        @foreach ($invitations as $inv)
            <option value="{{ $inv->id }}" {{ request('invitation_id') == $inv->id ? 'selected' : '' }}>
                {{ $inv->bride_name }} & {{ $inv->groom_name }}
            </option>
        @endforeach
    </select>
    <select name="status" class="border rounded px-3 py-2">
        <option value="">Semua Status</option>
        <option value="hadir" {{ request('status') === 'hadir' ? 'selected' : '' }}>Hadir</option>
        <option value="tidak_hadir" {{ request('status') === 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
</form>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Tamu</th>
                <th class="px-4 py-3 text-left">Undangan</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Jumlah</th>
                <th class="px-4 py-3 text-left">Pesan</th>
                <th class="px-4 py-3 text-left">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rsvps as $rsvp)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $rsvp->guest->name }}</td>
                <td class="px-4 py-3 text-sm">{{ $rsvp->guest->invitation->bride_name }} & {{ $rsvp->guest->invitation->groom_name }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs {{ $rsvp->status === 'hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $rsvp->status === 'hadir' ? 'Hadir' : 'Tidak Hadir' }}
                    </span>
                </td>
                <td class="px-4 py-3">{{ $rsvp->guest_count }}</td>
                <td class="px-4 py-3 text-sm">{{ Str::limit($rsvp->message, 40) }}</td>
                <td class="px-4 py-3 text-sm">{{ $rsvp->submitted_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $rsvps->links() }}
@endsection