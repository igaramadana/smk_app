@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <!-- Total Dana -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Total Dana</h3>
                    <div class="p-3 rounded-full bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-semibold text-gray-700">Rp {{ number_format($totalDana, 0, ',', '.') }}</p>
            </div>

            <!-- Total Siswa -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Total Siswa</h3>
                    <div class="p-3 rounded-full bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-semibold text-gray-700">{{ $totalSiswa }}</p>
            </div>

            <!-- Total Kategori -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Total Kelas</h3>
                    <div class="p-3 rounded-full bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-semibold text-gray-700">{{ $totalKategori }}</p>
            </div>
        </div>

        <!-- Grafik Keuangan -->
        <div class="flex flex-col p-6 mb-4 rounded-sm bg-white shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-700">Grafik Keuangan Tahunan</h3>
            </div>
            <div class="flex-1">
                <canvas id="financeChart" height="300"></canvas>
            </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="flex flex-col p-6 rounded-sm bg-white shadow h-80">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Transaksi Terakhir</h3>
                <div class="overflow-y-auto">
                    @foreach($transaksiTerakhir as $transaksi)
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-700">
                                Pembayaran {{ $transaksi->kategori->nama_kategori ?? 'Kategori Tidak Diketahui' }} -
                                {{ $transaksi->siswa->nama_siswa ?? 'Siswa Tidak Diketahui' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ date('d M Y', strtotime($transaksi->tanggal_pembayaran)) }}
                            </p>
                        </div>
                        <p class="font-medium text-green-600">
                            + Rp {{ number_format($transaksi->kategori->nominal ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari controller
        const ctx = document.getElementById('financeChart').getContext('2d');
        const dataBulanan = @json($dataBulanan);
        const namaBulan = @json($namaBulan);
        const tahunIni = @json($tahunIni);

        // Buat grafik
        const financeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: namaBulan,
                datasets: [{
                    label: `Pemasukan Tahun ${tahunIni}`,
                    data: dataBulanan,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += 'Rp ' + context.raw.toLocaleString();
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Fungsi untuk update grafik berdasarkan tahun
        document.getElementById('tahunSelect').addEventListener('change', function() {
            const tahun = this.value;

            fetch(`/admin/dashboard/data?tahun=${tahun}`)
                .then(response => response.json())
                .then(data => {
                    financeChart.data.datasets[0].label = `Pemasukan Tahun ${tahun}`;
                    financeChart.data.datasets[0].data = data.dataBulanan;
                    financeChart.update();
                });
        });
    });
</script>
@endpush
