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
                <p class="mt-4 text-2xl font-semibold text-gray-700">Rp 25.450.000</p>
                <p class="mt-1 text-sm text-green-600">+2.5% dari bulan lalu</p>
            </div>

            <!-- Pengeluaran Bulan Ini -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Pengeluaran</h3>
                    <div class="p-3 rounded-full bg-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-semibold text-gray-700">Rp 8.750.000</p>
                <p class="mt-1 text-sm text-red-600">+15% dari bulan lalu</p>
            </div>

            <!-- Pemasukan Bulan Ini -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-500">Pemasukan</h3>
                    <div class="p-3 rounded-full bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <p class="mt-4 text-2xl font-semibold text-gray-700">Rp 12.500.000</p>
                <p class="mt-1 text-sm text-green-600">+8% dari bulan lalu</p>
            </div>
        </div>

        <!-- Grafik Keuangan -->
        <div class="flex flex-col p-6 mb-4 rounded-sm bg-white shadow h-48">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-700">Grafik Keuangan Tahunan</h3>
                <select
                    class="text-sm border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Tahun 2023</option>
                    <option>Tahun 2022</option>
                    <option>Tahun 2021</option>
                </select>
            </div>
            <div class="flex-1 flex items-center justify-center bg-gray-50 rounded">
                <p class="text-gray-400">Grafik akan ditampilkan di sini</p>
            </div>
        </div>

        <!-- Transaksi Terakhir & Anggaran -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <!-- Transaksi Terakhir -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow h-80">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Transaksi Terakhir</h3>
                <div class="overflow-y-auto">
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-700">Pembelian Buku</p>
                            <p class="text-sm text-gray-500">12 Jan 2023</p>
                        </div>
                        <p class="font-medium text-red-600">- Rp 1.250.000</p>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-700">SPP Kelas 1</p>
                            <p class="text-sm text-gray-500">10 Jan 2023</p>
                        </div>
                        <p class="font-medium text-green-600">+ Rp 3.500.000</p>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-700">Perbaikan Meja</p>
                            <p class="text-sm text-gray-500">8 Jan 2023</p>
                        </div>
                        <p class="font-medium text-red-600">- Rp 750.000</p>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <p class="font-medium text-gray-700">Dana BOS</p>
                            <p class="text-sm text-gray-500">5 Jan 2023</p>
                        </div>
                        <p class="font-medium text-green-600">+ Rp 8.000.000</p>
                    </div>
                </div>
            </div>

            <!-- Status Anggaran -->
            <div class="flex flex-col p-6 rounded-sm bg-white shadow h-80">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Status Anggaran</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Dana Pendidikan</span>
                            <span class="text-sm font-medium text-gray-700">65%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Dana Operasional</span>
                            <span class="text-sm font-medium text-gray-700">45%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Dana Perawatan</span>
                            <span class="text-sm font-medium text-gray-700">30%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Dana Kegiatan</span>
                            <span class="text-sm font-medium text-gray-700">20%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-red-600 h-2.5 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Cepat -->
        <div class="flex flex-col p-6 mb-4 rounded-sm bg-white shadow">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Laporan Cepat</h3>
            <div class="grid grid-cols-4 gap-4">
                <button
                    class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded hover:bg-blue-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm text-gray-700">Laporan Bulanan</span>
                </button>
                <button
                    class="flex flex-col items-center justify-center p-4 bg-green-50 rounded hover:bg-green-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm text-gray-700">Laporan Keuangan</span>
                </button>
                <button
                    class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded hover:bg-yellow-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="text-sm text-gray-700">Laporan SPP</span>
                </button>
                <button
                    class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded hover:bg-purple-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                    </svg>
                    <span class="text-sm text-gray-700">Laporan Pengeluaran</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
