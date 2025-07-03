<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $kondisiLingkunganKeluargaDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $kondisiLingkunganKeluargaDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <label for="jenis_kondisi" class="form-label">{{ __('Jenis Kondisi') }}</label>
        <select name="jenis_kondisi" class="form-control @error('jenis_kondisi') is-invalid @enderror"
            id="jenis_kondisi">
            <option value="">-- Pilih Jenis Kondisi --</option>
            <option value="Keluarga Pengguna PDAM"
                {{ old('jenis_kondisi', $kondisiLingkunganKeluargaDesa?->jenis_kondisi) == 'Keluarga Pengguna PDAM' ? 'selected' : '' }}>
                Keluarga Pengguna PDAM
            </option>
            <option value="Belum Memiliki WC"
                {{ old('jenis_kondisi', $kondisiLingkunganKeluargaDesa?->jenis_kondisi) == 'Belum Memiliki WC' ? 'selected' : '' }}>
                Belum Memiliki WC
            </option>
            <option value="Belum Memiliki Septic Tank"
                {{ old('jenis_kondisi', $kondisiLingkunganKeluargaDesa?->jenis_kondisi) == 'Belum Memiliki Septic Tank' ? 'selected' : '' }}>
                Belum Memiliki Septic Tank
            </option>
        </select>
        {!! $errors->first(
            'jenis_kondisi',
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
