@extends('layouts.app-admin')

@section('title', 'Edit Kategori Master Data')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Kategori Master Data</h2>

    @if ($kategori ?? false)
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="kategori" class="block text-gray-700">Edit Kategori :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="kategori" name="kategori" value="{{ old('kategori', $kategori->kategori) }}" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Update</button>
    </form>
    @endif
</div>
@endsection
