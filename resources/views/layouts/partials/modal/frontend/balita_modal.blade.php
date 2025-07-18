<div id="showModal{{ $balitaDesa->desa_id }}" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="showModalLabel{{ $balitaDesa->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            {{-- Modal Header --}}
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $balitaDesa->id }}">
                    Detail Data Balita - Desa {{ $balitaDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            {{-- Modal Body --}}
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Nama Desa:</strong> {{ $balitaDesa->desa->nama_desa }}
                </div>

                <div class="mb-3">
                    <strong>RT/RW:</strong> {{ $balitaDesa->rtRwDesa->rt }}/{{ $balitaDesa->rtRwDesa->rw }}
                </div>

                <div class="mb-3">
                    <strong>Jumlah Balita:</strong> {{ $balitaDesa->jumlah_balita }}
                </div>

                <div class="mb-3">
                    <strong>Tahun:</strong> {{ $balitaDesa->tahun }}
                </div>

                <div class="mb-3">
                    <strong>Status:</strong> 
                    @if ($balitaDesa->status == 'Approved')
                        <span class="badge bg-success">Disetujui</span>
                    @elseif ($balitaDesa->status == 'Pending')
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @elseif ($balitaDesa->status == 'Rejected')
                        <span class="badge bg-danger">Ditolak</span>
                        @if ($balitaDesa->reject_reason)
                            <div class="text-danger mt-1"><strong>Alasan:</strong> {{ $balitaDesa->reject_reason }}</div>
                        @endif
                    @else
                        <span class="badge bg-secondary">{{ $balitaDesa->status }}</span>
                    @endif
                </div>

                @if ($balitaDesa->approved_by)
                    <div class="mb-3">
                        <strong>Disetujui oleh:</strong> {{ $balitaDesa->approved_by }}<br>
                        <strong>Tanggal Persetujuan:</strong> {{ $balitaDesa->approved_at }}
                    </div>
                @endif
            </div>

            {{-- Modal Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
