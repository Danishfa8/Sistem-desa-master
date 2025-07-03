<div class="row padding-1 p-1">
    <div class="col-md-12">

        <input type="hidden" name="desa_id" class="form-control @error('desa_id') is-invalid @enderror"
            value="{{ old('desa_id', $profileDesa?->desa_id) }}" id="desa_id" placeholder="Desa Id">
        <div class="form-group mb-2 mb20">
            <label for="visi" class="form-label">{{ __('Visi') }}</label>
            <textarea name="visi" class="form-control @error('visi') is-invalid @enderror"
                value="{{ old('visi', $profileDesa?->visi) }}" id="visi" placeholder="Visi"></textarea>
            {!! $errors->first('visi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="misi" class="form-label">{{ __('Misi') }}</label>
            <textarea name="misi" class="form-control @error('misi') is-invalid @enderror"
                value="{{ old('misi', $profileDesa?->misi) }}" id="misi" placeholder="Misi"></textarea>
            {!! $errors->first('misi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="program_unggulan" class="form-label">{{ __('Program Unggulan') }}</label>
            <textarea name="program_unggulan" class="form-control @error('program_unggulan') is-invalid @enderror"
                value="{{ old('program_unggulan', $profileDesa?->program_unggulan) }}" id="program_unggulan"
                placeholder="Program Unggulan"></textarea>
            {!! $errors->first(
                'program_unggulan',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="batas_wilayah" class="form-label">{{ __('Batas Wilayah') }}</label>
            <input type="text" name="batas_wilayah" class="form-control @error('batas_wilayah') is-invalid @enderror"
                value="{{ old('batas_wilayah', $profileDesa?->batas_wilayah) }}" id="batas_wilayah"
                placeholder="Batas Wilayah">
            {!! $errors->first(
                'batas_wilayah',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                value="{{ old('alamat', $profileDesa?->alamat) }}" id="alamat" placeholder="Alamat">
            {!! $errors->first('alamat', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telepon" class="form-label">{{ __('Telepon') }}</label>
            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                value="{{ old('telepon', $profileDesa?->telepon) }}" id="telepon" placeholder="Telepon">
            {!! $errors->first('telepon', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="foto" class="form-label">{{ __('Foto') }}</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                value="{{ old('foto', $profileDesa?->foto) }}" id="foto" placeholder="Foto">
            {!! $errors->first('foto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
