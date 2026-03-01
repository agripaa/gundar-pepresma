@extends('layouts.app-admin')

@section('title', 'Data Dosen Pembimbing')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Data Dosen Pembimbing</h1>
            <p class="text-sm text-gray-500">Kelola data dosen pembimbing.</p>
        </div>
        <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:items-center">
            <form method="GET" action="{{ route('dospem.index') }}" class="w-full sm:w-64">
                <input type="text" name="search" placeholder="Cari nama atau NIDN" value="{{ $search ?? '' }}" class="w-full rounded-lg bg-gray-200 px-4 py-2 text-sm">
            </form>
            <button type="button" data-open-create-dospem class="inline-flex items-center justify-center rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                Tambah Dosen
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($dosenPembimbing->isEmpty())
            <p class="px-6 py-6 text-gray-600">Belum ada data dosen pembimbing.</p>
        @else
            <table class="w-full border-collapse text-sm">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-center">Nama</th>
                        <th class="py-3 px-4 text-center">NIDN</th>
                        <th class="py-3 px-4 text-center">NIP</th>
                        <th class="py-3 px-4 text-center">NUPTK</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosenPembimbing as $dosen)
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 text-center">{{ $dosen->nama }}</td>
                            <td class="py-3 px-4 text-center">{{ $dosen->NIDN }}</td>
                            <td class="py-3 px-4 text-center">{{ $dosen->NIP }}</td>
                            <td class="py-3 px-4 text-center">{{ $dosen->NUPTK }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <button
                                        type="button"
                                        data-open-edit-dospem
                                        data-id="{{ $dosen->id }}"
                                        data-nama="{{ $dosen->nama }}"
                                        data-nidn="{{ $dosen->NIDN }}"
                                        data-nip="{{ $dosen->NIP }}"
                                        data-nuptk="{{ $dosen->NUPTK }}"
                                        class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                                    >
                                        Edit
                                    </button>
                                    <form action="{{ route('dospem.destroy', $dosen->id) }}" method="POST" class="inline">
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
                {{ $dosenPembimbing->links() }}
            </div>
        @endif
    </div>
</div>

<div id="modalDospemCreate" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-xl rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Dosen Pembimbing</h3>
            <button type="button" data-close-modal="modalDospemCreate" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('dospem.store') }}" method="POST" class="space-y-4 px-6 py-5">
            @csrf
            <div>
                <label for="create_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="create_nama" name="nama" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="create_nidn" class="block text-sm font-medium text-gray-700">NIDN</label>
                    <input type="number" id="create_nidn" name="nidn" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="create_nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="number" id="create_nip" name="nip" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="create_nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                    <input type="number" id="create_nuptk" name="nuptk" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" data-close-modal="modalDospemCreate" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalDospemEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-xl rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Edit Dosen Pembimbing</h3>
            <button type="button" data-close-modal="modalDospemEdit" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form id="formDospemEdit" method="POST" data-update-url="{{ url('/dospem') }}" class="space-y-4 px-6 py-5">
            @csrf
            @method('PUT')
            <div>
                <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="edit_nama" name="nama" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="edit_nidn" class="block text-sm font-medium text-gray-700">NIDN</label>
                    <input type="number" id="edit_nidn" name="nidn" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="edit_nip" class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="number" id="edit_nip" name="nip" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="edit_nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                    <input type="number" id="edit_nuptk" name="nuptk" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" data-close-modal="modalDospemEdit" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">
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
    const modalCreateDospem = document.getElementById('modalDospemCreate');
    const modalEditDospem = document.getElementById('modalDospemEdit');
    const editDospemForm = document.getElementById('formDospemEdit');

    function openModal(modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.querySelector('[data-open-create-dospem]').addEventListener('click', () => {
        openModal(modalCreateDospem);
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

    [modalCreateDospem, modalEditDospem].forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });
    });

    document.querySelectorAll('[data-open-edit-dospem]').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            editDospemForm.action = `${editDospemForm.dataset.updateUrl}/${id}`;
            document.getElementById('edit_nama').value = button.dataset.nama || '';
            document.getElementById('edit_nidn').value = button.dataset.nidn || '';
            document.getElementById('edit_nip').value = button.dataset.nip || '';
            document.getElementById('edit_nuptk').value = button.dataset.nuptk || '';
            openModal(modalEditDospem);
        });
    });
</script>
@endsection
