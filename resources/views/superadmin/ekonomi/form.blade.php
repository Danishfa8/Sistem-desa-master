<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $ekonomi?->desa_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_desa }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('desa_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tahun" class="form-label">{{ __('Tahun') }}</label>
            <input type="number" min="999" max="9999" name="tahun"
                class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $ekonomi?->tahun) }}"
                id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis" class="form-label">{{ __('Jenis') }}</label>
            <select name="jenis" class="form-control @error('jenis') is-invalid @enderror" id="jenis">
                <option value="">-- Pilih Jenis Ekonomi --</option>
                <option value="Toko Modern" {{ old('jenis', $ekonomi?->jenis) == 'Toko Modern' ? 'selected' : '' }}>
                    Toko Modern
                </option>
                <option value="Warung Tradisional"
                    {{ old('jenis', $ekonomi?->jenis) == 'Warung Tradisional' ? 'selected' : '' }}>
                    Warung Tradisional
                </option>
                <option value="Industri" {{ old('jenis', $ekonomi?->jenis) == 'Industri' ? 'selected' : '' }}>
                    Industri
                </option>
            </select>
            {!! $errors->first('jenis', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama" class="form-label">{{ __('Nama') }}</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $ekonomi?->nama) }}" id="nama" placeholder="Nama">
            {!! $errors->first('nama', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="pemilik" class="form-label">{{ __('Pemilik') }}</label>
            <input type="text" name="pemilik" class="form-control @error('pemilik') is-invalid @enderror"
                value="{{ old('pemilik', $ekonomi?->pemilik) }}" id="pemilik" placeholder="Pemilik">
            {!! $errors->first('pemilik', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ Auth::user()->name }}">
        <input type="hidden" name="status" class="form-control" value="Approved" id="status" placeholder="Status">
        <input type="hidden" name="approved_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="approved_at" value="{{ now()->format('Y-m-d H:i:s') }}">

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
