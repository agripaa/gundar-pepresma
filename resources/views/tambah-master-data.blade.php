@extends('layouts.app-admin')

@section('content')
@php
    $kepesertaan = $kepesertaan ?? collect();
    $kategori = $kategori ?? collect();
    $prestasi = $prestasi ?? collect();
    $capaianJuara = $capaianJuara ?? collect();
    $posisi = $posisi ?? collect();

    $cards = [
        [
            'title' => 'Kepesertaan',
            'count' => $kepesertaan->count(),
            'route' => route('master-data.kepesertaan'),
            'description' => 'Jenis kepesertaan untuk lomba.',
        ],
        [
            'title' => 'Kategori Lomba',
            'count' => $kategori->count(),
            'route' => route('master-data.kategori'),
            'description' => 'Daftar kategori lomba.',
        ],
        [
            'title' => 'Prestasi',
            'count' => $prestasi->count(),
            'route' => route('master-data.prestasi'),
            'description' => 'Jenis prestasi yang tersedia.',
        ],
        [
            'title' => 'Capaian Juara',
            'count' => $capaianJuara->count(),
            'route' => route('master-data.capaian-juara'),
            'description' => 'Level capaian juara.',
        ],
        [
            'title' => 'Posisi Peserta',
            'count' => $posisi->count(),
            'route' => route('master-data.posisi'),
            'description' => 'Posisi peserta lomba.',
        ],
    ];
@endphp

<div class="container mx-auto p-6 space-y-8">
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Master Data</h1>
        <p class="text-sm text-gray-500">Pilih jenis master data untuk melihat dan mengelola detailnya.</p>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($cards as $card)
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $card['title'] }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $card['description'] }}</p>
                    </div>
                    <span class="rounded-full bg-purple-50 px-2 py-1 text-xs font-semibold text-purple-700">
                        {{ $card['count'] }} data
                    </span>
                </div>
                <div class="mt-5">
                    <a
                        href="{{ $card['route'] }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-purple-200 bg-purple-50 px-3 py-2 text-sm font-semibold text-purple-700 hover:border-purple-300 hover:bg-purple-100 transition"
                    >
                        Lihat Data
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
