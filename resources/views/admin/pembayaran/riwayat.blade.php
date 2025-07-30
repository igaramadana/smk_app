@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <x-breadcrumb :links="[
            ['url' => '#', 'text' => 'Riwayat Pembayaran'],
        ]" />

        <div class="mt-4 bg-white rounded-lg border border-bg-gray-200 p-4">
            <h3 class="text-xl font-semibold mb-4">Export Riwayat Pembayaran</h3>

            <form action="{{ route('export.riwayat.process') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori
                            Pembayaran</label>
                        <select id="kategori" name="kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Semua Kategori</option>
                            @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="bulan" class="block mb-2 text-sm font-medium text-gray-900">Bulan</label>
                        <select id="bulan" name="bulan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="">Semua Bulan</option>
                            @foreach($allBulan as $namaBulan)
                            <option value="{{ $namaBulan }}" @if(!in_array($namaBulan, $bulan)) disabled @endif>
                                {{ $namaBulan }} @if(!in_array($namaBulan, $bulan)) (Tidak tersedia) @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                    Export Excel
                </button>
            </form>
            @livewire('riwayat-table')
        </div>
    </div>
</div>
@endsection
