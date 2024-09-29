@extends('layouts.app-admin')

@section('title', 'Laporan Prestasi Mahasiswa/i')

@section('content')
<div class="max-w-full min-h-[88vh] flex justify-start items-center">
    <div class="bg-white w-full h-full p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-12">Laporan Prestasi Mahasiswa/i</h1>
        <div>
            <canvas id="prestasiChart" class="w-full"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('prestasiChart').getContext('2d');
        var prestasiData = @json($prestasiData); 

        var labels = prestasiData.map(item => item.bulan);
        var data = prestasiData.map(item => item.jumlah);

        var chart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Prestasi Mahasiswa per Bulan',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
    });
</script>
@endsection
