@extends('layouts.app-admin')

@section('title', 'Manage Visitor')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Manage Visitor</h1>
</div>

@if (session('success'))
    <div class="bg-green-200 text-green-800 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Contact Table -->
<div class="mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Contact Information</h2>
        <!-- Only show the button if there's no contact -->
        @if ($contactCount < 1)
            <a href="{{ route('contact.create') }}" class="bg-purple-600 text-white py-2 px-4 rounded-lg">Tambah Contact</a>
        @endif
    </div>

    @if ($contacts->isEmpty())
        <p class="text-gray-600">Belum ada data contact.</p>
    @else
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="text-gray-200 bg-purple-600 text-left">
                        <th class="px-4 py-2 text-center">Alamat</th>
                        <th class="px-4 py-2 text-center">No. Telepon</th>
                        <th class="px-4 py-2 text-center">Email</th>
                        <th class="px-4 py-2 text-center">Map Embed</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-center">{{ $contact->alamat }}</td>
                            <td class="px-4 py-2 text-center">{{ $contact->no_telepon }}</td>
                            <td class="px-4 py-2 text-center">{{ $contact->email }}</td>
                            <td class="px-4 py-2 text-center"><a href="{{ $contact->map_embed }}" target="_blank">View Map</a></td>
                            <td class="px-4 py-2 text-center flex items-center justify-center space-x-2">
                                <a href="{{ route('contact.edit', $contact->id) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Footer Table -->
<div class="mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Footer Information</h2>
        <!-- Allow up to 5 footers -->
        @if ($footerCount < 5)
            <a href="{{ route('footer.create') }}" class="bg-purple-600 text-white py-2 px-4 rounded-lg">Tambah Footer</a>
        @endif
    </div>

    @if ($footers->isEmpty())
        <p class="text-gray-600">Belum ada data footer.</p>
    @else
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="text-gray-200 bg-purple-600 text-left">
                        <th class="px-4 py-2 text-center">Title</th>
                        <th class="px-4 py-2 text-center">List Footer</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($footers as $footer)
                        @php $rowSpan = max(1, count($footer->listFooters)); @endphp
                        <tr class="border-b">
                            <!-- Title Footer with rowspan -->
                            <td class="px-4 py-2 text-center" rowspan="{{ $rowSpan }}">{{ $footer->title_footer }}</td>
                            
                            @if ($footer->listFooters->isNotEmpty())
                                <!-- List Footer (first row) -->
                                <td class="px-4 py-2 text-center">{{ $footer->listFooters[0]->name_list }} 
                                    @if ($footer->listFooters[0]->link)
                                        (<a href="{{ $footer->listFooters[0]->link }}" target="_blank" class="text-blue-600">View</a>)
                                    @endif
                                </td>
                            @else
                                <!-- If no list footer, just display an empty row -->
                                <td class="px-4 py-2 text-center">-</td>
                            @endif

                            <!-- Actions only once -->
                            <td class="px-4 py-2 text-center flex items-center justify-center space-x-2" rowspan="{{ $rowSpan }}">
                                <a href="{{ route('footer.edit', $footer->id) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('footer.destroy', $footer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Additional rows for remaining List Footer items -->
                        @for ($i = 1; $i < count($footer->listFooters); $i++)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-center">{{ $footer->listFooters[$i]->name_list }} 
                                    @if ($footer->listFooters[$i]->link)
                                        (<a href="{{ $footer->listFooters[$i]->link }}" target="_blank" class="text-blue-600">View</a>)
                                    @endif
                                </td>
                            </tr>
                        @endfor

                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
