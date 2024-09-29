@extends('layouts.app-admin')

@section('title', 'Edit Visitor')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Visitor</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('visitor.update', $visitor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Contact Section -->
        <h2 class="text-xl font-bold mb-4">Contact Information</h2>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ old('alamat', $visitor->contact->alamat) }}" required>
        </div>

        <div class="mb-4">
            <label for="no_telepon" class="block text-gray-700">No. Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ old('no_telepon', $visitor->contact->no_telepon) }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ old('email', $visitor->contact->email) }}" required>
        </div>

        <div class="mb-4">
            <label for="map_embed" class="block text-gray-700">Embed Map URL</label>
            <textarea name="map_embed" id="map_embed" class="w-full bg-gray-200 rounded-lg px-4 py-2" required>{{ old('map_embed', $visitor->contact->map_embed) }}</textarea>
        </div>

        <!-- Footer Section -->
        <h2 class="text-xl font-bold mb-4">Footer Information</h2>

        <div class="mb-4">
            <label for="title_footer" class="block text-gray-700">Footer Title</label>
            <input type="text" name="title_footer" id="title_footer" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ old('title_footer', $visitor->footer->title_footer) }}" required>
        </div>

        <!-- List Footer Items -->
        <div id="list-footer-container">
            @foreach($visitor->footer->listFooters as $index => $listFooter)
                <div class="list-footer-item mb-4">
                    <label for="list_footer[{{ $index }}][name_list]" class="block text-gray-700">Footer Item {{ $index + 1 }}</label>
                    <input type="text" name="list_footer[{{ $index }}][name_list]" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ old("list_footer.$index.name_list", $listFooter->name_list) }}" required>

                    <label for="list_footer[{{ $index }}][link]" class="block text-gray-700 mt-2">Link (Optional)</label>
                    <input type="url" name="list_footer[{{ $index }}][link]" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ old("list_footer.$index.link", $listFooter->link) }}">
                </div>
            @endforeach
        </div>

        <button type="button" id="add-footer-item" class="bg-blue-500 text-white py-2 px-4 rounded-lg mb-4">Add Footer Item</button>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">Update Visitor</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let footerItemIndex = {{ count($visitor->footer->listFooters) }};
    
    document.getElementById('add-footer-item').addEventListener('click', function () {
        const newItem = document.createElement('div');
        newItem.classList.add('list-footer-item', 'mb-4');
        newItem.innerHTML = `
            <label for="list_footer[${footerItemIndex}][name_list]" class="block text-gray-700">Footer Item ${footerItemIndex + 1}</label>
            <input type="text" name="list_footer[${footerItemIndex}][name_list]" class="w-full bg-gray-200 rounded-lg px-4 py-2" placeholder="Footer Item Name" required>
            <label for="list_footer[${footerItemIndex}][link]" class="block text-gray-700 mt-2">Link (Optional)</label>
            <input type="url" name="list_footer[${footerItemIndex}][link]" class="w-full bg-gray-200 rounded-lg px-4 py-2" placeholder="https://example.com">
        `;
        document.getElementById('list-footer-container').appendChild(newItem);
        footerItemIndex++;
    });
});
</script>
@endsection
