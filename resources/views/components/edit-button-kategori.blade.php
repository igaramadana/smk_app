<!-- resources/views/components/edit-button-kategori.blade.php -->
<div>
    <button data-modal-target="edit-kategori-modal-{{ $kategori_id }}"
        data-modal-toggle="edit-kategori-modal-{{ $kategori_id }}" type="button"
        class="p-2 text-white bg-yellow-500 rounded-lg dark:text-gray-50 dark:bg-yellow-500 hover:text-white hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 dark:hover:text-white dark:hover:bg-yellow-500">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
        </svg>
        <span class="sr-only">Edit</span>
    </button>

    <!-- Modal Edit Kategori -->
    <div id="edit-kategori-modal-{{ $kategori_id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full backdrop-blur-sm bg-gray-900/50 dark:bg-gray-900/80">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Edit Data Kategori
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-kategori-modal-{{ $kategori_id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('kategori.update', $kategori_id) }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div>
                            <label for="edit_nama_kategori"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Kategori</label>
                            <input type="text" name="nama_kategori" id="edit_nama_kategori"
                                value="{{ $nama_kategori ?? '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Contoh: SPP" required>
                        </div>
                        <div>
                            <label for="edit_nominal"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal</label>
                            <input type="text" name="nominal" id="edit_nominal"
                                value="{{ str_replace(['Rp ', '.'], '', $nominal) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Contoh: 1000000" required>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Simpan
                        </button>
                        <button type="button" data-modal-toggle="edit-kategori-modal-{{ $kategori_id }}"
                            class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Format Rupiah untuk input edit nominal
    const editNominalInput = document.getElementById('edit_nominal');

    if (editNominalInput) {
        // Format saat input
        editNominalInput.addEventListener('keyup', function(e) {
            let value = this.value.replace(/\D/g, '');
            if(value) {
                value = 'Rp ' + parseInt(value, 10).toLocaleString('id-ID');
            }
            this.value = value;
        });

        // Format saat modal dibuka
        let initialValue = editNominalInput.value;
        if (initialValue) {
            editNominalInput.value = 'Rp ' + parseInt(initialValue).toLocaleString('id-ID');
        }

        // Hapus format sebelum submit
        document.querySelector('#edit-kategori-modal-{{ $kategori_id }} form').addEventListener('submit', function() {
            editNominalInput.value = editNominalInput.value.replace(/\D/g, '');
        });
    }
});
</script>
