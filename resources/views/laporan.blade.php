@extends('layouts.app-admin')

@section('title', 'Laporan Prestasi Mahasiswa/i')

@section('content')
<div class="container mx-auto p-6 space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Laporan Prestasi Mahasiswa/i</h1>
        <p class="text-sm text-gray-500">Ringkasan data dan statistik prestasi.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase text-gray-400">Total Prestasi</p>
            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $stats['prestasi'] }}</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase text-gray-400">Mahasiswa</p>
            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $stats['mahasiswa'] }}</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase text-gray-400">Dosen Pembimbing</p>
            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $stats['dosen'] }}</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase text-gray-400">Fakultas</p>
            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $stats['fakultas'] }}</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase text-gray-400">Program Studi</p>
            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $stats['prodi'] }}</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase text-gray-400">Kategori Lomba</p>
            <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $stats['kategori'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Prestasi per Bulan</h2>
            <div class="mt-4">
                <canvas id="prestasiChart" class="w-full"></canvas>
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Prestasi per Kategori</h2>
            <div class="mt-4">
                <canvas id="kategoriChart" class="w-full"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const prestasiData = @json($prestasiData);
        const kategoriData = @json($prestasiByKategori);

        const labels = prestasiData.map(item => item.bulan);
        const data = prestasiData.map(item => item.jumlah);

        const ctx = document.getElementById('prestasiChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Prestasi Mahasiswa per Bulan',
                    data: data,
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        const kategoriLabels = kategoriData.map(item => item.kategori);
        const kategoriValues = kategoriData.map(item => item.jumlah);

        const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
        new Chart(kategoriCtx, {
            type: 'doughnut',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    label: 'Prestasi per Kategori',
                    data: kategoriValues,
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(14, 165, 233, 0.7)',
                        'rgba(168, 85, 247, 0.7)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endsection
