@extends('layouts.appweb2')
@section('content')
    <!-- Page Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Profil Desa</h2>
        <p class="text-gray-600 mb-4">Informasi mengenai desa dan kelurahan...</p>

        <!-- Filter Section -->
        <div class="flex items-center space-x-4 mb-6">
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-700">Kecamatan</label>
                <select id="kecamatan"
                    class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-700">Desa</label>
                <select id="desa"
                    class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                    disabled>
                    <option value="">Pilih Desa</option>
                </select>
            </div>
            <button id="tampilkan-data"
                class="px-4 py-2 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500">
                Tampilkan Data
            </button>
        </div>

        <!-- Loading indicator -->
        <div id="loading" class="hidden flex items-center space-x-2 text-green-500 mb-4">
            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-green-500"></div>
            <span class="text-sm">Memuat data desa...</span>
        </div>

        <!-- Result display -->
        <div id="result" class="hidden mb-6 p-4 border border-green-200 rounded-lg bg-green-50">
            <h3 class="font-semibold text-gray-800 mb-2">Data Terpilih:</h3>
            <div id="selected-data" class="text-sm text-gray-600"></div>
        </div>
    </div>

    <!-- Vision and Mission Section -->
    <div id="vision-mission-section" class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-center text-gray-800 mb-6">Visi dan Misi Kabupaten</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Image -->
            <div class="order-2 lg:order-1">
                <img src="{{ asset('assets/images/kantorbbs.jpg') }}" alt="Kantor Pemerintahan"
                    class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2 space-y-4">
                <!-- Vision -->
                <div class="bg-gradient-to-r from-green-100 to-green-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-2">Visi</h4>
                    <p class="text-gray-700 text-sm italic">
                        "Mewujudkan desa yang maju, mandiri, dan sejahtera berbasis kearifan lokal serta partisipasi
                        masyarakat."
                    </p>
                </div>

                <!-- Mission -->
                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-3">Misi</h4>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                            Meningkatkan kesejahteraan masyarakat melalui pembangunan ekonomi.
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                            Memperkuat nilai budaya dan kearifan lokal.
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                            Meningkatkan kualitas pendidikan dan kesehatan.
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                            Membangun infrastruktur desa yang berkelanjutan.
                        </li>
                        <li class="flex items-start">
                            <span class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                            Meningkatkan partisipasi aktif masyarakat dalam pembangunan desa.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Regional Information Section -->
    <div id="regional-info-section" class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold text-center text-gray-800 mb-6">Informasi Wilayah</h3>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Map -->
            <div class="lg:col-span-1">
                <div class="bg-gray-200 rounded-lg h-48 flex items-center justify-center">
                    <img src="{{ asset('assets/images/petabbs.png') }}" alt="Peta Wilayah"
                        class="w-full h-full object-cover rounded-lg">
                </div>
            </div>

            <!-- Statistics -->
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Area -->
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-map text-white text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-1">Luas Wilayah</h4>
                        <p class="text-2xl font-bold text-gray-800">150 km²</p>
                    </div>

                    <!-- Districts -->
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-1">Jumlah Kecamatan</h4>
                        <p class="text-2xl font-bold text-gray-800">{{ $kecamatans->count() }} Kecamatan</p>
                    </div>

                    <!-- Villages -->
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-home text-white text-xl"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-1">Jumlah Desa</h4>
                        <p class="text-2xl font-bold text-gray-800">{{ $desas->count() }} Desa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('web.partials.section-content')
    </main>

    @include('web.partials.javascript')
@endsection
