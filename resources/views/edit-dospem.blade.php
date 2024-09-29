@extends('layouts.app-admin')

@section('title', 'Edit Dosen Pembimbing')

@section('content')
<div class="max-w-full min-h-[88vh] flex justify-center items-center">
    <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Dosen Pembimbing</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dospem.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Tambahkan method PUT untuk update -->

            <div>
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $dosen->nama }}" required>
            </div>

            <div class="mt-6">
                <label for="nidn" class="block text-gray-700">NIDN</label>
                <input type="number" id="nidn" name="nidn" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $dosen->NIDN }}" required>
            </div>

            <div class="mt-6">
                <label for="nip" class="block text-gray-700">NIP</label>
                <input type="number" id="nip" name="nip" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $dosen->NIP }}" required>
            </div>

            <div class="mt-6">
                <label for="nuptk" class="block text-gray-700">NUPTK</label>
                <input type="number" id="nuptk" name="nuptk" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $dosen->NUPTK }}" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
