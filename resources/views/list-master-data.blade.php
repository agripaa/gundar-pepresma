@extends('layouts.app-admin')

@section('title', 'List Master Data')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">List Data Master</h2>

    <h3 class="text-xl font-semibold text-gray-700 mb-4">Data Kepesertaan</h3>
    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-center">No</th>
                <th class="py-2 px-4 text-center">Jenis Kepesertaan</th>
                <th class="py-2 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kepesertaan as $index => $item)
            <tr class="border-b">
                <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->jenis_kepesertaan }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ url('/kepesertaan/edit', $item->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded-lg">Edit</a>
                    <form action="{{ route('kepesertaan.delete', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-xl font-semibold text-gray-700 mt-8 mb-4">Data Kategori Lomba</h3>
    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-center">No</th>
                <th class="py-2 px-4 text-center">Kategori</th>
                <th class="py-2 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $index => $item)
            <tr class="border-b">
                <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->kategori }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ url('/kategori/edit', $item->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded-lg">Edit</a>
                    <form action="{{ route('kategori.delete', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="text-xl font-semibold text-gray-700 mt-8 mb-4">Data Prestasi</h3>
    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-center">No</th>
                <th class="py-2 px-4 text-center">Jenis Prestasi</th>
                <th class="py-2 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestasi as $index => $item)
            <tr class="border-b">
                <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->prestasi }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ url('/prestasi/edit', $item->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded-lg">Edit</a>
                    <form action="{{ route('prestasi.delete', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Table Capaian Juara -->
    <h3 class="text-xl font-semibold text-gray-700 mt-8 mb-4">Data Capaian Juara</h3>
    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-center">No</th>
                <th class="py-2 px-4 text-center">Jenis Juara</th>
                <th class="py-2 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($capaianJuara as $index => $item)
            <tr class="border-b">
                <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->jenis_juara }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ url('/juara/edit', $item->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded-lg">Edit</a>
                    <form action="{{ route('juara.delete', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Table Posisi -->
    <h3 class="text-xl font-semibold text-gray-700 mt-8 mb-4">Data Posisi Peserta</h3>
    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-center">No</th>
                <th class="py-2 px-4 text-center">Posisi</th>
                <th class="py-2 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posisi as $index => $item)
            <tr class="border-b">
                <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 text-center">{{ $item->posisi }}</td>
                <td class="py-2 px-4 text-center">
                    <a href="{{ url('/posisi/edit', $item->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded-lg">Edit</a>
                    <form action="{{ route('posisi.delete', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
