<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $industriPenghasilLimbahDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $industriPenghasilLimbahDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_industri" class="form-label">{{ __('Jenis Industri') }}</label>
            <select name="jenis_industri" class="form-control @error('jenis_industri') is-invalid @enderror"
                id="jenis_industri">
                <option value="">-- Pilih Jenis Industri --</option>
                <option value="Memiliki Unit Pengolahan Limbah"
                    {{ old('jenis_industri', $industriPenghasilLimbahDesa?->jenis_industri) == 'Memiliki Unit Pengolahan Limbah' ? 'selected' : '' }}>
                    Memiliki Unit Pengolahan Limbah
                </option>
                <option value="Belum Memiliki Unit Pengolahan Limbah"
                    {{ old('jenis_industri', $industriPenghasilLimbahDesa?->jenis_industri) == 'Belum Memiliki Unit Pengolahan Limbah' ? 'selected' : '' }}>
                    Belum Memiliki Unit Pengolahan Limbah
                </option>

            </select>
            {!! $errors->first(
                'jenis_industri',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Arsip" id="status" placeholder="Status">
    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
