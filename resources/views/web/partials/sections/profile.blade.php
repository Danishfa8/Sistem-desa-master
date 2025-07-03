<!-- Vision and Mission Section -->
@if ($data)
    <div id="vision-mission-section" class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-xl font-bold text-center text-gray-800 mb-6">Profile Desa {{ $desa->nama_desa }}</h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Image -->
            <div class="order-2 lg:order-1">
                <img src="{{ asset($data->foto) }}" alt="Kantor Pemerintahan" class="w-full h-auto rounded-lg shadow-md">
            </div>

            <!-- Content -->
            <div class="order-1 lg:order-2 space-y-4">
                <!-- Vision -->
                <div class="bg-gradient-to-r from-green-100 to-green-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-2">Visi</h4>
                    <p class="text-gray-700 text-sm italic">
                        {{ $data->visi }}
                    </p>
                </div>

                {{-- Misi --}}
                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-3">Misi</h4>
                    <p class="space-y-2 text-sm text-gray-700">
                        {{ $data->misi }}
                    </p>
                </div>

                {{-- Program Unggulan --}}
                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-3">Program Unggulan</h4>
                    <p class="space-y-2 text-sm text-gray-700">
                        {{ $data->program_unggulan }}
                    </p>
                </div>

                {{-- Alamat --}}
                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-3">Alamat</h4>
                    <p class="space-y-2 text-sm text-gray-700">
                        {{ $data->alamat }}
                    </p>
                </div>

                {{-- Telephone --}}
                <div class="bg-gradient-to-r from-gray-100 to-gray-300 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-800 mb-3">Telephone</h4>
                    <p class="space-y-2 text-sm text-gray-700">
                        {{ $data->telepon }}
                    </p>
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Data profil desa belum tersedia</p>
                </div>

            </div> {{-- End Content --}}
        </div> {{-- End Grid --}}
    </div> {{-- End Section --}}
@endif
