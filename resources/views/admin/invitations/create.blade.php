@extends('admin.layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Buat Undangan Baru</h2>

<form action="{{ route('admin.invitations.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
    @csrf
    @include('admin.invitations.partials._form', ['invitation' => null])
    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Buat Undangan</button>
        <a href="{{ route('admin.invitations.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection