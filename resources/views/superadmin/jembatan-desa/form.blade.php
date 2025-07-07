<div class="row p-1">
    <div class="col-md-12">

        {{-- Desa --}}
        <div class="form-group mb-2">
            <label for="desa_id">Desa</label>
            <select name="desa_id" id="desa_id"
                class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $jembatanDesa?->desa_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_desa }}
                    </option>
                @endforeach
            </select>
            @error('desa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- RT/RW --}}
        <div class="form-group mb-2">
            <label for="rt_rw_desa_id">RT/RW</label>
            <select name="rt_rw_desa_id" id="rt_rw_desa_id"
                class="form-control @error('rt_rw_desa_id') is-invalid @enderror" required>
                <option value="">-- Pilih RT/RW --</option>
            </select>
            @error('rt_rw_desa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Nama Jembatan --}}
        <div class="form-group mb-2">
            <label for="nama_jembatan">Nama Jembatan</label>
            <input type="text" name="nama_jembatan"
                class="form-control @error('nama_jembatan') is-invalid @enderror"
                value="{{ old('nama_jembatan', $jembatanDesa?->nama_jembatan) }}">
            @error('nama_jembatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Panjang --}}
        <div class="form-group mb-2">
            <label for="panjang">Panjang (m)</label>
            <input type="number" name="panjang" class="form-control @error('panjang') is-invalid @enderror"
                value="{{ old('panjang', $jembatanDesa?->panjang) }}">
            @error('panjang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Lebar --}}
        <div class="form-group mb-2">
            <label for="lebar">Lebar (m)</label>
            <input type="number" name="lebar" class="form-control @error('lebar') is-invalid @enderror"
                value="{{ old('lebar', $jembatanDesa?->lebar) }}">
            @error('lebar') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Kondisi --}}
        <div class="form-group mb-2">
            <label for="kondisi">Kondisi</label>
            <select name="kondisi" class="form-control @error('kondisi') is-invalid @enderror">
                <option value="">-- Pilih Kondisi --</option>
                @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $kondisi)
                    <option value="{{ $kondisi }}"
                        {{ old('kondisi', $jembatanDesa?->kondisi) == $kondisi ? 'selected' : '' }}>
                        {{ $kondisi }}
                    </option>
                @endforeach
            </select>
            @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Lokasi --}}
        <div class="form-group mb-2">
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                value="{{ old('lokasi', $jembatanDesa?->lokasi) }}">
            @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Latitude & Longitude --}}
        <div class="form-group mb-2">
            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                value="{{ old('latitude', $jembatanDesa?->latitude) }}">
            @error('latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-danger">*Opsional</small>
        </div>

        <div class="form-group mb-2">
            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                value="{{ old('longitude', $jembatanDesa?->longitude) }}">
            @error('longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-danger">*Opsional</small>
        </div>

        {{-- Foto --}}
        <div class="form-group mb-2">
            <label for="foto">Foto Jembatan</label>
            <input type="file" name="foto" accept="image/*"
                class="form-control @error('foto') is-invalid @enderror"
                {{ isset($jembatanDesa->id) ? '' : 'required' }}>
            <small class="text-muted">Format: jpg, jpeg, png. Maks 2MB.</small>
            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror

            @if (isset($jembatanDesa->foto))
                <div class="mt-2">
                    <img src="{{ asset('storage/foto_jembatan/' . $jembatanDesa->foto) }}"
                        alt="Foto Jembatan" style="max-height: 150px; border: 1px solid #ccc;">
                </div>
            @endif
        </div>

        {{-- Hidden fields --}}
        <input type="hidden" name="created_by" value="{{ auth()->user()->name }}">
        <input type="hidden" name="updated_by" value="{{ auth()->user()->name }}">
        <input type="hidden" name="status" value="Approved">
        <input type="hidden" name="approved_by" value="{{ auth()->user()->name }}">
        <input type="hidden" name="approved_at" value="{{ now()->format('Y-m-d H:i:s') }}">
    </div>

    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </div>
</div>


<!-- <div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $jembatanDesa?->desa_id) == $item->id ? 'selected' : '' }}>
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
            <label for="nama_jembatan" class="form-label">{{ __('Nama Jembatan') }}</label>
            <input type="text" name="nama_jembatan" class="form-control @error('nama_jembatan') is-invalid @enderror"
                value="{{ old('nama_jembatan', $jembatanDesa?->nama_jembatan) }}" id="nama_jembatan"
                placeholder="Nama Jembatan">
            {!! $errors->first(
                'nama_jembatan',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="panjang" class="form-label">{{ __('Panjang') }}</label>
            <input type="number" name="panjang" class="form-control @error('panjang') is-invalid @enderror"
                value="{{ old('panjang', $jembatanDesa?->panjang) }}" id="panjang" placeholder="Panjang (Meter)">
            {!! $errors->first('panjang', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="lebar" class="form-label">{{ __('Lebar') }}</label>
            <input type="number" name="lebar" class="form-control @error('lebar') is-invalid @enderror"
                value="{{ old('lebar', $jembatanDesa?->lebar) }}" id="lebar" placeholder="Lebar (Meter)">
            {!! $errors->first('lebar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="kondisi" class="form-label">{{ __('Kondisi') }}</label>
            <select name="kondisi" class="form-control @error('kondisi') is-invalid @enderror" id="kondisi">
                <option value="">-- Pilih Kondisi --</option>
                <option value="Baik" {{ old('kondisi', $jembatanDesa?->kondisi) == 'Baik' ? 'selected' : '' }}>Baik
                </option>
                <option value="Rusak Ringan"
                    {{ old('kondisi', $jembatanDesa?->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                </option>
                <option value="Rusak Berat"
                    {{ old('kondisi', $jembatanDesa?->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat
                </option>
            </select>
            {!! $errors->first('kondisi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="lokasi" class="form-label">{{ __('Lokasi') }}</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                value="{{ old('lokasi', $jembatanDesa?->lokasi) }}" id="lokasi" placeholder="Lokasi">
            {!! $errors->first('lokasi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="updated_by" class="form-control" value="{{ $kelembagaanDesa->updated_by ?? '-' }}">
        <input type="hidden" name="status" class="form-control" value="Approved" id="status" placeholder="Status">
        <input type="hidden" name="approved_by" value="{{ Auth::user()->name }}">
        <input type="hidden" name="approved_at" value="{{ now()->format('Y-m-d H:i:s') }}">
        <div class="form-group mb-2 mb20">
            <label for="latitude" class="form-label">{{ __('Latitude') }}</label>
            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                value="{{ old('latitude', $jembatanDesa?->latitude) }}" id="latitude" placeholder="Latitude">
            {!! $errors->first('latitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="text-danger">*Opsional</small>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="longitude" class="form-label">{{ __('Longitude') }}</label>
            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                value="{{ old('longitude', $jembatanDesa?->longitude) }}" id="longitude" placeholder="Longitude">
            {!! $errors->first('longitude', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            <small class="text-danger">*Opsional</small>
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div> -->
