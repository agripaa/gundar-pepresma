@extends('layouts.app-admin')

@section('title', 'Data Program Studi')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Data Program Studi</h1>
            <p class="text-sm text-gray-500">Kelola data program studi.</p>
        </div>
        <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row sm:items-center">
            <form method="GET" action="{{ route('prodi.index') }}" class="w-full sm:w-64">
                <input type="text" name="search" placeholder="Cari prodi atau kode" value="{{ $search ?? '' }}" class="w-full rounded-lg bg-gray-200 px-4 py-2 text-sm">
            </form>
            <button type="button" data-open-create-prodi class="inline-flex items-center justify-center rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                Tambah Program Studi
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        @if($prodis->isEmpty())
            <p class="px-6 py-6 text-gray-600">Belum ada data program studi.</p>
        @else
            <table class="w-full border-collapse text-sm">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-center">Program Studi</th>
                        <th class="py-3 px-4 text-center">Kode</th>
                        <th class="py-3 px-4 text-center">Jenjang</th>
                        <th class="py-3 px-4 text-center">Fakultas</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prodis as $prodi)
                        <tr class="border-b">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 text-center">{{ $prodi->study_program }}</td>
                            <td class="py-3 px-4 text-center">{{ $prodi->study_program_code }}</td>
                            <td class="py-3 px-4 text-center">{{ $prodi->study_program_level }}</td>
                            <td class="py-3 px-4 text-center">{{ $prodi->facultyRelation->name_faculty }}</td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <button
                                        type="button"
                                        data-open-edit-prodi
                                        data-id="{{ $prodi->id }}"
                                        data-study-program="{{ $prodi->study_program }}"
                                        data-code="{{ $prodi->study_program_code }}"
                                        data-level="{{ $prodi->study_program_level }}"
                                        data-faculty="{{ $prodi->faculty }}"
                                        class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                                    >
                                        Edit
                                    </button>
                                    <form action="{{ route('prodi.destroy', $prodi->id) }}" method="POST" class="inline">
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
                {{ $prodis->links() }}
            </div>
        @endif
    </div>
</div>

<div id="modalProdiCreate" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-2xl rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Tambah Program Studi</h3>
            <button type="button" data-close-modal="modalProdiCreate" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form action="{{ route('prodi.store') }}" method="POST" class="space-y-4 px-6 py-5">
            @csrf
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="create_program" class="block text-sm font-medium text-gray-700">Nama Program Studi</label>
                    <input type="text" id="create_program" name="study_program" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="create_code" class="block text-sm font-medium text-gray-700">Kode Program Studi</label>
                    <input type="text" id="create_code" name="study_program_code" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="create_level" class="block text-sm font-medium text-gray-700">Jenjang</label>
                    <select id="create_level" name="study_program_level" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                        <option value="">Pilih Jenjang</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
                <div>
                    <label for="create_faculty" class="block text-sm font-medium text-gray-700">Fakultas</label>
                    <select id="create_faculty" name="faculty" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                        <option value="">Pilih Fakultas</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" data-close-modal="modalProdiCreate" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-semibold text-white hover:bg-purple-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalProdiEdit" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-2xl rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Edit Program Studi</h3>
            <button type="button" data-close-modal="modalProdiEdit" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form id="formProdiEdit" method="POST" data-update-url="{{ url('/prodi') }}" class="space-y-4 px-6 py-5">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="edit_program" class="block text-sm font-medium text-gray-700">Nama Program Studi</label>
                    <input type="text" id="edit_program" name="study_program" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="edit_code" class="block text-sm font-medium text-gray-700">Kode Program Studi</label>
                    <input type="text" id="edit_code" name="study_program_code" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="edit_level" class="block text-sm font-medium text-gray-700">Jenjang</label>
                    <select id="edit_level" name="study_program_level" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                        <option value="">Pilih Jenjang</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
                <div>
                    <label for="edit_faculty" class="block text-sm font-medium text-gray-700">Fakultas</label>
                    <select id="edit_faculty" name="faculty" required class="mt-2 w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                        <option value="">Pilih Fakultas</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name_faculty }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 pt-2">
                <button type="button" data-close-modal="modalProdiEdit" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100">
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
    const modalCreateProdi = document.getElementById('modalProdiCreate');
    const modalEditProdi = document.getElementById('modalProdiEdit');
    const editProdiForm = document.getElementById('formProdiEdit');

    function openModal(modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.querySelector('[data-open-create-prodi]').addEventListener('click', () => {
        openModal(modalCreateProdi);
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

    [modalCreateProdi, modalEditProdi].forEach((modal) => {
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });
    });

    document.querySelectorAll('[data-open-edit-prodi]').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            editProdiForm.action = `${editProdiForm.dataset.updateUrl}/${id}`;
            document.getElementById('edit_program').value = button.dataset.studyProgram || '';
            document.getElementById('edit_code').value = button.dataset.code || '';
            document.getElementById('edit_level').value = button.dataset.level || '';
            document.getElementById('edit_faculty').value = button.dataset.faculty || '';
            openModal(modalEditProdi);
        });
    });
</script>
@endsection
