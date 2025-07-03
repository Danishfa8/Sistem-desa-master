<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $sumberDayaAlamDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $sumberDayaAlamDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_sumber_daya_alam" class="form-label">{{ __('Jenis Sumber Daya Alam') }}</label>
            <select name="jenis_sumber_daya_alam"
                class="form-control @error('jenis_sumber_daya_alam') is-invalid @enderror" id="jenis_sumber_daya_alam">
                <option value="">-- Pilih Jenis Sumber Daya Alam --</option>
                <option value="Golongan C"
                    {{ old('jenis_sumber_daya_alam', $sumberDayaAlamDesa?->jenis_sumber_daya_alam) == 'Golongan C' ? 'selected' : '' }}>
                    Golongan C
                </option>
                <option value="Bahan Galian"
                    {{ old('jenis_sumber_daya_alam', $sumberDayaAlamDesa?->jenis_sumber_daya_alam) == 'Bahan Galian' ? 'selected' : '' }}>
                    Bahan Galian
                </option>
            </select>
            {!! $errors->first(
                'jenis_sumber_daya_alam',
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
