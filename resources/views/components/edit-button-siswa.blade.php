<div>
    <button data-modal-target="edit-modal-{{ $siswa_id }}" data-modal-toggle="edit-modal-{{ $siswa_id }}" type="button"
        class="p-2 text-white bg-yellow-500 rounded-lg dark:text-gray-50 dark:bg-yellow-500 hover:text-white hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-300 dark:hover:text-white dark:hover:bg-yellow-500">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
        </svg>
        <span class="sr-only">Edit</span>
    </button>

    <!-- Edit Modal -->
    <div id="edit-modal-{{ $siswa_id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Data Siswa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="edit-modal-{{ $siswa_id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('siswa.update', $siswa_id) }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div>
                            <label for="nis"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIS</label>
                            <input type="text" name="nis" id="nis" value="{{ $nis ?? '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Masukkan NIS" required>
                        </div>
                        <div>
                            <label for="nama_siswa"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Siswa</label>
                            <input type="text" name="nama_siswa" id="nama_siswa" value="{{ $nama_siswa ?? '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Masukkan Nama Siswa" required>
                        </div>
                        <div>
                            <label for="jenis_kelamin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                required>
                                <option value="L" {{ $jenis_kelamin=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $jenis_kelamin=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="alamat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Masukkan Alamat" required>{{ $alamat ?? '' }}</textarea>
                        </div>
                        <div>
                            <label for="no_wa"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                WhatsApp</label>
                            <input type="text" name="no_wa" id="no_wa" value="{{ $no_wa ?? '' }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Masukkan Nomor WhatsApp" required>
                        </div>
                        <div>
                            <label for="id_kelas"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                            <select name="id_kelas" id="id_kelas"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                required>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $id_kelas==$k->id ? 'selected' : '' }}>{{ $k->nama_kelas
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center justify-end pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button type="button" data-modal-toggle="edit-modal-{{ $siswa_id }}"
                            class="mr-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
