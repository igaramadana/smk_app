@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 rounded-lg mt-14">
        <x-breadcrumb :links="[
            ['url' => '#', 'text' => 'Input Pembayaran'],
        ]" />

        <div class="mt-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-lg border border-green-100 p-8">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8 space-y-4 lg:space-y-0">
                <div>
                    <h3 class="text-3xl font-bold text-green-800 mb-2">Input Pembayaran</h3>
                    <p class="text-green-600">Kelola pembayaran siswa dengan mudah</p>
                </div>
                <button type="button" id="addRowBtn"
                    class="text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-3 text-center inline-flex items-center shadow-lg transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    Tambah Baris
                </button>
            </div>

            <!-- Total Summary Card -->
            <div class="mb-8 bg-white rounded-xl shadow-md border border-green-200 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">Total Pembayaran</h4>
                            <p class="text-sm text-gray-600">Jumlah keseluruhan yang akan dibayar</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-green-700" id="totalAmount">Rp 0</div>
                        <div class="text-sm text-green-600" id="totalRows">0 item</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('pembayaran.store') }}" method="POST" class="space-y-6" id="pembayaranForm">
                @csrf

                <!-- Container untuk baris pembayaran -->
                <div id="paymentRowsContainer" class="space-y-6">
                    <!-- Baris pertama -->
                    <div class="payment-row bg-white rounded-xl shadow-md border border-green-100 p-6 transition-all duration-200 hover:shadow-lg">
                        <div class="flex justify-between items-center mb-6">
                            <h5 class="text-lg font-semibold text-green-800 flex items-center">
                                <div class="bg-green-100 rounded-full w-8 h-8 flex items-center justify-center mr-3">
                                    <span class="text-sm font-bold text-green-700">1</span>
                                </div>
                                Pembayaran #1
                            </h5>
                            <button type="button"
                                class="remove-row-btn text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center shadow-md transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                </svg>
                                Hapus
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Kelas -->
                            <div class="space-y-2">
                                <label for="id_kelas_0" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Kelas
                                    </span>
                                </label>
                                <select id="id_kelas_0" name="payments[0][id_kelas]"
                                    class="bg-green-50 border border-green-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 kelas-select transition-colors duration-200 hover:bg-green-100"
                                    required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($siswas->groupBy('id_kelas') as $kelasId => $siswaPerKelas)
                                    <option value="{{ $kelasId }}">{{ $siswaPerKelas->first()->kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Siswa -->
                            <div class="space-y-2">
                                <label for="id_siswa_0" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Siswa
                                    </span>
                                </label>
                                <select id="id_siswa_0" name="payments[0][id_siswa]"
                                    class="bg-green-50 border border-green-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 siswa-select transition-colors duration-200 hover:bg-green-100"
                                    required>
                                    <option value="">Pilih Siswa</option>
                                </select>
                            </div>

                            <!-- Kategori Pembayaran -->
                            <div class="space-y-2">
                                <label for="id_kategori_0" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        Kategori Pembayaran
                                    </span>
                                </label>
                                <select id="id_kategori_0" name="payments[0][id_kategori]"
                                    class="bg-green-50 border border-green-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 kategori-select transition-colors duration-200 hover:bg-green-100"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        data-nominal="{{ $kategori->nominal }}"
                                        data-is-infaq="{{ strtolower($kategori->nama_kategori) === 'infaq' ? 'true' : 'false' }}">
                                        {{ $kategori->nama_kategori }} - Rp {{ number_format($kategori->nominal, 0, ',', '.') }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Bulan Dibayar -->
                            <div class="space-y-2">
                                <label for="bulan_dibayar_0" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Bulan Dibayar
                                    </span>
                                </label>
                                <select id="bulan_dibayar_0" name="payments[0][bulan_dibayar]"
                                    class="bg-green-50 border border-green-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 bulan-select transition-colors duration-200 hover:bg-green-100">
                                    <option value="">Pilih Bulan</option>
                                    @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                    'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                    <option value="{{ $bulan }}">{{ $bulan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tanggal Pembayaran -->
                            <div class="space-y-2">
                                <label for="tanggal_pembayaran_0" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                        Tanggal Pembayaran
                                    </span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-green-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input datepicker datepicker-autohide type="text" id="tanggal_pembayaran_0"
                                        name="payments[0][tanggal_pembayaran]"
                                        value="{{ old('tanggal_pembayaran', date('d/m/Y')) }}"
                                        class="bg-green-50 border border-green-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-3 tanggal-input transition-colors duration-200 hover:bg-green-100"
                                        placeholder="Pilih tanggal" required>
                                </div>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="space-y-2">
                                <label for="metode_pembayaran_0" class="block text-sm font-semibold text-gray-700">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Metode Pembayaran
                                    </span>
                                </label>
                                <select id="metode_pembayaran_0" name="payments[0][metode_pembayaran]"
                                    class="bg-green-50 border border-green-200 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 transition-colors duration-200 hover:bg-green-100"
                                    required>
                                    <option value="">Pilih Metode</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Petugas (hidden field) -->
                <input type="hidden" name="id_petugas" value="{{ auth()->user()->id }}">

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-green-200">
                    <div class="flex-1">
                        <div class="bg-green-100 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-green-800">Total yang harus dibayar:</span>
                                <span class="text-xl font-bold text-green-800" id="totalAmountFooter">Rp 0</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-8 py-4 text-center inline-flex items-center justify-center shadow-lg transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Simpan Semua Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Counter untuk baris baru
    let rowCounter = 1;

    // Fungsi untuk menghitung total pembayaran
    function calculateTotal() {
        let total = 0;
        let itemCount = 0;

        document.querySelectorAll('.payment-row').forEach((row, index) => {
            const kategoriSelect = row.querySelector('.kategori-select');
            if (kategoriSelect && kategoriSelect.value) {
                const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
                const nominal = parseInt(selectedOption.getAttribute('data-nominal')) || 0;
                total += nominal;
                itemCount++;
            }
        });

        // Update tampilan total
        const formattedTotal = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(total);

        document.getElementById('totalAmount').textContent = formattedTotal;
        document.getElementById('totalAmountFooter').textContent = formattedTotal;
        document.getElementById('totalRows').textContent = `${itemCount} item${itemCount !== 1 ? 's' : ''}`;
    }

    // Fungsi untuk update nomor pembayaran
    function updatePaymentNumbers() {
        document.querySelectorAll('.payment-row').forEach((row, index) => {
            const numberSpan = row.querySelector('.bg-green-100 span');
            const titleElement = row.querySelector('h5');
            if (numberSpan && titleElement) {
                numberSpan.textContent = index + 1;
                titleElement.innerHTML = titleElement.innerHTML.replace(/Pembayaran #\d+/, `Pembayaran #${index + 1}`);
            }
        });
    }

    // Fungsi untuk menambahkan baris baru
    document.getElementById('addRowBtn').addEventListener('click', function() {
        const container = document.getElementById('paymentRowsContainer');
        const newRow = document.querySelector('.payment-row').cloneNode(true);

        // Update semua ID dan name attributes
        const newRowIndex = rowCounter++;
        newRow.querySelectorAll('select, input').forEach(element => {
            const oldId = element.id;
            const oldName = element.name;

            if (oldId) {
                element.id = oldId.replace(/\d+/, newRowIndex);
            }

            if (oldName) {
                // Pastikan format name yang benar: payments[0][field]
                element.name = oldName.replace(/payments\[\d+\]/, `payments[${newRowIndex}]`);
            }

            // Reset nilai input
            if (element.tagName === 'SELECT') {
                element.selectedIndex = 0;
            } else if (element.type !== 'hidden') {
                element.value = '';
            }
        });

        // Reset tanggal ke hari ini
        const dateInput = newRow.querySelector('.tanggal-input');
        if (dateInput) {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();
            dateInput.value = `${day}/${month}/${year}`;
        }

        // Tambahkan event listener untuk kelas select
        const kelasSelect = newRow.querySelector('.kelas-select');
        if (kelasSelect) {
            kelasSelect.addEventListener('change', function() {
                handleKelasChange(this);
            });
        }

        // Tambahkan event listener untuk kategori select
        const kategoriSelect = newRow.querySelector('.kategori-select');
        if (kategoriSelect) {
            kategoriSelect.addEventListener('change', function() {
                updateBulanField(this);
                calculateTotal();
            });
        }

        // Hapus event listener lama dan tambahkan yang baru untuk tombol hapus
        const removeBtn = newRow.querySelector('.remove-row-btn');
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                if (document.querySelectorAll('.payment-row').length > 1) {
                    newRow.remove();
                    // Perbarui index setelah penghapusan
                    updateRowIndexes();
                    updatePaymentNumbers();
                    calculateTotal();
                } else {
                    alert('Anda tidak dapat menghapus baris terakhir!');
                }
            });
        }

        // Tambahkan baris baru ke container
        container.appendChild(newRow);
        updatePaymentNumbers();

        // Inisialisasi datepicker untuk input tanggal baru
        if (dateInput && window.datepicker) {
            new window.datepicker(dateInput, {
                autohide: true,
                format: 'dd/mm/yyyy'
            });
        }
    });

    // Fungsi untuk memperbarui index semua baris
    function updateRowIndexes() {
        const rows = document.querySelectorAll('.payment-row');
        rows.forEach((row, index) => {
            row.querySelectorAll('select, input').forEach(element => {
                const name = element.name;
                if (name && name.includes('payments[')) {
                    element.name = name.replace(/payments\[\d+\]/, `payments[${index}]`);
                }

                const id = element.id;
                if (id) {
                    element.id = id.replace(/\d+/, index);
                }
            });
        });
        rowCounter = rows.length;
    }

    // Fungsi untuk menghapus baris
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row-btn') || e.target.closest('.remove-row-btn')) {
            const row = e.target.closest('.payment-row');
            if (row && document.querySelectorAll('.payment-row').length > 1) {
                row.remove();
                // Perbarui index setelah penghapusan
                updateRowIndexes();
                updatePaymentNumbers();
                calculateTotal();
            } else {
                alert('Anda tidak dapat menghapus baris terakhir!');
            }
        }
    });

    // Fungsi untuk menangani perubahan kelas
    function handleKelasChange(selectElement) {
        const kelasId = selectElement.value;
        const row = selectElement.closest('.payment-row');
        const siswaSelect = row.querySelector('.siswa-select');

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
    }

    // Fungsi untuk menangani bulan dibayar berdasarkan kategori
    function updateBulanField(selectElement) {
        const row = selectElement.closest('.payment-row');
        const bulanSelect = row.querySelector('.bulan-select');
        const kategoriSelect = row.querySelector('.kategori-select');
        const siswaSelect = row.querySelector('.siswa-select');
        const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
        const isInfaq = selectedOption.getAttribute('data-is-infaq') === 'true';

        if (isInfaq) {
            // Pastikan siswa dan kategori sudah dipilih
            const siswaId = siswaSelect.value;
            const kategoriId = kategoriSelect.value;
            if (siswaId && kategoriId) {
                bulanSelect.innerHTML = '<option value="">Memuat bulan...</option>';
                bulanSelect.disabled = true;
                fetch(`/admin/pembayaran/bulan-belum-terbayar/${siswaId}/${kategoriId}`)
                    .then(response => response.json())
                    .then(data => {
                        bulanSelect.innerHTML = '<option value="">Pilih Bulan</option>';
                        data.forEach(bulan => {
                            const option = document.createElement('option');
                            option.value = bulan;
                            option.text = bulan;
                            bulanSelect.appendChild(option);
                        });
                        bulanSelect.disabled = false;
                        bulanSelect.setAttribute('required', 'required');
                    })
                    .catch(() => {
                        bulanSelect.innerHTML = '<option value="">Gagal memuat bulan</option>';
                        bulanSelect.disabled = false;
                    });
            } else {
                bulanSelect.innerHTML = '<option value="">Pilih Bulan</option>';
                bulanSelect.disabled = true;
            }
        } else {
            bulanSelect.disabled = true;
            bulanSelect.removeAttribute('required');
            bulanSelect.innerHTML = '<option value="">Pilih Bulan</option>';
        }
    }

    // Tambahkan event listener pada siswa-select agar update bulan jika siswa berubah
    document.querySelectorAll('.siswa-select').forEach(select => {
        select.addEventListener('change', function() {
            const row = this.closest('.payment-row');
            const kategoriSelect = row.querySelector('.kategori-select');
            updateBulanField(kategoriSelect);
        });
    });

    // Tambahkan event listener untuk kelas select yang sudah ada
    document.querySelectorAll('.kelas-select').forEach(select => {
        select.addEventListener('change', function() {
            handleKelasChange(this);
        });
    });

    // Tambahkan event listener untuk kategori select yang sudah ada
    document.querySelectorAll('.kategori-select').forEach(select => {
        select.addEventListener('change', function() {
            updateBulanField(this);
            calculateTotal();
        });
    });

    // Tangani submit form
    document.getElementById('pembayaranForm').addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...`;
    });

    // Hitung total awal
    calculateTotal();
});
</script>
@endpush

@endsection
