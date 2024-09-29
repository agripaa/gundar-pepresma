@extends('layouts.app-admin')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="max-w-full min-h-[88vh] flex flex-col justify-center items-center">
    <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Mahasiswa</h1>

        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tambah-mahasiswa') }}" method="POST">
            @csrf
            <!-- Nama dan NIM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan Nama" required>
                    @error('nama')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="nim" class="block text-gray-700">NIM</label>
                    <input type="text" id="nim" name="NIM" class="bg-gray-200 px-4 py-2 rounded-lg w-full" placeholder="Masukkan NIM" required>
                    @error('NIM')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Fakultas dan Program Studi -->
            <div class="mt-6">
                <label for="fakultas" class="block text-gray-700">Fakultas</label>
                <select id="fakultas" name="faculty_id" class="bg-gray-200 px-4 py-2 rounded-lg w-full" required>
                    <option value="">Pilih Fakultas</option>
                    @foreach ($faculties as $faculty)
                        <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                    @endforeach
                </select>
                @error('faculty_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-6">
                <label for="prodi" class="block text-gray-700">Program Studi</label>
                <select id="prodi" name="prodi_id" class="bg-gray-200 px-4 py-2 rounded-lg w-full" disabled required>
                    <option value="">Pilih Program Studi</option>
                </select>
                @error('prodi_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Tambah Data</button>
            </div>
        </form>
    </div>

    <!-- Daftar Mahasiswa -->
    <div class="bg-white w-full max-w-full p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between w-full mb-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Mahasiswa</h2>
            <form method="GET" action="{{ route('tambah-mahasiswa') }}">
                <input type="text" name="search" placeholder="Search By Nama or NIM" value="{{ $search ?? '' }}" class="bg-gray-200 px-4 py-2 rounded-lg w-full">
            </form>
        </div>
        @if($mahasiswa->isEmpty())
            <p class="text-gray-600">Belum ada data mahasiswa.</p>
        @else
            <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                <table class="w-full bg-white border border-gray-300">
                    <thead class="text-gray-100 bg-purple-600">
                        <tr>
                            <th class="py-3 px-4 border-b text-center">No</th>
                            <th class="py-3 px-4 border-b text-center">Nama</th>
                            <th class="py-3 px-4 border-b text-center">NIM</th>
                            <th class="py-3 px-4 border-b text-center">Program Studi</th>
                            <th class="py-3 px-4 border-b text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $index => $mhs)
                            <tr>
                                <td class="py-3 px-4 text-center border-b">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $mhs->nama }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $mhs->NIM }}</td>
                                <td class="py-3 px-4 text-center border-b">{{ $mhs->prodi->study_program }}</td>
                                <td class="py-3 px-4 text-center border-b">
                                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="inline-block">
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
                {{ $mahasiswa->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    document.getElementById('fakultas').addEventListener('change', function () {
        var fakultasId = this.value;
        var prodiSelect = document.getElementById('prodi');

        if (!fakultasId) {
            prodiSelect.disabled = true;
            prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';
            return;
        }

        prodiSelect.disabled = false;

        fetch(`/get-prodi-by-faculty/${fakultasId}`)
            .then(response => response.json())
            .then(data => {
                prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';
                data.forEach(prodi => {
                    var option = document.createElement('option');
                    option.value = prodi.id;
                    option.textContent = prodi.study_program;
                    prodiSelect.appendChild(option);
                });
            });
    });
</script>

@endsection
