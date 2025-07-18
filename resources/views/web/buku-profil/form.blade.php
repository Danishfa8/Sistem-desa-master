<!-- @extends('layouts.appweb2')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-xl font-bold mb-4">Cetak Buku Profil Desa</h1>
    
    <form action="{{ route('buku.cetak') }}" method="GET" target="_blank">
        @csrf

        <div class="mb-4">
            <label for="kecamatan_id" class="block mb-1 font-semibold">Pilih Kecamatan</label>
            <select name="kecamatan_id" id="kecamatan_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($kecamatan as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="desa_id" class="block mb-1 font-semibold">Pilih Desa</label>
            <select name="desa_id" id="desa_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Desa --</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="tahun" class="block mb-1 font-semibold">Pilih Tahun</label>
            <input type="number" name="tahun" id="tahun" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Cetak PDF
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('kecamatan_id').addEventListener('change', function () {
        let kecamatanId = this.value;
        let desaSelect = document.getElementById('desa_id');

        desaSelect.innerHTML = '<option value="">Memuat...</option>';

        if (kecamatanId) {
            fetch('/get-desa/' + kecamatanId)
                .then(res => res.json())
                .then(data => {
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
                    Object.entries(data).forEach(([id, nama]) => {
                        desaSelect.innerHTML += `<option value="${id}">${nama}</option>`;
                    });
                });
        } else {
            desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
        }
    });
</script>
@endpush -->
