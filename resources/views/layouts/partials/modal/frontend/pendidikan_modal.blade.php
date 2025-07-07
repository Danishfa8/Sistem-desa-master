{{-- Modal Pendidikan Desa --}}
<div id="showModal{{ $pendidikan->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50" role="dialog" aria-modal="true" aria-labelledby="showModalLabel{{ $pendidikan->id }}">
  <div class="flex items-center justify-center min-h-screen px-4" onclick="handleOutsideClick(event, '{{ $pendidikan->id }}')">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl" onclick="event.stopPropagation()">

      {{-- Header --}}
      <div class="flex items-center justify-between px-4 py-3 border-b">
        <h2 id="showModalLabel{{ $pendidikan->id }}" class="text-lg font-semibold text-gray-800">
          Detail Sarana Pendidikan {{ $pendidikan->desa->nama_desa }}
        </h2>
        <button type="button" class="text-gray-600 hover:text-gray-900" onclick="closeModal('{{ $pendidikan->id }}')">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      {{-- Foto --}}
      <div class="px-4 pt-4">
        @if ($pendidikan->foto)
          <div class="text-center mb-3">
            <img src="{{ asset('storage/foto_pendidikan/' . $pendidikan->foto) }}"
                 alt="Foto Pendidikan"
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
          <div class="col-span-2">{{ $pendidikan->desa->nama_desa }}</div>

          <div class="font-medium">RT/RW</div>
          <div class="col-span-2">{{ $pendidikan->rtRwDesa->rt }}/{{ $pendidikan->rtRwDesa->rw }}</div>

          <div class="font-medium">Tahun</div>
          <div class="col-span-2">{{ $pendidikan->tahun }}</div>

          <div class="font-medium">Nama Pendidikan</div>
          <div class="col-span-2">{{ $pendidikan->nama_pendidikan }}</div>

          <div class="font-medium">Jenis Pendidikan</div>
          <div class="col-span-2">{{ $pendidikan->jenis_pendidikan }}</div>

          <div class="font-medium">Status Pendidikan</div>
          <div class="col-span-2">{{ $pendidikan->status_pendidikan }}</div>

          <div class="font-medium">Latitude</div>
          <div class="col-span-2">{{ $pendidikan->latitude }}</div>

          <div class="font-medium">Longitude</div>
          <div class="col-span-2">{{ $pendidikan->longitude }}</div>
        </div>
      </div>

      {{-- Footer --}}
      <div class="flex items-center justify-end px-4 py-3 border-t">
        <button class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700"
                onclick="closeModal('{{ $pendidikan->id }}')">
          Tutup
        </button>
      </div>

    </div>
  </div>
</div>
