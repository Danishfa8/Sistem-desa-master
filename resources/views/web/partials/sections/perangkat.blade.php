@if ($data && $data->count() > 0)
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($data as $item)
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
                    @if ($item->foto)
                        <img src="{{ asset($item->foto) }}" alt="Foto Perangkat"
                            class="w-full h-32 object-cover rounded-md mb-4">
                    @else
                        <div class="w-full h-32 rounded-md mb-4 bg-gray-300 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    <h3 class="font-bold text-gray-900 text-sm mb-1">{{ strtoupper($item->nama) }}</h3>
                    <p class="text-gray-600 text-xs">{{ $item->jabatan }}</p>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="text-center py-8">
        <p class="text-gray-500">Data perangkat desa belum tersedia.</p>
    </div>
@endif
