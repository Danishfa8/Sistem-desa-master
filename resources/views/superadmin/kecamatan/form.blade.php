<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nama_kecamatan" class="form-label">{{ __('Nama Kecamatan') }}</label>
            <input type="text" name="nama_kecamatan" class="form-control @error('nama_kecamatan') is-invalid @enderror" value="{{ old('nama_kecamatan', $kecamatan?->nama_kecamatan) }}" id="nama_kecamatan" placeholder="Nama Kecamatan">
            {!! $errors->first('nama_kecamatan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>