<div id="showModal{{ $sumberDayaAlamDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $sumberDayaAlamDesa->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $sumberDayaAlamDesa->id }}">
                    Detail Sumber Daya Alam Desa {{ $sumberDayaAlamDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Desa</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->desa->nama_desa }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->rtRwDesa->rt }}/{{ $sumberDayaAlamDesa->rtRwDesa->rw }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Tahun</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->tahun }}
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Jenis SDA</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->jenis_sumber_daya_alam }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-sm-8">
                        @if ($sumberDayaAlamDesa->status == 'Arsip')
                            <span class="badge bg-primary">{{ $sumberDayaAlamDesa->status }}</span>
                        @elseif($sumberDayaAlamDesa->status == 'Pending')
                            <span class="badge bg-warning">{{ $sumberDayaAlamDesa->status }}</span>
                        @elseif ($sumberDayaAlamDesa->status == 'Approved')
                            <span class="badge bg-success">{{ $sumberDayaAlamDesa->status }}</span>
                        @elseif ($sumberDayaAlamDesa->status == 'Rejected')
                            <span class="badge bg-danger">{{ $sumberDayaAlamDesa->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $sumberDayaAlamDesa->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>created By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->created_by }}
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Reject Reason</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->reject_reason ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->approved_by ?? 'Belum Di Approved' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved At:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $sumberDayaAlamDesa->approved_at ?? 'Belum Di Approved' }}
                    </div>
                </div>
                {{-- Form Approval untuk Admin Kabupaten --}}
                @if (
                    (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                        $sumberDayaAlamDesa->status == 'Pending')
                    <hr>

                    <div class="card-body">
                        {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                        <form
                            action="{{ route('approval', ['table' => 'sumber_daya_alam_desas', 'id' => $sumberDayaAlamDesa->id]) }}"
                            method="POST" id="approvalForm{{ $sumberDayaAlamDesa->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="approval_status{{ $sumberDayaAlamDesa->id }}" class="form-label">
                                    <strong>Status Approval <span class="text-danger">*</span></strong>
                                </label>
                                <select class="form-select" id="approval_status{{ $sumberDayaAlamDesa->id }}"
                                    name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>
                                </select>
                            </div>

                            <div class="mb-3" id="reject_reason_container{{ $sumberDayaAlamDesa->id }}"
                                style="display: none;">
                                <label for="reject_reason{{ $sumberDayaAlamDesa->id }}" class="form-label">
                                    <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                </label>
                                <textarea class="form-control" id="reject_reason{{ $sumberDayaAlamDesa->id }}" name="reject_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirmApproval{{ $sumberDayaAlamDesa->id }}()">
                                    <i class="fa fa-save"></i> Proses Approval
                                </button>
                            </div>
                        </form>
                    </div>


                    <script>
                        document.getElementById('approval_status{{ $sumberDayaAlamDesa->id }}').addEventListener('change', function() {
                            const rejectContainer = document.getElementById(
                                'reject_reason_container{{ $sumberDayaAlamDesa->id }}');
                            const rejectTextarea = document.getElementById('reject_reason{{ $sumberDayaAlamDesa->id }}');

                            if (this.value === 'Rejected') {
                                rejectContainer.style.display = 'block';
                                rejectTextarea.required = true;
                            } else {
                                rejectContainer.style.display = 'none';
                                rejectTextarea.required = false;
                                rejectTextarea.value = '';
                            }
                        });

                        function confirmApproval{{ $sumberDayaAlamDesa->id }}() {
                            const status = document.getElementById('approval_status{{ $sumberDayaAlamDesa->id }}').value;
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
