<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="kecamatan_id" class="form-label">{{ __('Kecamatan') }}</label>
            <select name="kecamatan_id" id="kecamatan_id" class="form-control @error('kecamatan_id') is-invalid @enderror">
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($kecamatans as $item)
                    <option value="{{ $item->id }}"
                        {{ old('kecamatan_id', $desa?->kecamatan_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kecamatan }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('kecamatan_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_desa" class="form-label">{{ __('Nama Desa') }}</label>
            <input type="text" name="nama_desa" class="form-control @error('nama_desa') is-invalid @enderror"
                value="{{ old('nama_desa', $desa?->nama_desa) }}" id="nama_desa" placeholder="Nama Desa">
            {!! $errors->first('nama_desa', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="klas" class="form-label">{{ __('Klas') }}</label>
            <input type="text" name="klas" class="form-control @error('klas') is-invalid @enderror"
                value="{{ old('klas', $desa?->klas) }}" id="klas" placeholder="Klas">
            {!! $errors->first('klas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="stat_pem" class="form-label">{{ __('Stat Pem') }}</label>
            <input type="text" name="stat_pem" class="form-control @error('stat_pem') is-invalid @enderror"
                value="{{ old('stat_pem', $desa?->stat_pem) }}" id="stat_pem" placeholder="Stat Pem">
            {!! $errors->first('stat_pem', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="latitude" class="form-label">{{ __('Latitude') }}</label>
            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                value="{{ old('latitude', $desa?->latitude) }}" id="latitude" placeholder="Latitude">
            {!! $errors->first('latitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="longitude" class="form-label">{{ __('Longitude') }}</label>
            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                value="{{ old('longitude', $desa?->longitude) }}" id="longitude" placeholder="Longitude">
            {!! $errors->first('longitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
