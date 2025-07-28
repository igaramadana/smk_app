<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <span class="ms-2 text-gray-600 text-sm">Dashboard</span>
            <li>
                <a href="#" id="menu-dashboard"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- Data Master -->
            <span class="ms-2 text-gray-600 text-sm">Data Master</span>
            <li>
                <a href="{{ route('siswa.index') }}" id="menu-siswa"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Data Siswa</span>
                </a>
            </li>
            <li>
                <a href="{{route('petugas.index')}}" id="menu-petugas"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Data Petugas</span>
                </a>
            </li>
            <li>
                <a href="{{route('kelas.index')}}" id="menu-kelas"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 12a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm4 3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm4 3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Data Kelas</span>
                </a>
            </li>

            <!-- Pembayaran -->
            <span class="ms-2 text-gray-600 text-sm">Pembayaran</span>
            <li>
                <a href="{{route('kategori.index')}}" id="menu-kategori"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                        <path
                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                        <path
                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Kategori Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="{{route('pembayaran.index')}}" id="menu-pembayaran"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="M18 0H6a2 2 0 0 0-2 2h14v12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Z" />
                        <path
                            d="M14 4H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2ZM2 16v-6h12v6H2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Input Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="{{route('riwayat.index')}}" id="menu-riwayat"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-green-100 group transition-colors duration-200 sidebar-item">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-green-600"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path
                            d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Riwayat Pembayaran</span>
                </a>
            </li>

            <!-- Sign Out -->
            <li>
                <button type="button" id="menu-signout" data-modal-target="popup-signout"
                    data-modal-toggle="popup-signout"
                    class="flex items-center p-2 w-full text-red-700 rounded-lg hover:bg-red-100 group">
                    <svg class="shrink-0 w-5 h-5 text-red-700 transition duration-75 group-hover:text-red-700"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                    </svg>
                    <span class="flex-1 text-left whitespace-nowrap ms-3">Sign Out</span>
                </button>
            </li>
        </ul>
    </div>
</aside>

<!-- Modal konfirmasi sign out -->
<div id="popup-signout" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                class="inline-flex absolute right-2.5 top-3 justify-center items-center ml-auto w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900"
                data-modal-hide="popup-signout">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 w-12 h-12 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">
                    Apakah Anda yakin ingin keluar?
                </h3>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mr-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                        Ya, Keluar
                    </button>
                </form>
                <button data-modal-hide="popup-signout" type="button"
                    class="px-5 py-2.5 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 hover:text-gray-900">Tidak,
                    Batal</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Dapatkan path URL saat ini
    const currentPath = window.location.pathname;

    // Daftar route dan ID menu yang sesuai
    const menuRoutes = {
        '/admin': 'menu-dashboard',
        '/admin/siswa': 'menu-siswa',
        '/admin/petugas': 'menu-petugas',
        '/admin/kelas': 'menu-kelas',
        '/admin/kategori': 'menu-kategori',
        '/admin/pembayaran': 'menu-pembayaran',
        '/admin/riwayat': 'menu-riwayat',
        '/petugas': 'menu-dashboard' // Jika ada dashboard khusus petugas
    };

    // Temukan menu yang sesuai dengan path saat ini
    const activeMenuId = menuRoutes[currentPath];

    // Jika ditemukan menu yang sesuai
    if (activeMenuId) {
        const activeMenu = document.getElementById(activeMenuId);
        if (activeMenu) {
            // Tambahkan kelas active
            activeMenu.classList.add('bg-green-100');
            // Ubah warna teks menjadi hijau
            activeMenu.classList.remove('text-gray-900');
            activeMenu.classList.add('text-green-600');

            // Ubah warna ikon menjadi hijau
            const icon = activeMenu.querySelector('svg');
            if (icon) {
                icon.classList.remove('text-gray-500');
                icon.classList.add('text-green-600');
            }
        }
    }

    // Tambahkan event listener untuk semua menu sidebar
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            // Hapus semua kelas active terlebih dahulu
            sidebarItems.forEach(i => {
                i.classList.remove('bg-green-100', 'text-green-600');
                i.classList.add('text-gray-900');

                const icon = i.querySelector('svg');
                if (icon) {
                    icon.classList.remove('text-green-600');
                    icon.classList.add('text-gray-500');
                }
            });

            // Tambahkan kelas active ke menu yang diklik
            this.classList.add('bg-green-100');
            this.classList.remove('text-gray-900');
            this.classList.add('text-green-600');

            // Ubah warna ikon
            const clickedIcon = this.querySelector('svg');
            if (clickedIcon) {
                clickedIcon.classList.remove('text-gray-500');
                clickedIcon.classList.add('text-green-600');
            }
        });
    });
});
</script>
