@extends('layouts.app-admin')

@section('title', 'Detail Prestasi')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <a href="{{ route('list-prestasi') }}" class="text-sm font-semibold text-purple-700 hover:text-purple-900">Kembali ke List Prestasi</a>
            <h1 class="mt-2 text-2xl font-semibold text-gray-800">Detail Prestasi</h1>
            <p class="text-sm text-gray-500">{{ $prestasi->nama_kegiatan ?? '-' }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('prestasi.edit', $prestasi->id) }}" class="rounded-lg bg-yellow-500 px-4 py-2 text-sm font-semibold text-white hover:bg-yellow-600">Edit</a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Informasi Utama</h2>
            <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Mahasiswa</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'mahasiswa.nama', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">NIM</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'mahasiswa.NIM', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Program Studi</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'mahasiswa.prodi.study_program', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Dosen Pendamping</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'dosenPembimbing.nama', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Kategori</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'kategori.kategori', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Kepesertaan</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'kepesertaan.jenis_kepesertaan', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Jenis Prestasi</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'jenisPrestasi.prestasi', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Capaian</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'capaian.jenis_juara', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Posisi</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ data_get($prestasi, 'posisi.posisi', '-') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Tanggal Mulai</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ $prestasi->tanggal_mulai ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase text-gray-400">Tanggal Selesai</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ $prestasi->tanggal_selesai ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase text-gray-400">Judul Program / Karya</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ $prestasi->judul_karya ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase text-gray-400">Lokasi Kegiatan</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ $prestasi->lokasi_kegiatan ?? '-' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold uppercase text-gray-400">Penyelenggara</dt>
                    <dd class="mt-1 text-sm text-gray-800">{{ $prestasi->nama_penyelenggara ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Ringkasan Partisipasi</h2>
            <dl class="mt-4 space-y-3 text-sm text-gray-700">
                <div class="flex items-center justify-between">
                    <span>Jumlah Negara</span>
                    <span class="font-semibold">{{ data_get($prestasi, 'partisipan.jumlah_partisipan_negara', '-') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Jumlah Peserta</span>
                    <span class="font-semibold">{{ data_get($prestasi, 'partisipan.jumlah_partisipan_peserta', '-') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Jumlah Tim</span>
                    <span class="font-semibold">{{ data_get($prestasi, 'partisipan.jumlah_partisipan_team', '-') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Jumlah Perguruan Tinggi</span>
                    <span class="font-semibold">{{ data_get($prestasi, 'partisipan.jumlah_partisipan_kampus', '-') }}</span>
                </div>
                <div class="pt-4">
                    <p class="text-xs font-semibold uppercase text-gray-400">Nomor Surat Tugas</p>
                    <p class="mt-1 text-sm text-gray-800">{{ $prestasi->nomor_surat_tugas ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase text-gray-400">Tanggal Surat Tugas</p>
                    <p class="mt-1 text-sm text-gray-800">{{ $prestasi->tanggal_surat_tugas ?? '-' }}</p>
                </div>
            </dl>
        </div>
    </div>

    <div id="lampiran" class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-800">Lampiran</h2>
        @if (empty($files))
            <p class="mt-4 text-sm text-gray-500">Lampiran belum tersedia.</p>
        @else
            <div class="mt-4 grid grid-cols-1 gap-6 lg:grid-cols-2">
                @foreach ($files as $file)
                    <div class="rounded-lg border border-gray-200 p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gray-800">{{ $file['label'] }}</h3>
                            <a href="{{ $file['url'] }}" target="_blank" class="text-sm font-semibold text-purple-600 hover:text-purple-800">Buka</a>
                        </div>
                        <div class="mt-3">
                            @if ($file['type'] === 'image')
                                <img src="{{ $file['url'] }}" alt="{{ $file['label'] }}" class="h-56 w-full rounded-md object-contain bg-gray-50">
                            @else
                                <iframe src="{{ $file['url'] }}" class="h-56 w-full rounded-md border" title="{{ $file['label'] }}"></iframe>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @if ($prestasi->keterangan)
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Keterangan</h2>
            <p class="mt-3 text-sm text-gray-700">{{ $prestasi->keterangan }}</p>
        </div>
    @endif
</div>
@endsection
