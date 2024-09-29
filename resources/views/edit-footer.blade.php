@extends('layouts.app-admin')

@section('title', 'Edit Footer')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Footer</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('footer.update', $footer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Footer Section -->
        <h2 class="text-xl font-bold mb-4">Footer Information</h2>

        <div class="mb-4">
            <label for="title_footer" class="block text-gray-700">Footer Title</label>
            <input type="text" name="title_footer" id="title_footer" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ $footer->title_footer }}" required>
        </div>

        <!-- List Footer Items -->
        <div id="list-footer-container">
            @foreach($footer->listFooters as $index => $listFooter)
                <div class="list-footer-item mb-4" id="footer-item-{{ $listFooter->id }}">
                    <input type="hidden" name="list_footer[{{ $index }}][id]" value="{{ $listFooter->id }}">
                    <label for="list_footer[{{ $index }}][name_list]" class="block text-gray-700">Footer Item {{ $index + 1 }}</label>
                    <input type="text" name="list_footer[{{ $index }}][name_list]" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ $listFooter->name_list }}" required>

                    <label for="list_footer[{{ $index }}][link]" class="block text-gray-700 mt-2">Link (Optional)</label>
                    <input type="url" name="list_footer[{{ $index }}][link]" class="w-full bg-gray-200 rounded-lg px-4 py-2" value="{{ $listFooter->link }}">

                    <!-- Delete Button for ListFooter -->
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2 delete-footer-item" data-id="{{ $listFooter->id }}">Delete</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-footer-item" class="bg-blue-500 text-white py-2 px-4 rounded-lg mb-4">Add Footer Item</button>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg">Update Footer</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let footerItemIndex = {{ count($footer->listFooters) }};

    // Add new footer item
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

    // Delete footer item (only on frontend)
    document.querySelectorAll('.delete-footer-item').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            // Hide the item
            const item = document.getElementById(`footer-item-${id}`);
            item.style.display = 'none';

            // Add hidden input to mark the item for deletion
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `delete_list_footer[]`;
            input.value = id;
            item.appendChild(input);
        });
    });
});
</script>
@endsection
