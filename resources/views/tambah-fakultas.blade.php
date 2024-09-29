@extends('layouts.app-admin')

@section('title', 'Tambah Fakultas')

@section('content')
<div class="flex flex-col max-w-full min-h-[88vh] justify-center items-center">
    <div class="bg-white w-full h-full p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Fakultas</h1>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Tambah Fakultas -->
        <form action="{{ route('tambah-fakultas') }}" method="POST">
            @csrf
            <!-- Form Inputs -->
            <div>
                <label for="fakultas" class="block text-gray-700">Fakultas</label>
                <input type="text" id="name_faculty" name="name_faculty" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan Fakultas" required>
                
                @error('name_faculty')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Tambah Data</button>
            </div>
        </form>
    </div>
    
    <div class="bg-white w-full max-w-full p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between w-full mb-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Fakultas</h2>
            <form method="GET" action="{{ route('tambah-fakultas') }}">
                <input type="text" name="search" placeholder="Cari Fakultas" value="{{ $search ?? '' }}" class="bg-gray-200 px-4 py-2 rounded-lg w-full">
            </form>
        </div>
    
        @if($faculties->isEmpty())
            <p class="text-gray-600">Belum ada data fakultas.</p>
        @else
            <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                <table class="w-full bg-white border border-gray-300">
                    <thead class="text-gray-100 bg-purple-600">
                        <tr>
                            <th class="py-3 px-4 border-b text-center">No</th>
                            <th class="py-3 px-4 border-b text-center">Nama Fakultas</th>
                            <th class="py-3 px-4 border-b text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faculties as $index => $faculty)
                            <tr>
                                <td class="py-3 px-4 text-center border-b">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $faculty->name_faculty }}</td>
                                <td class="py-3 px-4 text-center border-b">
                                    <a href="{{ route('fakultas.edit', $faculty->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                    <form action="{{ route('fakultas.destroy', $faculty->id) }}" method="POST" class="inline-block">
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
                {{ $faculties->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
