@extends('layouts.app-admin')

@section('title', 'Edit Contact')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Contact</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Contact Section -->
        <h2 class="text-xl font-bold mb-4">Contact Information</h2>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ $contact->alamat }}" required>
        </div>

        <div class="mb-4">
            <label for="no_telepon" class="block text-gray-700">No. Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ $contact->no_telepon }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ $contact->email }}" required>
        </div>

        <div class="mb-4">
            <label for="map_embed" class="block text-gray-700">Embed Map URL</label>
            <textarea name="map_embed" id="map_embed" class="w-full bg-gray-200 rounded-lg px-4 py-2" required>{{ $contact->map_embed }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">Update Contact</button>
        </div>
    </form>
</div>
@endsection
