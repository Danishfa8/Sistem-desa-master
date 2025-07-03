<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $energiDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $energiDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_energi" class="form-label">{{ __('Jenis Energi') }}</label>
            <select name="jenis_energi" class="form-control @error('jenis_energi') is-invalid @enderror"
                id="jenis_energi">
                <option value="">-- Pilih Jenis Energi --</option>
                <option value="Energi Terbarukan"
                    {{ old('jenis_energi', $energiDesa?->jenis_energi) == 'Energi Terbarukan' ? 'selected' : '' }}>
                    Energi Terbarukan
                </option>
                <option value="Stasiun Energi"
                    {{ old('jenis_energi', $energiDesa?->jenis_energi) == 'Stasiun Energi' ? 'selected' : '' }}>
                    Stasiun Energi
                </option>
                <option value="Pertashop"
                    {{ old('jenis_energi', $energiDesa?->jenis_energi) == 'Pertashop' ? 'selected' : '' }}>
                    Pertashop
                </option>
                <option value="Agen LPG"
                    {{ old('jenis_energi', $energiDesa?->jenis_energi) == 'Agen LPG' ? 'selected' : '' }}>
                    Agen LPG
                </option>
            </select>
            {!! $errors->first('jenis_energi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Arsip" id="status" placeholder="Status">

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
