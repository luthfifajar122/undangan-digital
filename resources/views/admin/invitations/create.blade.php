@extends('admin.layouts.app')

@section('content')
<div class="mb-7"><p class="mb-1 text-sm font-medium text-[#9d8f7f]">UNDANGAN BARU</p><h2 class="text-3xl font-semibold tracking-tight text-[#29241f]">Buat Undangan</h2><p class="mt-1 text-sm text-gray-500">Isi informasi pasangan dan detail acara.</p></div>

<form action="{{ route('admin.invitations.store') }}" method="POST" enctype="multipart/form-data" class="admin-card p-5 sm:p-7">
    @csrf
    @include('admin.invitations.partials._form', ['invitation' => null])
    <div class="mt-6">
        <button type="submit" class="text-white px-6 py-2.5">Buat Undangan</button>
        <a href="{{ route('admin.invitations.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
