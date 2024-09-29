@extends('layouts.app-admin')

@section('title', 'Edit Fakultas')

@section('content')
<div class="max-w-full min-h-[88vh] flex justify-center items-center">
    <div class="bg-white w-full h-full p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Fakultas</h1>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('fakultas.update', $faculty->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Form Inputs -->
            <div>
                <label for="fakultas" class="block text-gray-700">Fakultas</label>
                <input type="text" id="name_faculty" name="name_faculty" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $faculty->name_faculty }}" required>
                
                @error('name_faculty')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
