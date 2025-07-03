<div id="showModal{{ $perangkatDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $perangkatDesa->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $perangkatDesa->id }}">
                    Detail Perangkat Desa {{ $perangkatDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Perangkat</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $perangkatDesa->nama }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Jabatan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $perangkatDesa->jabatan }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Foto</strong>
                    </div>
                    <div class="col-sm-8">
                        <img src="{{ asset($perangkatDesa->foto) }}" alt="Perangkat Desa"
                            style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Updated</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $perangkatDesa->updated_at }}
                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
