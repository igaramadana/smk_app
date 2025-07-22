@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <x-breadcrumb :links="[
        ['url' => '#', 'text' => 'Kategori Pembayaran'],
       ]" />

        <div class="mt-4 bg-white rounded-lg border border-bg-gray-200 p-4">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">Riwayat Pembayaran</h3>
            </div>
            @livewire('riwayat-table')
        </div>
    </div>
</div>
@endsection
