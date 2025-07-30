@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <x-breadcrumb :links="[
            ['url' => '#', 'text' => 'Input Pembayaran'],
        ]" />

        <div class="mt-4 bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Input Pembayaran</h3>
            </div>

            <form action="{{ route('pembayaran.store') }}" method="POST" class="space-y-6" id="pembayaranForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kelas -->
                    <div>
                        <label for="id_kelas" class="block mb-2 text-sm font-medium text-gray-900">Kelas</label>
                        <select id="id_kelas" name="id_kelas"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                            required>
                            <option value="">Pilih Kelas</option>
                            @foreach($siswas->groupBy('id_kelas') as $kelasId => $siswaPerKelas)
                            <option value="{{ $kelasId }}">{{ $siswaPerKelas->first()->kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Siswa -->
                    <div>
                        <label for="id_siswa" class="block mb-2 text-sm font-medium text-gray-900">Siswa</label>
                        <select id="id_siswa" name="id_siswa"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                            required>
                            <option value="">Pilih Siswa</option>
                        </select>
                    </div>

                    <!-- Kategori Pembayaran -->
                    <div>
                        <label for="id_kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori
                            Pembayaran</label>
                        <select id="id_kategori" name="id_kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                data-is-infaq="{{ strtolower($kategori->nama_kategori) === 'infaq' ? 'true' : 'false' }}">
                                {{ $kategori->nama_kategori }} - Rp {{ number_format($kategori->nominal, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bulan Dibayar -->
                    <div>
                        <label for="bulan_dibayar" class="block mb-2 text-sm font-medium text-gray-900">Bulan
                            Dibayar</label>
                        <select id="bulan_dibayar" name="bulan_dibayar"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5">
                            <option value="">Pilih Bulan</option>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                            'September', 'Oktober', 'November', 'Desember'] as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                        @error('bulan_dibayar')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Pembayaran -->
                    <div>
                        <label for="tanggal_pembayaran" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                            Pembayaran</label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" id="tanggal_pembayaran"
                                name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', date('d/m/Y')) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5"
                                placeholder="Pilih tanggal" required>
                        </div>
                        @error('tanggal_pembayaran')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Metode Pembayaran -->
                    <div>
                        <label for="metode_pembayaran" class="block mb-2 text-sm font-medium text-gray-900">Metode
                            Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                            required>
                            <option value="">Pilih Metode</option>
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                        </select>
                        @error('metode_pembayaran')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Petugas (hidden field) -->
                <input type="hidden" name="id_petugas" value="{{ auth()->user()->id }}">

                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menangani perubahan kelas dan siswa
        document.getElementById('id_kelas').addEventListener('change', function() {
            const kelasId = this.value;
            const siswaSelect = document.getElementById('id_siswa');
            siswaSelect.innerHTML = '<option value="">Memuat siswa...</option>';
            siswaSelect.disabled = true;

            if (kelasId) {
                fetch(`{{ route('get.siswa.by.kelas', '') }}/${kelasId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';
                        data.forEach(siswa => {
                            const option = document.createElement('option');
                            option.value = siswa.id;
                            option.text = siswa.nama_siswa;
                            siswaSelect.appendChild(option);
                        });
                        siswaSelect.disabled = false;
                    })
                    .catch(error => {
                        siswaSelect.innerHTML = '<option value="">Gagal memuat siswa</option>';
                        console.error('Error:', error);
                        siswaSelect.disabled = false;
                    });
            } else {
                siswaSelect.innerHTML = '<option value="">Pilih Siswa</option>';
            }
        });

        // Fungsi untuk menangani bulan dibayar berdasarkan kategori
        const kategoriSelect = document.getElementById('id_kategori');
        const bulanSelect = document.getElementById('bulan_dibayar');

        function updateBulanField() {
            const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
            const isInfaq = selectedOption.getAttribute('data-is-infaq') === 'true';

            if (isInfaq) {
                bulanSelect.disabled = false;
                bulanSelect.setAttribute('required', 'required');
            } else {
                bulanSelect.disabled = true;
                bulanSelect.removeAttribute('required');
                bulanSelect.value = '';
            }
        }

        updateBulanField();

        kategoriSelect.addEventListener('change', updateBulanField);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Tangani submit form
        document.getElementById('pembayaranForm').addEventListener('submit', function(e) {
            // Tambahkan loading indicator jika perlu
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...`;
        });
    });
</script>
@endpush

@endsection
