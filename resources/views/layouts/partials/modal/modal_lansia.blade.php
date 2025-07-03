<div id="showModal{{ $lansiaDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $lansiaDesa->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $lansiaDesa->id }}">
                    Detail Lansia Desa {{ $lansiaDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Desa</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->desa->nama_desa }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->rtRwDesa->rt }}/{{ $lansiaDesa->rtRwDesa->rw }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Jenis Lansia</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->jenis_lansia }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-sm-8">
                        @if ($lansiaDesa->status == 'Arsip')
                            <span class="badge bg-primary">{{ $lansiaDesa->status }}</span>
                        @elseif($lansiaDesa->status == 'Pending')
                            <span class="badge bg-warning">{{ $lansiaDesa->status }}</span>
                        @elseif ($lansiaDesa->status == 'Approved')
                            <span class="badge bg-success">{{ $lansiaDesa->status }}</span>
                        @elseif ($lansiaDesa->status == 'Rejected')
                            <span class="badge bg-danger">{{ $lansiaDesa->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $lansiaDesa->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>created By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->created_by }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Reject Reason</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->reject_reason ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->approved_by ?? 'Belum Di Approved' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved At:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $lansiaDesa->approved_at ?? 'Belum Di Approved' }}
                    </div>
                </div>
                {{-- Form Approval untuk Admin Kabupaten --}}
                @if (
                    (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                        $lansiaDesa->status == 'Pending')
                    <hr>

                    <div class="card-body">
                        <form action="{{ route('approval', ['table' => 'lansia_desas', 'id' => $lansiaDesa->id]) }}"
                            method="POST" id="approvalForm{{ $lansiaDesa->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="approval_status{{ $lansiaDesa->id }}" class="form-label">
                                    <strong>Status Approval <span class="text-danger">*</span></strong>
                                </label>
                                <select class="form-select" id="approval_status{{ $lansiaDesa->id }}" name="status"
                                    required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>
                                </select>
                            </div>

                            <div class="mb-3" id="reject_reason_container{{ $lansiaDesa->id }}"
                                style="display: none;">
                                <label for="reject_reason{{ $lansiaDesa->id }}" class="form-label">
                                    <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                </label>
                                <textarea class="form-control" id="reject_reason{{ $lansiaDesa->id }}" name="reject_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirmApproval{{ $lansiaDesa->id }}()">
                                    <i class="fa fa-save"></i> Proses Approval
                                </button>
                            </div>
                        </form>
                    </div>


                    <script>
                        document.getElementById('approval_status{{ $lansiaDesa->id }}').addEventListener('change', function() {
                            const rejectContainer = document.getElementById('reject_reason_container{{ $lansiaDesa->id }}');
                            const rejectTextarea = document.getElementById('reject_reason{{ $lansiaDesa->id }}');

                            if (this.value === 'Rejected') {
                                rejectContainer.style.display = 'block';
                                rejectTextarea.required = true;
                            } else {
                                rejectContainer.style.display = 'none';
                                rejectTextarea.required = false;
                                rejectTextarea.value = '';
                            }
                        });

                        function confirmApproval{{ $lansiaDesa->id }}() {
                            const status = document.getElementById('approval_status{{ $lansiaDesa->id }}').value;
                            const message = status === 'Approved' ?
                                'Apakah Anda yakin ingin menyetujui data ini?' :
                                'Apakah Anda yakin ingin menolak data ini?';

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
