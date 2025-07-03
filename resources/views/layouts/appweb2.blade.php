<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Cantik - Profil Desa</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-1rem);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-left {
            opacity: 0;
            animation: slideInLeft 0.6s ease-out forwards;
        }

        .slide-in-left.delay-200 {
            animation-delay: 0.2s;
        }

        .nav-button.active {
            color: #1d4ed8;
            border-bottom-color: #f97316;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Sticky White Navbar with Scroll Blur Effect -->
    <header id="navbar" class="bg-white transition-all duration-300 sticky top-0 z-50 border-b border-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between backdrop-blur-sm">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                <img src="{{ asset('assets/images/Logo-brebes.png') }}" alt="Logo Kabupaten Brebes"
                    class="w-12 h-12 object-contain" width="48" height="48">
                <span class="text-gray-300 h-8 border-r border-gray-300 mx-1"></span>
                <div class="flex flex-col overflow-hidden">
                    <span class="text-2xl font-bold text-gray-800 tracking-tight leading-tight slide-in-left">
                        Desa Cantik
                    </span>
                    <span class="text-xs text-gray-500 mt-0.5 slide-in-left delay-200">
                        Pemerintah Kabupaten Brebes
                    </span>
                </div>
            </a>

            <!-- Mobile Menu Button -->
            <button id="nav-toggle" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Desktop Nav -->
            <nav id="nav-menu" class="hidden md:flex items-center justify-end flex-1 gap-2">
                <a href="{{ route('profile.desa') }}"
                    class="flex flex-col items-center justify-center transition border {{ request()->routeIs('profil.desa') ? 'border-blue-500' : 'border-gray-300' }} rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('profile.desa') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="{{ asset('assets/icons/ppdesa.png') }}" alt="Profil Icon" class="w-6 h-6 mb-1">
                    Profil Desa
                </a>
                <a href="{{ route('data.index') }}"
                    class="flex flex-col items-center justify-center transition border {{ request()->routeIs('data.index') ? 'border-blue-500' : 'border-gray-300' }} rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('data.index') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="{{ asset('assets/icons/angka.png') }}" alt="Angka Icon" class="w-6 h-6 mb-1">
                    Desa Dalam Angka
                </a>
                <a href="{{ route('peta.dinamik') }}"
                    class="flex flex-col items-center justify-center transition border {{ request()->routeIs('peta.dinamik') ? 'border-blue-500' : 'border-gray-300' }} rounded-lg p-2 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('peta.dinamik') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="{{ asset('assets/icons/peta.png') }}" alt="Peta Icon" class="w-6 h-6 mb-1">
                    Desa Dalam Peta
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991108.png" alt="Buku Icon"
                        class="w-6 h-6 mb-1">
                    Buku Monografi
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/833/833539.png" alt="Metadata Icon"
                        class="w-6 h-6 mb-1">
                    Metadata
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-2 hover:border-blue-500 min-w-[80px] text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/911/911406.png" alt="Instrumen Icon"
                        class="w-6 h-6 mb-1">
                    Instrumen
                </a>
            </nav>
        </div>

        <!-- Mobile Nav -->
        <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 z-[9999]">
            <div class="grid grid-cols-2 gap-4 text-sm font-medium">
                <a href="{{ route('profile.desa') }}"
                    class="flex flex-col items-center justify-center transition border border-blue-500 rounded-lg p-3 text-blue-600 font-semibold">
                    <img src="https://cdn-icons-png.flaticon.com/512/1949/1949389.png" alt="Profil Icon"
                        class="w-6 h-6 mb-1">
                    Profil Desa
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/1313/1313246.png" alt="Angka Icon"
                        class="w-6 h-6 mb-1">
                    Desa Dalam Angka
                </a>
                <a href="{{ route('peta.dinamik') }}"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/535/535137.png" alt="Peta Icon"
                        class="w-6 h-6 mb-1">
                    Desa Dalam Peta
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" alt="Grafik Icon"
                        class="w-6 h-6 mb-1">
                    Desa Dalam Grafik
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991108.png" alt="Buku Icon"
                        class="w-6 h-6 mb-1">
                    Buku Monografi
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/833/833539.png" alt="Metadata Icon"
                        class="w-6 h-6 mb-1">
                    Metadata
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 rounded-lg p-3 hover:border-blue-500 text-gray-700 hover:text-blue-600">
                    <img src="https://cdn-icons-png.flaticon.com/512/911/911406.png" alt="Instrumen Icon"
                        class="w-6 h-6 mb-1">
                    Instrumen
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')

        <script>
            // Mobile menu toggle
            const navToggle = document.getElementById('nav-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            navToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!navToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        </script>
</body>

</html>
