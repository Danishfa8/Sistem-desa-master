<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2">
            <label for="id_kategori" class="form-label">{{ __('Kategori') }}</label>
            <select name="id_kategori" id="id_kategori" class="form-control select2 @error('id_kategori') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ old('id_kategori', $budaya?->id_kategori) == $kategori->id ? 'selected' : '' }}>
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
                    {{ old('desa_id', $budaya?->desa_id) == $item->id ? 'selected' : '' }}>
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
                value="{{ old('tahun', $budaya?->tahun) }}" id="tahun" placeholder="Contoh: 2025" min="1900" max="{{ date('Y') + 5 }}">
            {!! $errors->first('tahun', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jenis_kebudayaan" class="form-label">{{ __('Jenis') }}</label>
            <select name="jenis_kebudayaan" class="form-control @error('jenis_kebudayaan') is-invalid @enderror" id="jenis_kebudayaan">
                <option value="">-- Pilih Jenis Kebudayaan --</option>
                <option value="Kesenian Budaya" {{ old('jenis_kebudayaan', $budaya?->jenis_kebudayaan) == 'Kesenian Budaya' ? 'selected' : '' }}>
                    Kesenian/Budaya
                </option>
                <option value="Cagar Budaya"
                    {{ old('jenis_kebudayaan', $budaya?->jenis_kebudayaan) == 'Cagar Budaya' ? 'selected' : '' }}>
                    Cagar Budaya
                </option>
                <option value="Gallery Seni Souvenir" {{ old('jenis_kebudayaan', $budaya?->jenis_kebudayaan) == 'Gallery Seni Souvenir' ? 'selected' : '' }}>
                    Gallery Seni & Souvenir
                </option>
                <option value="Penginapan" {{ old('jenis_kebudayaan', $budaya?->jenis_kebudayaan) == 'Penginapan' ? 'selected' : '' }}>
                    Penginapan
                </option>
                <option value="Tempat Wisata" {{ old('jenis_kebudayaan', $budaya?->jenis_kebudayaan) == 'Tempat Wisata' ? 'selected' : '' }}>
                    Tempat Wisata
                </option>
            </select>
            {!! $errors->first('jenis', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_kebudayaan" class="form-label">{{ __('Nama Kebudayaan') }}</label>
            <input type="text" name="nama_kebudayaan" class="form-control @error('nama_kebudayaan') is-invalid @enderror"
                value="{{ old('nama_kebudayaan', $budaya?->nama_kebudayaan) }}" id="nama_kebudayaan" placeholder="Nama kebudayaan">
            {!! $errors->first('nama', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
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