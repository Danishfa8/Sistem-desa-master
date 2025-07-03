<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="desa_id" class="form-label">{{ __('Desa') }}</label>
            <select name="desa_id" id="desa_id" class="form-control select2 @error('desa_id') is-invalid @enderror">
                <option value="">-- Pilih Desa --</option>
                @foreach ($desas as $item)
                    <option value="{{ $item->id }}"
                        {{ old('desa_id', $pendapatanDesa?->desa_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_desa }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('desa_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="sumber_pendapatan" class="form-label">{{ __('Sumber Pendapatan') }}</label>
            <input type="text" name="sumber_pendapatan"
                class="form-control @error('sumber_pendapatan') is-invalid @enderror"
                value="{{ old('sumber_pendapatan', $pendapatanDesa?->sumber_pendapatan) }}" id="sumber_pendapatan"
                placeholder="Sumber Pendapatan">
            {!! $errors->first(
                'sumber_pendapatan',
                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>',
            ) !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="jumlah_pendapatan" class="form-label">{{ __('Jumlah Pendapatan') }}</label>
            <input type="number" name="jumlah_pendapatan"
                class="form-control @error('jumlah_pendapatan') is-invalid @enderror"
                value="{{ old('jumlah_pendapatan', $pendapatanDesa?->jumlah_pendapatan) }}" id="jumlah_pendapatan"
                placeholder="Jumlah Pendapatan">
            {!! $errors->first(
                'jumlah_pendapatan',
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
<!-- jQuery (required by Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#desa_id').select2({
            placeholder: "-- Pilih Desa --",
            allowClear: true
        });
    });
</script>
