@extends('layouts.app-admin')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Kepesertaan</h2>
    <form action="{{ url('/kepesertaan') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="jenis_kepesertaan" class="block text-gray-700">Jenis Kepesertaan :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="jenis_kepesertaan" name="jenis_kepesertaan" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
    </form>
    
    <hr class="my-8 border-t border-gray-200">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Kategori Lomba</h2>
    <form action="{{ url('/kategori') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="kategori" class="block text-gray-700">Masukkan Kategori :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="kategori" name="kategori" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
    </form>

    <hr class="my-8 border-t border-gray-200">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Prestasi Data</h2>
    <form action="{{ url('/prestasi') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="prestasi" class="block text-gray-700">Jenis Prestasi :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="prestasi" name="prestasi" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
    </form>

    <hr class="my-8 border-t border-gray-200">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Capaian Juara</h2>
    <form action="{{ url('/juara') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="jenis_juara" class="block text-gray-700">Capaian Juara :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="jenis_juara" name="jenis_juara" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
    </form>

    <hr class="my-8 border-t border-gray-200">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Posisi</h2>
    <form action="{{ url('/posisi') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="posisi" class="block text-gray-700">Posisi Peserta :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="posisi" name="posisi" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
    </form>
</div>
@endsection
