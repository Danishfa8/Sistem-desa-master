{{-- Modal Sarana Ibadah Desa --}}
<div id="showModal{{ $saranaIbadahDesa->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50" role="dialog" aria-modal="true" aria-labelledby="showModalLabel{{ $saranaIbadahDesa->id }}">
  <div class="flex items-center justify-center min-h-screen px-4" onclick="handleOutsideClick(event, '{{ $saranaIbadahDesa->id }}')">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl" onclick="event.stopPropagation()">

      {{-- Header --}}
      <div class="flex items-center justify-between px-4 py-3 border-b">
        <h2 id="showModalLabel{{ $saranaIbadahDesa->id }}" class="text-lg font-semibold text-gray-800">
          Detail Sarana Ibadah {{ $saranaIbadahDesa->desa->nama_desa }}
        </h2>
        <button type="button" class="text-gray-600 hover:text-gray-900" onclick="closeModal('{{ $saranaIbadahDesa->id }}')">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      {{-- Foto --}}
      <div class="px-4 pt-4">
        @if ($saranaIbadahDesa->foto)
          <div class="text-center mb-3">
            <img src="{{ asset('storage/' . $saranaIbadahDesa->foto) }}" alt="Foto Sarana Ibadah"
                 class="rounded shadow max-h-64 mx-auto">
          </div>
        @else
          <div class="text-center text-gray-500 mb-3 italic">Tidak ada foto</div>
        @endif
      </div>

      {{-- Informasi --}}
      <div class="p-4 space-y-3 text-sm text-gray-700">
        <div class="grid grid-cols-3 gap-2">
          <div class="font-medium">Nama Desa</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->desa->nama_desa }}</div>

          <div class="font-medium">RT/RW</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->rtRwDesa->rt }}/{{ $saranaIbadahDesa->rtRwDesa->rw }}</div>

          <div class="font-medium">Tahun</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->tahun }}</div>

          <div class="font-medium">Jenis Sarana Ibadah</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->jenis_sarana_ibadah }}</div>

          <div class="font-medium">Nama Sarana Ibadah</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->nama_sarana_ibadah }}</div>

          <div class="font-medium">Latitude</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->latitude }}</div>

          <div class="font-medium">Longitude</div>
          <div class="col-span-2">{{ $saranaIbadahDesa->longitude }}</div>
        </div>
      </div>

      {{-- Footer --}}
      <div class="flex items-center justify-end px-4 py-3 border-t">
        <button class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700"
                onclick="closeModal('{{ $saranaIbadahDesa->id }}')">
          Tutup
        </button>
      </div>

    </div>
  </div>
</div>
