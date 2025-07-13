@extends('app')
@section('content')

<!-- Navbar -->
<nav class="bg-primary text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Mirafa" style="width: 160px; height: auto;">
                </div>
            </div>
            <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                <a href="#fitur" class="hover:text-accent px-3 py-2 rounded-md text-sm font-medium transition">Home</a>
                <a href="#tentang"
                    class="hover:text-accent px-3 py-2 rounded-md text-sm font-medium transition">Tentang</a>
                <a href="#kontak"
                    class="hover:text-accent px-3 py-2 rounded-md text-sm font-medium transition">Kontak</a>
                <button data-modal-target="loginModal" data-modal-toggle="loginModal"
                    class="btn-primary px-4 py-2 rounded-md text-sm font-medium border-none">
                    Masuk
                </button>
            </div>
            <div class="-mr-2 flex items-center md:hidden">
                <!-- Mobile menu button -->
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#fitur" class="hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="#tentang" class="hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Tentang</a>
            <a href="#kontak" class="hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Kontak</a>
            <button data-modal-target="loginModal" data-modal-toggle="loginModal"
                class="btn-primary block w-full text-left px-3 py-2 rounded-md text-base font-medium border-none">
                Masuk
            </button>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div id="loginModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Mirafa" style="width: 120px; height: auto;">
                </div>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="loginModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h3 class="text-xl font-semibold text-primary mb-2 text-center">Masuk ke Akun Anda</h3>
                <p class="text-sm text-gray-500 mb-6 text-center">Silakan masukkan kredensial Anda</p>

                <form class="space-y-4" action="{{route('login')}}" method="POST" id="loginForm">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-accent focus:border-accent block w-full ps-10 p-2.5"
                                placeholder="mail@site.com">
                        </div>
                        <p id="email-error" class="hidden mt-2 text-xs text-red-600">Email tidak valid</p>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 16 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11.5 8V4.5a3.5 3.5 0 1 0-7 0V8M8 12v3M2 8h12a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1Z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-accent focus:border-accent block w-full ps-10 p-2.5"
                                minlength="8">
                        </div>
                        <p id="password-error" class="hidden mt-2 text-xs text-red-600">Password minimal 8 karakter</p>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="btn-primary w-full text-white focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Masuk
                            <svg class="w-4 h-4 ml-1 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 16 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hero Section -->
<section class="bg-white text-white relative overflow-hidden"
    style="background-image: url('{{asset('img/bg.svg')}}'); background-size: cover; background-position: center bottom; background-repeat: no-repeat;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Sistem Manajemen Keuangan</h1>
                <h2 class="text-2xl md:text-3xl font-bold mb-4 text-accent" id="typing-text"></h2>
                <p class="text-xl mb-6">Solusi modern untuk manajemen pembayaran SPP sekolah yang efisien, transparan,
                    dan terintegrasi.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/register"
                        class="btn-primary text-center font-medium rounded-lg text-sm px-5 py-2.5">Daftar
                        Sekarang</a>
                </div>
            </div>
            <div class="flex justify-end">
                <img src="{{ asset('img/assets1.png') }}" alt="Pembayaran Digital" style="height: 500px;"
                    class="max-w-lg">
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="kontak" class="bg-white text-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Mirafa" style="width: 120px; height: auto;">
                </div>
                <p class="mb-4">Solusi pembayaran SPP sekolah yang modern, efisien, dan transparan.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-500 hover:text-accent">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-accent">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 3.807.058h.468c2.456 0 2.784-.011 3.807-.058.975-.045 1.504-.207 1.857-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.054.058-1.37.058-3.807v-.468c0-2.456-.011-2.784-.058-3.807-.045-.975-.207-1.504-.344-1.857a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-accent">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-accent">Beranda</a></li>
                    <li><a href="#fitur" class="text-gray-600 hover:text-accent">Fitur</a></li>
                    <li><a href="#tentang" class="text-gray-600 hover:text-accent">Tentang Kami</a></li>
                    <li><a href="/login" class="text-gray-600 hover:text-accent">Masuk</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Dukungan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 hover:text-accent">Bantuan</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-accent">FAQ</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-accent">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-accent">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-gray-600">+62 123 4567 890</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 012.06 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-600">info@sppdigital.com</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-gray-600">Jl. Pendidikan No. 123, Jakarta</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-200 mt-8 pt-8 text-center">
            <p class="text-gray-500">&copy; 2025 SPP Digital. All rights reserved.</p>
        </div>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
            mobileMenu.classList.toggle('hidden');

            // Toggle icons
            const menuIcon = this.querySelector('.block');
            const closeIcon = this.querySelector('.hidden');
            menuIcon.classList.toggle('hidden');
            menuIcon.classList.toggle('block');
            closeIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('block');
        });
    });

    // Typing effect
    const text = "MI RAUDLATUL FALAH.";
    const typingTarget = document.getElementById("typing-text");
    let index = 0;
    let isDeleting = false;

    function typeLoop() {
        if (!isDeleting) {
            typingTarget.textContent = text.substring(0, index + 1);
            index++;
            if (index === text.length) {
                isDeleting = true;
                setTimeout(typeLoop, 2500);
                return;
            }
        } else {
            typingTarget.textContent = text.substring(0, index - 1);
            index--;
            if (index === 0) {
                isDeleting = false;
            }
        }

        setTimeout(typeLoop, isDeleting ? 150 : 150);
    }

    typingTarget.classList.add("typing-cursor");
    typeLoop();

    // Form validation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        let isValid = true;
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');

        // Reset error states
        email.classList.remove('bg-red-50', 'border-red-500');
        password.classList.remove('bg-red-50', 'border-red-500');
        emailError.classList.add('hidden');
        passwordError.classList.add('hidden');

        // Email validation
        if (!email.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            email.classList.add('bg-red-50', 'border-red-500');
            emailError.classList.remove('hidden');
            isValid = false;
        }

        // Password validation
        if (!password.value || password.value.length < 8) {
            password.classList.add('bg-red-50', 'border-red-500');
            passwordError.classList.remove('hidden');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
</script>
@endpush