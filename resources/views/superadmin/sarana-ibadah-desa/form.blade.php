<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $saranaIbadahDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
            <input type="number" min="1900" max="2099" name="tahun"
                class="form-control @error('tahun') is-invalid @enderror"
                value="{{ old('tahun', $saranaIbadahDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_sarana_ibadah" class="form-label">{{ __('Jenis Sarana Ibadah') }}</label>
            <select name="jenis_sarana_ibadah" class="form-control @error('jenis_sarana_ibadah') is-invalid @enderror"
                id="jenis_sarana_ibadah">
                <option value="">-- Pilih Jenis Sarana Ibadah --</option>
                <option value="Masjid"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Masjid' ? 'selected' : '' }}>
                    Masjid
                </option>
                <option value="Mushola"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Mushola' ? 'selected' : '' }}>
                    Mushola
                </option>
                <option value="Gereja"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Gereja' ? 'selected' : '' }}>
                    Gereja
                </option>
                <option value="Pura"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Pura' ? 'selected' : '' }}>
                    Pura
                </option>
                <option value="Vihara"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Vihara' ? 'selected' : '' }}>
                    Vihara
                </option>
                <option value="Kelenteng"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Kelenteng' ? 'selected' : '' }}>
                    Kelenteng
                </option>
                <option value="Kantor Lembaga Keagamaan"
                    {{ old('jenis_sarana_ibadah', $saranaIbadahDesa?->jenis_sarana_ibadah) == 'Kantor Lembaga Keagamaan' ? 'selected' : '' }}>
                    Kantor Lembaga Keagamaan
                </option>
            </select>
            {!! $errors->first(
                'jenis_sarana_ibadah',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_sarana_ibadah" class="form-label">{{ __('Nama Sarana Ibadah') }}</label>
            <input type="text" name="nama_sarana_ibadah"
                class="form-control @error('nama_sarana_ibadah') is-invalid @enderror"
                value="{{ old('nama_sarana_ibadah', $saranaIbadahDesa?->nama_sarana_ibadah) }}" id="nama_sarana_ibadah"
                placeholder="Nama Sarana Ibadah">
            {!! $errors->first(
                'nama_sarana_ibadah',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="foto" class="form-label">{{ __('Foto') }}</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                value="{{ old('foto', $saranaIbadahDesa?->foto) }}" id="foto" placeholder="Foto" required>
            {!! $errors->first('foto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="latitude" class="form-label">{{ __('Latitude') }}</label>
            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                value="{{ old('latitude', $saranaIbadahDesa?->latitude) }}" id="latitude" placeholder="Latitude"
                required>
            {!! $errors->first('latitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="longitude" class="form-label">{{ __('Longitude') }}</label>
            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                value="{{ old('longitude', $saranaIbadahDesa?->longitude) }}" id="longitude" placeholder="Longitude"
                required>
            {!! $errors->first('longitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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
