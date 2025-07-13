@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <x-breadcrumb :links="[
        ['url' => '#', 'text' => 'Data Master'],
        ['url' => '#', 'text' => 'Data Siswa'],
       ]" />

        <div class="mt-4 bg-white rounded-lg border border-bg-gray-200 p-4">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">Data Siswa</h3>
                <button type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah
                    Siswa</button>
            </div>
            @livewire('siswa-table')
        </div>
    </div>
</div>
@endsection
