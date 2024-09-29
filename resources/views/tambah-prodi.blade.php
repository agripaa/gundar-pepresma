@extends('layouts.app-admin')

@section('title', 'Tambah Program Studi')

@section('content')
<div class="max-w-full min-h-[88vh] flex flex-col justify-center items-center">
    <div class="bg-white w-full h-full p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Program Studi</h1>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah Program Studi -->
        <form action="{{ route('tambah-prodi') }}" method="POST">
            @csrf
            <!-- Nama Program Studi -->
            <div class="mt-6">
                <label for="prodi" class="block text-gray-700">Nama Program Studi</label>
                <input type="text" id="prodi" name="study_program" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan Nama Program Studi" required>
                @error('study_program')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kode Program Studi -->
            <div class="mt-6">
                <label for="kode" class="block text-gray-700">Kode Program Studi</label>
                <input type="text" id="kode" name="study_program_code" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan Kode Program Studi" required>
                @error('study_program_code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenjang dan Fakultas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="jenjang" class="block text-gray-700">Jenjang Program Studi</label>
                    <select id="jenjang" name="study_program_level" class="bg-gray-200 px-4 py-2 rounded-lg w-full" required>
                        <option value="">JENJANG</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                    @error('study_program_level')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="fakultas" class="block text-gray-700">Fakultas</label>
                    <select id="fakultas" name="faculty" class="bg-gray-200 px-4 py-2 rounded-lg w-full" required>
                        <option value="">FAKULTAS</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                        @endforeach
                    </select>
                    @error('faculty')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Tambah Data</button>
            </div>
        </form>
    </div>

    
    <div class="bg-white w-full max-w-full p-6 rounded-lg shadow-md mt-6">
        <div class="flex items-center justify-between w-full mb-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Program Studi</h2>
            <form method="GET" action="{{ route('tambah-prodi') }}">
                <input type="text" name="search" placeholder="Search Prodi or Code" value="{{ $search ?? '' }}" class="bg-gray-200 px-4 py-2 rounded-lg w-full">
            </form>
        </div>
    
        @if($prodis->isEmpty())
            <p class="text-gray-600">Belum ada data program studi.</p>
        @else
            <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                <table class="w-full bg-white border border-gray-300">
                    <thead class="text-gray-100 bg-purple-600">
                        <tr>
                            <th class="py-3 px-4 border-b text-center">No</th>
                            <th class="py-3 px-4 border-b text-center">Nama Program Studi</th>
                            <th class="py-3 px-4 border-b text-center">Kode Program Studi</th>
                            <th class="py-3 px-4 border-b text-center">Jenjang</th>
                            <th class="py-3 px-4 border-b text-center">Fakultas</th>
                            <th class="py-3 px-4 border-b text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prodis as $index => $prodi)
                            <tr>
                                <td class="py-3 px-4 text-center border-b">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $prodi->study_program }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $prodi->study_program_code }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $prodi->study_program_level }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $prodi->facultyRelation->name_faculty }}</td>
                                <td class="py-3 px-4 text-center border-b">
                                    <a href="{{ route('prodi.edit', $prodi->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                    <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $prodis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
