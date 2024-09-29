@extends('layouts.app-admin')

@section('title', 'Tambah Dosen Pembimbing')

@section('content')
<div class="max-w-full min-h-[88vh] flex flex-col justify-center items-center">
    <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Dosen Pembimbing</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tambah-dospem') }}" method="POST">
            @csrf <!-- Token CSRF untuk keamanan -->

            <div>
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan Nama" required>
            </div>

            <div class="mt-6">
                <label for="nidn" class="block text-gray-700">NIDN</label>
                <input type="number" id="nidn" name="nidn" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan NIDN" required>
            </div>

            <div class="mt-6">
                <label for="nip" class="block text-gray-700">NIP</label>
                <input type="number" id="nip" name="nip" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan NIP" required>
            </div>

            <div class="mt-6">
                <label for="nuptk" class="block text-gray-700">NUPTK</label>
                <input type="number" id="nuptk" name="nuptk" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan NUPTK" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Tambah Data</button>
            </div>
        </form>
    </div>

    <!-- Search Bar -->
    
    <!-- Daftar Dosen Pembimbing -->
    <div class="bg-white w-full max-w-full p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between w-full mb-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Dosen Pembimbing</h2>
            <form method="GET" action="{{ route('tambah-dospem') }}">
                <input type="text" name="search" placeholder="Search By Nama or NIDN" value="{{ $search ?? '' }}" class="bg-gray-200 px-4 py-2 rounded-lg w-full">
            </form>
        </div>
        
        @if($dosenPembimbing->isEmpty())
            <p class="text-gray-600">Belum ada data dosen pembimbing.</p>
        @else
            <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                <table class="w-full bg-white border border-gray-300">
                    <thead class="text-gray-100 bg-purple-600">
                        <tr>
                            <th class="py-3 px-4 border-b text-center">No</th>
                            <th class="py-3 px-4 border-b text-center">Nama</th>
                            <th class="py-3 px-4 border-b text-center">NIDN</th>
                            <th class="py-3 px-4 border-b text-center">NIP</th>
                            <th class="py-3 px-4 border-b text-center">NUPTK</th>
                            <th class="py-3 px-4 border-b text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dosenPembimbing as $index => $dosen)
                            <tr>
                                <td class="py-3 px-4 text-center border-b">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $dosen->nama }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $dosen->NIDN }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $dosen->NIP }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $dosen->NUPTK }}</td>
                                <td class="py-3 px-4 text-center border-b">
                                    <a href="{{ route('dospem.edit', $dosen->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                    <form action="{{ route('dospem.destroy', $dosen->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $dosenPembimbing->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
