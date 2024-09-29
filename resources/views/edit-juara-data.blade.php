@extends('layouts.app-admin')

@section('title', 'Edit Jenis Juara Master Data')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Jenis Juara Master Data</h2>

    @if ($capaianJuara ?? false)
    <form action="{{ route('juara.update', $capaianJuara->id) }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="jenis_juara" class="block text-gray-700">Edit Jenis Juara :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="jenis_juara" name="jenis_juara" value="{{ old('capaianJuara', $capaianJuara->jenis_juara) }}" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Update</button>
    </form>
    @endif
</div>
@endsection
