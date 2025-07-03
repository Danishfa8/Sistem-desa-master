<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $disabilitasDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
            <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                value="{{ old('tahun', $disabilitasDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <label for="jenis_disabilitas" class="form-label">{{ __('Jenis Disabilitas') }}</label>
        <select name="jenis_disabilitas" class="form-control @error('jenis_disabilitas') is-invalid @enderror"
            id="jenis_disabilitas">
            <option value="">-- Pilih Jenis Disabilitas --</option>
            <option value="Tuna Netra"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Tuna Netra' ? 'selected' : '' }}>
                Tuna Netra
            </option>
            <option value="Tuna Rungu"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Tuna Rungu' ? 'selected' : '' }}>
                Tuna Rungu
            </option>
            <option value="TUna Daksa"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'TUna Daksa' ? 'selected' : '' }}>
                TUna Daksa
            </option>
            <option value="Retardasi"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Retardasi' ? 'selected' : '' }}>
                Retardasi
            </option>
            <option value="Rungu Wicara"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Rungu Wicara' ? 'selected' : '' }}>
                Rungu Wicara
            </option>
            <option value="Tuna Wicara"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Tuna Wicara' ? 'selected' : '' }}>
                Tuna Wicara
            </option>
            <option value="Tuna Sensorik"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Tuna Sensorik' ? 'selected' : '' }}>
                Tuna Sensorik
            </option>
            <option value="Tuna Ganda"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Tuna Ganda' ? 'selected' : '' }}>
                Tuna Ganda
            </option>
            <option value="Lainya"
                {{ old('jenis_disabilitas', $disabilitasDesa?->jenis_disabilitas) == 'Lainya' ? 'selected' : '' }}>
                Lainya
            </option>

        </select>
        {!! $errors->first(
            'jenis_disabilitas',
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
