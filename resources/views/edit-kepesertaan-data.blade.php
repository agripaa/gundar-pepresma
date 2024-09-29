@extends('layouts.app-admin')

@section('title', 'Edit Kepesertaan Master Data')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Kepesertaan Master Data</h2>

    @if ($kepesertaan ?? false)
    <form action="{{ route('kepesertaan.update', $kepesertaan->id) }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="kepesertaan" class="block text-gray-700">Edit Kepesertaan :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="jenis_kepesertaan" name="jenis_kepesertaan" value="{{ old('jenis_kepesertaan', $kepesertaan->jenis_kepesertaan) }}" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Update</button>
    </form>
    @endif
</div>
@endsection
