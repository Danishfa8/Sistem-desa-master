@extends('layouts.appweb2')
@section('content')
    <div class="container mx-auto p-4">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-6 h-6 bg-teal-600 rounded flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-gray-800">Desa Dalam Peta</h1>
            </div>
            <!-- Controls -->
            <div class="flex gap-4 items-center flex-wrap">
                <select id="kecamatan" class="px-3 py-2 border rounded bg-white text-gray-700 min-w-48">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
                <select id="desa" class="px-3 py-2 border rounded bg-white text-gray-700 min-w-48" disabled>
                    <option value="">-- Pilih Desa --</option>
                </select>
                <select id="kategori" class="px-3 py-2 border rounded bg-white text-gray-700 min-w-48" disabled>
                    <option value="">-- Pilih Kategori --</option>
                </select>
            </div>
        </div>

        <!-- Map Container -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="relative">
                <div id="map" class="w-full h-96 bg-blue-100"></div>

                <!-- Info Panel -->
                <div id="infoPanel"
                    class="absolute bottom-4 left-4 bg-white rounded-lg shadow-lg p-4 border border-gray-200 max-w-sm hidden z-10">
                    <div id="infoContent">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Boundary Controls (ditempatkan via JS jika diperlukan) -->
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 text-sm">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">🏥</div>
                <span class="text-gray-700">Kesehatan</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">✈️</div>
                <span class="text-gray-700">Transportasi</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">🏛️</div>
                <span class="text-gray-700">Pemerintahan</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">🏪</div>
                <span class="text-gray-700">Perdagangan</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">🏖️</div>
                <span class="text-gray-700">Wisata</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">🏢</div>
                <span class="text-gray-700">Perkantoran</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">⚽</div>
                <span class="text-gray-700">Olahraga</span>
            </div>
        </div>

        <!-- Attribution -->
        <div class="mt-3 pt-2 border-t border-gray-200 text-xs text-gray-500">
            <a href="https://leafletjs.com" class="text-teal-600 hover:underline">Leaflet</a> ©
            <a href="https://www.openstreetmap.org/copyright" class="text-teal-600 hover:underline">
                OpenStreetMap
            </a> contributors
        </div>
    </div>


    <!-- Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    @vite(['resources/js/app.js'])
@endsection
