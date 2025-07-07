@props([
    'item',
    'routePrefix',
    'tableName',
    'showRoute' => true, // default true agar tidak undefined
])

<div class="btn-group" role="group">
    {{-- Tombol Show --}}
    @if ($showRoute)
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
            data-bs-target="#showModal{{ $item->id }}">
            <i class="las la-eye"></i> Show
        </button>
    @endif

    {{-- Tombol Edit jika ingin diaktifkan kembali --}}
    {{-- 
    @if ($item->status === 'Pending')
        <a class="btn btn-sm btn-warning" href="{{ route("$routePrefix.edit", $item->id) }}">Edit</a>
    @endif 
    --}}

    @if ($item->status === 'Pending')
        {{-- Tombol Approve (buka modal) --}}
        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
            data-bs-target="#modal-approve-{{ $item->id }}">
            Approve
        </button>

        {{-- Tombol Reject (buka modal) --}}
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
            data-bs-target="#modal-reject-{{ $item->id }}">
            Reject
        </button>
    @endif
</div>

{{-- Modal Approve --}}
{{-- Modal Approve (Modern) --}}
<div class="modal fade" id="modal-approve-{{ $item->id }}" tabindex="-1" aria-labelledby="modalApproveLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin_kabupaten.approve', ['table' => $tableName, 'id' => $item->id]) }}">
            @csrf
            <input type="hidden" name="status" value="Approved">
            <div class="modal-content shadow-lg border-0 rounded-4">
                <div class="modal-header bg-gradient text-white rounded-top-4" style="background: linear-gradient(135deg, #28a745, #218838);">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalApproveLabel{{ $item->id }}">
                        <i class="bi bi-check-circle-fill fs-4"></i>
                        Konfirmasi Persetujuan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="fs-5 mb-0">
                        Anda yakin ingin <span class="text-success fw-bold">menyetujui</span> data ini?
                    </p>
                </div>
                <div class="modal-footer bg-light rounded-bottom-4 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-lg me-1"></i> Ya, Setujui
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- Modal Reject --}}
<div class="modal fade" id="modal-reject-{{ $item->id }}" tabindex="-1" aria-labelledby="modalRejectLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin_kabupaten.approve', ['table' => $tableName, 'id' => $item->id]) }}">
            @csrf
            <input type="hidden" name="status" value="Rejected">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalRejectLabel{{ $item->id }}">Alasan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea name="reject_reason" class="form-control" placeholder="Masukkan alasan penolakan" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </form>
    </div>
</div>
