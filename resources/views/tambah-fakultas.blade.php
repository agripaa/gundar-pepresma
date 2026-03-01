@extends('layouts.app-admin')

@section('title', 'Data Fakultas')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Data Fakultas</h1>
            <p class="text-sm text-gray-500">Kelola data fakultas yang tersedia.</p>
        </div>
        <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:items-center">
            <form method="GET" action="{{ route('fakultas.index') }}" class="w-full sm:w-64">
                <input type="text" name="search" placeholder="Cari fakultas" value="{{ $search ?? '' }}" class="w-full rounded-lg bg-gray-200 px-4 py-2 text-sm">
            </form>
            <button type="button" data-open-create-fakultas class="inline-flex items-center justify-center rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                Tambah Fakultas
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($faculties->isEmpty())
            <p class="px-6 py-6 text-gray-600">Belum ada data fakultas.</p>
        @else
            <table class="w-full border-collapse text-sm">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-center">Nama Fakultas</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faculties as $faculty)
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 text-center">{{ $faculty->name_faculty }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <button
                                        type="button"
                                        data-open-edit-fakultas
                                        data-id="{{ $faculty->id }}"
                                        data-name="{{ $faculty->name_faculty }}"
                                        class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                                    >
                                        Edit
                                    </button>
                                    <form action="{{ route('fakultas.destroy', $faculty->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800" onclick="return confirm('Hapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="border-t px-6 py-4">
                {{ $faculties->links() }}
            </div>
        @endif
    </div>
</div>

<div id="modalFakultasCreate" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-lg rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Fakultas</h3>
            <button type="button" data-close-modal="modalFakultasCreate" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('fakultas.store') }}" method="POST" class="space-y-4 px-6 py-5">
            @csrf
            <div>
                <label for="create_name_faculty" class="block text-sm font-medium text-gray-700">Nama Fakultas</label>
                <input type="text" id="create_name_faculty" name="name_faculty" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" data-close-modal="modalFakultasCreate" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalFakultasEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-lg rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Edit Fakultas</h3>
            <button type="button" data-close-modal="modalFakultasEdit" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form id="formFakultasEdit" method="POST" data-update-url="{{ url('/fakultas') }}" class="space-y-4 px-6 py-5">
            @csrf
            @method('PUT')
            <div>
                <label for="edit_name_faculty" class="block text-sm font-medium text-gray-700">Nama Fakultas</label>
                <input type="text" id="edit_name_faculty" name="name_faculty" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" data-close-modal="modalFakultasEdit" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const modalCreateFakultas = document.getElementById('modalFakultasCreate');
    const modalEditFakultas = document.getElementById('modalFakultasEdit');
    const editFakultasForm = document.getElementById('formFakultasEdit');

    function openModal(modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.querySelector('[data-open-create-fakultas]').addEventListener('click', () => {
        openModal(modalCreateFakultas);
    });

    document.querySelectorAll('[data-close-modal]').forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.closeModal;
            const target = document.getElementById(targetId);
            if (target) {
                closeModal(target);
            }
        });
    });

    [modalCreateFakultas, modalEditFakultas].forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });
    });

    document.querySelectorAll('[data-open-edit-fakultas]').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            editFakultasForm.action = `${editFakultasForm.dataset.updateUrl}/${id}`;
            document.getElementById('edit_name_faculty').value = button.dataset.name || '';
            openModal(modalEditFakultas);
        });
    });
</script>
@endsection
