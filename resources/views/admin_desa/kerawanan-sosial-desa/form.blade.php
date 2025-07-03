<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $kerawananSosialDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $kerawananSosialDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <label for="jenis_kerawanan" class="form-label">{{ __('Jenis Kerawanan') }}</label>
        <select name="jenis_kerawanan" class="form-control @error('jenis_kerawanan') is-invalid @enderror"
            id="jenis_kerawanan">
            <option value="">-- Pilih Jenis Kerawanan --</option>
            <option value="Jumlah Keluarga Miskin"
                {{ old('jenis_kerawanan', $kerawananSosialDesa?->jenis_kerawanan) == 'Jumlah Keluarga Miskin' ? 'selected' : '' }}>
                Jumlah Keluarga Miskin
            </option>
            <option value="Penduduk Stunting"
                {{ old('jenis_kerawanan', $kerawananSosialDesa?->jenis_kerawanan) == 'Penduduk Stunting' ? 'selected' : '' }}>
                Penduduk Stunting
            </option>
            <option value="Penduduk Putus Sekolah"
                {{ old('jenis_kerawanan', $kerawananSosialDesa?->jenis_kerawanan) == 'Penduduk Putus Sekolah' ? 'selected' : '' }}>
                Penduduk Putus Sekolah
            </option>
        </select>
        {!! $errors->first(
            'jenis_kerawanan',
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
