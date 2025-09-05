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
                <button type="button" id="addRowBtn"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    Tambah Baris
                </button>
            </div>

            <form action="{{ route('pembayaran.store') }}" method="POST" class="space-y-6" id="pembayaranForm">
                @csrf

                <!-- Container untuk baris pembayaran -->
                <div id="paymentRowsContainer">
                    <!-- Baris pertama -->
                    <div class="payment-row grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-200 pb-6 mb-6">
                        <!-- Kelas -->
                        <div>
                            <label for="id_kelas_0" class="block mb-2 text-sm font-medium text-gray-900">Kelas</label>
                            <select id="id_kelas_0" name="payments[0][id_kelas]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 kelas-select"
                                required>
                                <option value="">Pilih Kelas</option>
                                @foreach($siswas->groupBy('id_kelas') as $kelasId => $siswaPerKelas)
                                <option value="{{ $kelasId }}">{{ $siswaPerKelas->first()->kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Siswa -->
                        <div>
                            <label for="id_siswa_0" class="block mb-2 text-sm font-medium text-gray-900">Siswa</label>
                            <select id="id_siswa_0" name="payments[0][id_siswa]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 siswa-select"
                                required>
                                <option value="">Pilih Siswa</option>
                            </select>
                        </div>

                        <!-- Kategori Pembayaran -->
                        <div>
                            <label for="id_kategori_0" class="block mb-2 text-sm font-medium text-gray-900">Kategori
                                Pembayaran</label>
                            <select id="id_kategori_0" name="payments[0][id_kategori]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 kategori-select"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    data-is-infaq="{{ strtolower($kategori->nama_kategori) === 'infaq' ? 'true' : 'false' }}">
                                    {{ $kategori->nama_kategori }} - Rp {{ number_format($kategori->nominal, 0, ',',
                                    '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Bulan Dibayar -->
                        <div>
                            <label for="bulan_dibayar_0" class="block mb-2 text-sm font-medium text-gray-900">Bulan
                                Dibayar</label>
                            <select id="bulan_dibayar_0" name="payments[0][bulan_dibayar]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 bulan-select">
                                <option value="">Pilih Bulan</option>
                                @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                                'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Pembayaran -->
                        <div>
                            <label for="tanggal_pembayaran_0"
                                class="block mb-2 text-sm font-medium text-gray-900">Tanggal Pembayaran</label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker datepicker-autohide type="text" id="tanggal_pembayaran_0"
                                    name="payments[0][tanggal_pembayaran]"
                                    value="{{ old('tanggal_pembayaran', date('d/m/Y')) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full ps-10 p-2.5 tanggal-input"
                                    placeholder="Pilih tanggal" required>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div>
                            <label for="metode_pembayaran_0" class="block mb-2 text-sm font-medium text-gray-900">Metode
                                Pembayaran</label>
                            <select id="metode_pembayaran_0" name="payments[0][metode_pembayaran]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5"
                                required>
                                <option value="">Pilih Metode</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                            </select>
                        </div>

                        <!-- Tombol Hapus -->
                        <div class="md:col-span-2 flex justify-end">
                            <button type="button"
                                class="remove-row-btn text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                </svg>
                                Hapus Baris
                            </button>
                        </div>
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
                } else {
                    alert('Anda tidak dapat menghapus baris terakhir!');
                }
            });
        }

        // Tambahkan baris baru ke container
        container.appendChild(newRow);

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
            } else {
                alert('Anda tidak dapat menghapus baris terakhir!');
            }
        }
    });

    // ... (fungsi handleKelasChange dan updateBulanField tetap sama)
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
        const selectedOption = selectElement.options[selectElement.selectedIndex];
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
        });
    });

    // Tangani submit form
    document.getElementById('pembayaranForm').addEventListener('submit', function(e) {
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
