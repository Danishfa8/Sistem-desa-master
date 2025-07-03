<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $pendidikanDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $pendidikanDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_pendidikan" class="form-label">{{ __('Jenis Pendidikan') }}</label>
            <select name="jenis_pendidikan" class="form-control @error('jenis_pendidikan') is-invalid @enderror"
                id="jenis_pendidikan">
                <option value="">-- Pilih Jenis Pendidikan --</option>
                <option value="Perpustakaan"
                    {{ old('jenis_pendidikan', $pendidikanDesa?->jenis_pendidikan) == 'Perpustakaan' ? 'selected' : '' }}>
                    Perpustakaan
                </option>
                <option value="SD"
                    {{ old('jenis_pendidikan', $pendidikanDesa?->jenis_pendidikan) == 'SD' ? 'selected' : '' }}>
                    SD
                </option>
                <option value="SMP/MTS"
                    {{ old('jenis_pendidikan', $pendidikanDesa?->jenis_pendidikan) == 'SMP/MTS' ? 'selected' : '' }}>
                    SMP/MTS
                </option>
                <option value="SMA/SMK/MA"
                    {{ old('jenis_pendidikan', $pendidikanDesa?->jenis_pendidikan) == 'SMA/SMK/MA' ? 'selected' : '' }}>
                    SMA/SMK/MA
                </option>
                <option value="Perguruan Tinggi"
                    {{ old('jenis_pendidikan', $pendidikanDesa?->jenis_pendidikan) == 'Perguruan Tinggi' ? 'selected' : '' }}>
                    Perguruan Tinggi
                </option>
                <option value="Pendidikan Non Formal"
                    {{ old('jenis_pendidikan', $pendidikanDesa?->jenis_pendidikan) == 'Pendidikan Non Formal' ? 'selected' : '' }}>
                    Pendidikan Non Formal
                </option>
            </select>
            {!! $errors->first(
                'jenis_pendidikan',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status_pendidikan" class="form-label">{{ __('Status Pendidikan') }}</label>
            <select name="status_pendidikan" class="form-control @error('status_pendidikan') is-invalid @enderror"
                id="status_pendidikan">
                <option value="">-- Pilih Status Pendidikan --</option>
                <option value="Negeri"
                    {{ old('status_pendidikan', $pendidikanDesa?->status_pendidikan) == 'Negeri' ? 'selected' : '' }}>
                    Negeri
                </option>
                <option value="Swasta"
                    {{ old('status_pendidikan', $pendidikanDesa?->status_pendidikan) == 'Swasta' ? 'selected' : '' }}>
                    Swasta
                </option>

            </select>
            {!! $errors->first(
                'status_pendidikan',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="foto" class="form-label">{{ __('Foto') }}</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                value="{{ old('foto', $pendidikanDesa?->foto) }}" id="foto" placeholder="Foto" required>
            {!! $errors->first('foto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="text-danger">*Maks 2MB</small>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="latitude" class="form-label">{{ __('Latitude') }}</label>
            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                value="{{ old('latitude', $pendidikanDesa?->latitude) }}" id="latitude" placeholder="Latitude"
                required>
            {!! $errors->first('latitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            {{-- <small class="text-danger">*Opsional</small> --}}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="longitude" class="form-label">{{ __('Longitude') }}</label>
            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                value="{{ old('longitude', $pendidikanDesa?->longitude) }}" id="longitude" placeholder="Longitude"
                required>
            {!! $errors->first('longitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            {{-- <small class="text-danger">*Opsional</small> --}}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Arsip" id="status" placeholder="Status">

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
