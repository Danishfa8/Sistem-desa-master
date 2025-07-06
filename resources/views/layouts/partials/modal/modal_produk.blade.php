@foreach ($produk as $item)
<!-- Modal for Show -->
<div id="showModal{{ $item->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $item->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $item->id }}">
                    Detail Disabilitas Desa {{ $item->desa->nama_desa }} -
                    {{ $item->nama_produk }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Nama Desa</strong></div>
                    <div class="col-sm-8">{{ $item->desa->nama_desa }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Tahun</strong></div>
                    <div class="col-sm-8">{{ $item->tahun }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Jenis Produk</strong></div>
                    <div class="col-sm-8">{{ $item->jenis_produk }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Nama Produk</strong></div>
                    <div class="col-sm-8">{{ $item->nama_produk }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Status</strong></div>
                    <div class="col-sm-8">
                        @if ($item->status == 'Arsip')
                            <span class="badge bg-primary">{{ $item->status }}</span>
                        @elseif ($item->status == 'Pending')
                            <span class="badge bg-warning">{{ $item->status }}</span>
                        @elseif ($item->status == 'Approved')
                            <span class="badge bg-success">{{ $item->status }}</span>
                        @elseif ($item->status == 'Rejected')
                            <span class="badge bg-danger">{{ $item->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $item->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Created By</strong></div>
                    <div class="col-sm-8">{{ $item->created_by }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Reject Reason</strong></div>
                    <div class="col-sm-8">{{ $item->reject_reason ?? 'Tidak ada keterangan' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Approved By</strong></div>
                    <div class="col-sm-8">{{ $item->approved_by ?? 'Belum Di Approved' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Approved At:</strong></div>
                    <div class="col-sm-8">{{ $item->approved_at ?? 'Belum Di Approved' }}</div>
                </div>

                {{-- Form Approval untuk Admin Kabupaten --}}
                @if (
                    (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                    $item->status == 'Pending')
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('approval', ['table' => 'produk', 'id' => $item->id]) }}"
                            method="POST" id="approvalForm{{ $item->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="approval_status{{ $item->id }}" class="form-label">
                                    <strong>Status Approval <span class="text-danger">*</span></strong>
                                </label>
                                <select class="form-select" id="approval_status{{ $item->id }}" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>
                                </select>
                            </div>

                            <div class="mb-3" id="reject_reason_container{{ $item->id }}" style="display: none;">
                                <label for="reject_reason{{ $item->id }}" class="form-label">
                                    <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                </label>
                                <textarea class="form-control" id="reject_reason{{ $item->id }}" name="reject_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirmApproval{{ $item->id }}()">
                                    <i class="fa fa-save"></i> Proses Approval
                                </button>
                            </div>
                        </form>
                    </div>

                    <script>
                        document.getElementById('approval_status{{ $item->id }}').addEventListener('change', function() {
                            const rejectContainer = document.getElementById('reject_reason_container{{ $item->id }}');
                            const rejectTextarea = document.getElementById('reject_reason{{ $item->id }}');

                            if (this.value === 'Rejected') {
                                rejectContainer.style.display = 'block';
                                rejectTextarea.required = true;
                            } else {
                                rejectContainer.style.display = 'none';
                                rejectTextarea.required = false;
                                rejectTextarea.value = '';
                            }
                        });

                        function confirmApproval{{ $item->id }}() {
                            const status = document.getElementById('approval_status{{ $item->id }}').value;
                            const message = status === 'Approved'
                                ? 'Apakah Anda yakin ingin menyetujui data ini?'
                                : 'Apakah Anda yakin ingin menolak data ini?';
                            return confirm(message);
                        }
                    </script>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach
