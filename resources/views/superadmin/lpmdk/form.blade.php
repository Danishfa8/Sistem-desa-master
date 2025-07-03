<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $lpmdk?->desa_id) == $item->id ? 'selected' : '' }}>
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
            <label for="jumlah_pengurus" class="form-label">{{ __('Jumlah Pengurus') }}</label>
            <input type="number" name="jumlah_pengurus"
                class="form-control @error('jumlah_pengurus') is-invalid @enderror"
                value="{{ old('jumlah_pengurus', $lpmdk?->jumlah_pengurus) }}" id="jumlah_pengurus"
                placeholder="Jumlah Pengurus">
            {!! $errors->first(
                'jumlah_pengurus',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jumlah_anggota" class="form-label">{{ __('Jumlah Anggota') }}</label>
            <input type="number" name="jumlah_anggota"
                class="form-control @error('jumlah_anggota') is-invalid @enderror"
                value="{{ old('jumlah_anggota', $lpmdk?->jumlah_anggota) }}" id="jumlah_anggota"
                placeholder="Jumlah Anggota">
            {!! $errors->first(
                'jumlah_anggota',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jumlah_kegiatan" class="form-label">{{ __('Jumlah Kegiatan') }}</label>
            <input type="number" name="jumlah_kegiatan"
                class="form-control @error('jumlah_kegiatan') is-invalid @enderror"
                value="{{ old('jumlah_kegiatan', $lpmdk?->jumlah_kegiatan) }}" id="jumlah_kegiatan"
                placeholder="Jumlah Kegiatan">
            {!! $errors->first(
                'jumlah_kegiatan',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jumlah_buku_administrasi" class="form-label">{{ __('Jumlah Buku Administrasi') }}</label>
            <input type="number" name="jumlah_buku_administrasi"
                class="form-control @error('jumlah_buku_administrasi') is-invalid @enderror"
                value="{{ old('jumlah_buku_administrasi', $lpmdk?->jumlah_buku_administrasi) }}"
                id="jumlah_buku_administrasi" placeholder="Jumlah Buku Administrasi">
            {!! $errors->first(
                'jumlah_buku_administrasi',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jumlah_dana" class="form-label">{{ __('Jumlah Dana') }}</label>
            <input type="number" name="jumlah_dana" class="form-control @error('jumlah_dana') is-invalid @enderror"
                value="{{ old('jumlah_dana', $lpmdk?->jumlah_dana) }}" id="jumlah_dana" placeholder="Jumlah Dana">
            {!! $errors->first('jumlah_dana', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
