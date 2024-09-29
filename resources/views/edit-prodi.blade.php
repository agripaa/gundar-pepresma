@extends('layouts.app-admin')

@section('title', 'Edit Program Studi')

@section('content')
<div class="max-w-full min-h-[88vh] flex justify-center items-center">
    <div class="bg-white w-full h-full p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Program Studi</h1>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Edit Program Studi -->
        <form action="{{ route('prodi.update', $prodi->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Nama Program Studi -->
            <div class="mt-6">
                <label for="prodi" class="block text-gray-700">Nama Program Studi</label>
                <input type="text" id="prodi" name="study_program" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $prodi->study_program }}" required>
                @error('study_program')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kode Program Studi -->
            <div class="mt-6">
                <label for="kode" class="block text-gray-700">Kode Program Studi</label>
                <input type="text" id="kode" name="study_program_code" class="bg-gray-200 px-4 py-2 rounded-lg w-full" value="{{ $prodi->study_program_code }}" required>
                @error('study_program_code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenjang dan Fakultas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="jenjang" class="block text-gray-700">Jenjang Program Studi</label>
                    <select id="jenjang" name="study_program_level" class="bg-gray-200 px-4 py-2 rounded-lg w-full" required>
                        <option value="D3" {{ $prodi->study_program_level == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ $prodi->study_program_level == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="S1" {{ $prodi->study_program_level == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ $prodi->study_program_level == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ $prodi->study_program_level == 'S3' ? 'selected' : '' }}>S3</option>
                    </select>
                    @error('study_program_level')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="fakultas" class="block text-gray-700">Fakultas</label>
                    <select id="fakultas" name="faculty" class="bg-gray-200 px-4 py-2 rounded-lg w-full" required>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}" {{ $prodi->faculty == $faculty->id ? 'selected' : '' }}>{{ $faculty->name_faculty }}</option>
                        @endforeach
                    </select>
                    @error('faculty')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
