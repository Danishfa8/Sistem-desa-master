<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $olahragaDesa?->desa_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_desa }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('desa_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="rt_rw_desa_id">RT/RW</label>
            <select name="rt_rw_desa_id" id="rt_rw_desa_id" class="form-control" required>
                <option value="">-- Pilih RT/RW --</option>
            </select>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tahun" class="form-label">{{ __('Tahun') }}</label>
            <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                value="{{ old('tahun', $olahragaDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_olahraga" class="form-label">{{ __('Jenis Olahraga') }}</label>
            <select name="jenis_olahraga" class="form-control @error('jenis_olahraga') is-invalid @enderror"
                id="jenis_olahraga">
                <option value="">-- Pilih Jenis Olahraga --</option>
                <option value="Sepak Bola"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Sepak Bola' ? 'selected' : '' }}>
                    Sepak Bola
                </option>
                <option value="Bulu Tangkis"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Bulu Tangkis' ? 'selected' : '' }}>
                    Bulu Tangkis
                </option>
                <option value="Tenis Meja"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Tenis Meja' ? 'selected' : '' }}>
                    Tenis Meja
                </option>
                <option value="Futsal/Mini Soccer"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Futsal/Mini Soccer' ? 'selected' : '' }}>
                    Futsal/Mini Soccer
                </option>
                <option value="Voli"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Voli' ? 'selected' : '' }}>
                    Voli
                </option>
                <option value="Kolamm Renang"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Kolamm Renang' ? 'selected' : '' }}>
                    Kolamm Renang
                </option>
                <option value="Basket"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Basket' ? 'selected' : '' }}>
                    Basket
                </option>
                <option value="Tenis Lapangan"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Tenis Lapangan' ? 'selected' : '' }}>
                    Tenis Lapangan
                </option>
                <option value="Kelompok Olahraga"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Kelompok Olahraga' ? 'selected' : '' }}>
                    Kelompok Olahraga
                </option>
                <option value="Lainnya"
                    {{ old('jenis_olahraga', $olahragaDesa?->jenis_olahraga) == 'Lainnya' ? 'selected' : '' }}>
                    Lainnya
                </option>
            </select>
            {!! $errors->first(
                'jenis_olahraga',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_kelompok_olahraga" class="form-label">{{ __('Nama Kelompok Olahraga') }}</label>
            <input type="text" name="nama_kelompok_olahraga"
                class="form-control @error('nama_kelompok_olahraga') is-invalid @enderror"
                value="{{ old('nama_kelompok_olahraga', $olahragaDesa?->nama_kelompok_olahraga) }}"
                id="nama_kelompok_olahraga" placeholder="Nama Kelompok Olahraga">
            {!! $errors->first(
                'nama_kelompok_olahraga',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Approved" id="status" placeholder="Status">
        <input type="hidden" name="approved_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="approved_at" value="{{ now()->format('Y-m-d H:i:s') }}">
    
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
