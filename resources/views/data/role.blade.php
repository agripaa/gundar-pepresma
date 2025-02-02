@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-24">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tambah Role</h2>
    <form action="{{ url('/roles') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-3">
            <label for="role_name" class="block text-gray-700">Nama Role :</label>
            <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="name_role" name="name_role" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition">Simpan</button>
    </form>
    
</div>
@endsection
