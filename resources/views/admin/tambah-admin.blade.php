@extends('layouts.app-admin')

@section('title', 'Add Admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full mx-auto">
    <h3 class="text-xl font-semibold mb-4">Tambah Admin</h3>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Save</button>
    </form>
</div>
@endsection
