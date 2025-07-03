<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $saranaLainyaDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $saranaLainyaDesa?->tahun) }}" id="tahun" placeholder="Tahun">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_sarana_lainnya" class="form-label">{{ __('Jenis Sarana Lainnya') }}</label>
            <select name="jenis_sarana_lainnya" class="form-control @error('jenis_sarana_lainnya') is-invalid @enderror"
                id="jenis_sarana_lainnya">
                <option value="">-- Pilih Jenis Sarana Lainnya --</option>
                <option value="Balai Pertemuan"
                    {{ old('jenis_sarana_lainnya', $saranaLainyaDesa?->jenis_sarana_lainnya) == 'Balai Pertemuan' ? 'selected' : '' }}>
                    Balai Pertemuan
                </option>
                <option value="Ruang Terbuka Hijau"
                    {{ old('jenis_sarana_lainnya', $saranaLainyaDesa?->jenis_sarana_lainnya) == 'Ruang Terbuka Hijau' ? 'selected' : '' }}>
                    Ruang Terbuka Hijau
                </option>
                <option value="Sumur Bor"
                    {{ old('jenis_sarana_lainnya', $saranaLainyaDesa?->jenis_sarana_lainnya) == 'Sumur Bor' ? 'selected' : '' }}>
                    Sumur Bor
                </option>
                <option value="Sumur Resapan"
                    {{ old('jenis_sarana_lainnya', $saranaLainyaDesa?->jenis_sarana_lainnya) == 'Sumur Resapan' ? 'selected' : '' }}>
                    Sumur Resapan
                </option>
            </select>
            {!! $errors->first(
                'jenis_sarana_lainnya',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_sarana_lainnya" class="form-label">{{ __('Nama Sarana Lainnya') }}</label>
            <input type="text" name="nama_sarana_lainnya"
                class="form-control @error('nama_sarana_lainnya') is-invalid @enderror"
                value="{{ old('nama_sarana_lainnya', $saranaLainyaDesa?->nama_sarana_lainnya) }}"
                id="nama_sarana_lainnya" placeholder="Nama Sarana Lainnya">
            {!! $errors->first(
                'nama_sarana_lainnya',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Arsip" id="status" placeholder="Status">

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
