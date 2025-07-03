<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brebes - Aplikasi Monografi Desa</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- Hero Section -->
    <div class="relative w-full min-h-screen bg-cover bg-center" style="background-image: url('/storage/bg-image.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <div class="relative z-10 flex flex-col items-center justify-start min-h-screen text-white pt-12 px-4">
            <!-- Logo dan Judul -->
            <div class="text-center">
                <img src="{{ asset('logo/Logo-brebes.png') }}" alt="Logo" class="w-24 h-24 mb-4 mx-auto">
                <h1 class="text-4xl font-bold">Brebes</h1>
                <p class="text-lg text-gray-200">Aplikasi Desa Cantik</p>
            </div>

            <!-- Pencarian -->
            <div class="mt-6 w-full max-w-md">
                <div class="flex shadow-lg">
                    <input type="text" placeholder="Mau cari data apa?"
                        class="flex-grow px-4 py-3 rounded-l-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button
                        class="bg-blue-600 text-white px-6 py-3 rounded-r-lg hover:bg-blue-700 transition duration-300">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Menu Section -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-16 w-full max-w-4xl">
                <a href="{{ route('profil-desa') }}"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('profil-desa') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="{{ asset('icons/ppdesa.png') }}" alt="Profil Icon" class="w-6 h-6 mb-2">
                    Profil Desa
                </a>
                <a href="{{ route('desa-dalam-angka') }}"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('desa-dalam-angka') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="{{ asset('icons/angka.png') }}" alt="Angka Icon" class="w-6 h-6 mb-2">
                    Desa Dalam Angka
                </a>
                <a href="{{ route('desa-dalam-peta') }}"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->routeIs('desa-dalam-peta') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="{{ asset('icons/peta.png') }}" alt="Peta Icon" class="w-6 h-6 mb-2">
                    Desa Dalam Peta
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->is('grafik') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" alt="Grafik Icon"
                        class="w-6 h-6 mb-2">
                    Desa Dalam Grafik
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->is('buku-monografi') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991108.png" alt="Buku Icon"
                        class="w-6 h-6 mb-2">
                    Buku Monografi
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->is('metadata') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="https://cdn-icons-png.flaticon.com/512/833/833539.png" alt="Metadata Icon"
                        class="w-6 h-6 mb-2">
                    Metadata
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center transition border border-gray-300 bg-white rounded-lg p-4 hover:border-blue-500 min-w-[80px] {{ request()->is('instrumen') ? 'text-blue-600 font-semibold border-blue-500' : 'text-gray-700 hover:text-blue-600' }}">
                    <img src="https://cdn-icons-png.flaticon.com/512/911/911406.png" alt="Instrumen Icon"
                        class="w-6 h-6 mb-2">
                    Instrumen
                </a>
            </div>
        </div>
    </div>

</body>

</html>
