<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @livewireStyles
</head>

<body class="bg-gray-100">
    <!-- Header -->
    @include('layouts.header')
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    @include('layouts.footer')

    <!-- Flowbite JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.3.0/dist/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @livewireScripts
    {{-- Toastify --}}
    @if(session('success'))
    <script>
        Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#10B981",
                    borderRadius: "0.375rem",
                    boxShadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)"
                },
                stopOnFocus: true,
            }).showToast();
    </script>
    @endif

    @if(session('error'))
    <script>
        Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#EF4444",
                    borderRadius: "0.375rem"
                },
                stopOnFocus: true,
            }).showToast();
    </script>
    @endif
    @stack('scripts')
</body>

</html>
