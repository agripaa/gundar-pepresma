@extends('layouts.app-admin')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <a href="{{ route('tambah-master-data') }}" class="text-sm font-semibold text-purple-700 hover:text-purple-900">Kembali ke Master Data</a>
            <h1 class="mt-2 text-2xl font-semibold text-gray-800">List Kategori Lomba</h1>
            <p class="text-sm text-gray-500">Daftar kategori lomba yang tersedia.</p>
        </div>
        <button
            type="button"
            data-open-master-modal
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-purple-700 transition"
        >
            Tambah Kategori
        </button>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-600">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($kategori as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $item->kategori }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('kategori.edit', $item->id) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('kategori.delete', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus data ini?')" class="text-sm font-semibold text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-400">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="masterDataModalKategori" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-lg rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Kategori Lomba</h3>
            <button type="button" data-close-master-modal class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ url('/kategori') }}" method="POST" class="space-y-4 px-6 py-5">
            @csrf
            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Lomba</label>
                <input type="text" id="kategori" name="kategori" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200">
            </div>
            <div class="flex items-center justify-end gap-3">
                <button type="button" data-close-master-modal class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">Batal</button>
                <button type="submit" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const modalKategori = document.getElementById('masterDataModalKategori');
    const openKategoriButtons = document.querySelectorAll('[data-open-master-modal]');
    const closeKategoriButtons = document.querySelectorAll('[data-close-master-modal]');

    function openKategoriModal() {
        modalKategori.classList.remove('hidden');
        modalKategori.classList.add('flex');
    }

    function closeKategoriModal() {
        modalKategori.classList.add('hidden');
        modalKategori.classList.remove('flex');
    }

    openKategoriButtons.forEach((button) => {
        button.addEventListener('click', openKategoriModal);
    });

    closeKategoriButtons.forEach((button) => {
        button.addEventListener('click', closeKategoriModal);
    });

    modalKategori.addEventListener('click', (event) => {
        if (event.target === modalKategori) {
            closeKategoriModal();
        }
    });
</script>
@endsection
