<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $saranaPendukungKesehatanDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $saranaPendukungKesehatanDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_sarana" class="form-label">{{ __('Jenis Sarana') }}</label>
            <select name="jenis_sarana" class="form-control @error('jenis_sarana') is-invalid @enderror"
                id="jenis_sarana">
                <option value="">-- Pilih Jenis Sarana --</option>
                <option value="Praktek Doketer"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Praktek Doketer' ? 'selected' : '' }}>
                    Praktek Doketer
                </option>
                <option value="Praktek Dokter Spesialis"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Praktek Dokter Spesialis' ? 'selected' : '' }}>
                    Praktek Dokter Spesialis
                </option>
                <option value="Praktek Dokter Gigi"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Praktek Dokter Gigi' ? 'selected' : '' }}>
                    Praktek Dokter Gigi
                </option>
                <option value="Praktek Bidan"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Praktek Bidan' ? 'selected' : '' }}>
                    Praktek Bidan
                </option>
                <option value="Praktek Dokter Hewan"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Praktek Dokter Hewan' ? 'selected' : '' }}>
                    Praktek Dokter Hewan
                </option>
                <option value="Apotek"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Apotek' ? 'selected' : '' }}>
                    Apotek
                </option>
                <option value="Toko Obat Tradisional"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Toko Obat Tradisional' ? 'selected' : '' }}>
                    Toko Obat Tradisional
                </option>
                <option value="Ambulan"
                    {{ old('jenis_sarana', $saranaPendukungKesehatanDesa?->jenis_sarana) == 'Ambulan' ? 'selected' : '' }}>
                    Ambulan
                </option>

            </select>
            {!! $errors->first('jenis_sarana', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Arsip" id="status" placeholder="Status">

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
