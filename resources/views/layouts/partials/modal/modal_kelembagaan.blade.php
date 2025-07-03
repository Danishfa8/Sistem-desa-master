<div id="showModal{{ $kelembagaanDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $kelembagaanDesa->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $kelembagaanDesa->id }}">
                    Detail Kelembagaan Desa {{ $kelembagaanDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Desa</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->desa->nama_desa }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->rtRwDesa->rt }}/{{ $kelembagaanDesa->rtRwDesa->rw }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Tahun</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->tahun }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Jenis Kelembagaan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->jenis_kelembagaan }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Kelembagaan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->nama_kelembagaan }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-sm-8">
                        @if ($kelembagaanDesa->status == 'Arsip')
                            <span class="badge bg-primary">{{ $kelembagaanDesa->status }}</span>
                        @elseif($kelembagaanDesa->status == 'Pending')
                            <span class="badge bg-warning">{{ $kelembagaanDesa->status }}</span>
                        @elseif ($kelembagaanDesa->status == 'Approved')
                            <span class="badge bg-success">{{ $kelembagaanDesa->status }}</span>
                        @elseif ($kelembagaanDesa->status == 'Rejected')
                            <span class="badge bg-danger">{{ $kelembagaanDesa->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $kelembagaanDesa->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>created By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->created_by }}
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Reject Reason</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->reject_reason ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->approved_by ?? 'Belum Di Approved' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved At:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kelembagaanDesa->approved_at ?? 'Belum Di Approved' }}
                    </div>
                </div>

                {{-- Form Approval untuk Admin Kabupaten --}}
                @if (
                    (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                        $kelembagaanDesa->status == 'Pending')
                    <hr>

                    <div class="card-body">
                        {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                        <form
                            action="{{ route('approval', ['table' => 'kelembagaan_desas', 'id' => $kelembagaanDesa->id]) }}"
                            method="POST" id="approvalForm{{ $kelembagaanDesa->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="approval_status{{ $kelembagaanDesa->id }}" class="form-label">
                                    <strong>Status Approval <span class="text-danger">*</span></strong>
                                </label>
                                <select class="form-select" id="approval_status{{ $kelembagaanDesa->id }}"
                                    name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>
                                </select>
                            </div>

                            <div class="mb-3" id="reject_reason_container{{ $kelembagaanDesa->id }}"
                                style="display: none;">
                                <label for="reject_reason{{ $kelembagaanDesa->id }}" class="form-label">
                                    <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                </label>
                                <textarea class="form-control" id="reject_reason{{ $kelembagaanDesa->id }}" name="reject_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirmApproval{{ $kelembagaanDesa->id }}()">
                                    <i class="fa fa-save"></i> Proses Approval
                                </button>
                            </div>
                        </form>
                    </div>


                    <script>
                        document.getElementById('approval_status{{ $kelembagaanDesa->id }}').addEventListener('change', function() {
                            const rejectContainer = document.getElementById('reject_reason_container{{ $kelembagaanDesa->id }}');
                            const rejectTextarea = document.getElementById('reject_reason{{ $kelembagaanDesa->id }}');

                            if (this.value === 'Rejected') {
                                rejectContainer.style.display = 'block';
                                rejectTextarea.required = true;
                            } else {
                                rejectContainer.style.display = 'none';
                                rejectTextarea.required = false;
                                rejectTextarea.value = '';
                            }
                        });

                        function confirmApproval{{ $kelembagaanDesa->id }}() {
                            const status = document.getElementById('approval_status{{ $kelembagaanDesa->id }}').value;
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
