@extends('layouts.app-admin')

@section('title', 'Edit Admin')

@section('content')
<div class="max-w-full min-h-[88vh] flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full mx-auto">
        <h3 class="text-xl font-semibold mb-4">Edit Admin</h3>
        <form action="{{ route('admin.update', $admin->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded-lg" value="{{ $admin->username }}" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 border rounded-lg" value="{{ $admin->email }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password (leave blank if not changing)</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg">Update</button>
        </form>
    </div>
</div>
@endsection
