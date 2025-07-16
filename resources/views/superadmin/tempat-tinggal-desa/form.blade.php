<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2">
            <label for="id_kategori" class="form-label">{{ __('Kategori') }}</label>
            <select name="id_kategori" id="id_kategori" class="form-control select2 @error('id_kategori') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ old('id_kategori', $tempatTinggalDesa?->id_kategori) == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
                @endforeach
            </select>
            {!! $errors->first('id_kategori', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                <option value="{{ $item->id }}"
                    {{ old('desa_id', $tempatTinggalDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $tempatTinggalDesa?->tahun) }}" id="tahun" placeholder="Contoh: 2025" min="1900" max="{{ date('Y') + 5 }}">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <label for="jenis_tempat_tinggal" class="form-label">{{ __('Jenis Kondisi') }}</label>
        <select name="jenis_tempat_tinggal" class="form-control @error('jenis_tempat_tinggal') is-invalid @enderror"
            id="jenis_tempat_tinggal">
            <option value="">-- Pilih Jenis Tempat Tinggal --</option>
            <option value="Jumlah Perumahan"
                {{ old('jenis_tempat_tinggal', $tempatTinggalDesa?->jenis_tempat_tinggal) == 'Jumlah Perumahan' ? 'selected' : '' }}>
                Jumlah Perumahan
            </option>
            <option value="Jumlah Rumah"
                {{ old('jenis_tempat_tinggal', $tempatTinggalDesa?->jenis_tempat_tinggal) == 'Jumlah Rumah' ? 'selected' : '' }}>
                Jumlah Rumah
            </option>
            <option value="Jumlah Warga"
                {{ old('jenis_tempat_tinggal', $tempatTinggalDesa?->jenis_tempat_tinggal) == 'Jumlah Warga' ? 'selected' : '' }}>
                Jumlah Warga
            </option>
            <option value="RLTH"
                {{ old('jenis_tempat_tinggal', $tempatTinggalDesa?->jenis_tempat_tinggal) == 'RLTH' ? 'selected' : '' }}>
                RLTH
            </option>
        </select>
        {!! $errors->first(
        'jenis_tempat_tinggal',
        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
        ) !!}
        <div class="form-group mb-2">
            <label for="jumlah" class="form-label">{{ __('Jumlah') }}</label>
            <input type="number" name="jumlah" id="jumlah"
                class="form-control @error('jumlah') is-invalid @enderror"
                value="{{ old('jumlah', $tempatTinggalDesa?->jumlah) }}"
                placeholder="Masukkan jumlah...">
            {!! $errors->first('jumlah', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
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