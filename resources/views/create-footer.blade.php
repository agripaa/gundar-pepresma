@extends('layouts.app-admin')

@section('title', 'Create Footer')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Create Footer</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('footer.store') }}" method="POST">
        @csrf

        <!-- Footer Section -->
        <h2 class="text-xl font-bold mb-4">Footer Information</h2>

        <div class="mb-4">
            <label for="title_footer" class="block text-gray-700">Footer Title</label>
            <input type="text" name="title_footer" id="title_footer" class="w-full bg-gray-200 rounded-lg px-4 py-2" placeholder="Masukkan Judul Footer" required>
        </div>

        <!-- List Footer Items -->
        <div id="list-footer-container">
            <div class="list-footer-item mb-4">
                <label for="list_footer[0][name_list]" class="block text-gray-700">Footer Item 1</label>
                <input type="text" name="list_footer[0][name_list]" class="w-full bg-gray-200 rounded-lg px-4 py-2" placeholder="Footer Item Name" required>

                <label for="list_footer[0][link]" class="block text-gray-700 mt-2">Link (Optional)</label>
                <input type="url" name="list_footer[0][link]" class="w-full bg-gray-200 rounded-lg px-4 py-2" placeholder="https://example.com">
            </div>
        </div>

        <button type="button" id="add-footer-item" class="bg-blue-500 text-white py-2 px-4 rounded-lg mb-4">Add Footer Item</button>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">Create Footer</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let footerItemIndex = 1;
    
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
