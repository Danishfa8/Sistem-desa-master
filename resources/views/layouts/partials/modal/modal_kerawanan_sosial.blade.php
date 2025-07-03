<div id="showModal{{ $kerawananSosialDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $kerawananSosialDesa->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $kerawananSosialDesa->id }}">
                    Detail Lansia Desa {{ $kerawananSosialDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Desa</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kerawananSosialDesa->desa->nama_desa }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kerawananSosialDesa->rtRwDesa->rt }}/{{ $kerawananSosialDesa->rtRwDesa->rw }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $kerawananSosialDesa->tahun }}
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Jenis Kerawanan</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $kerawananSosialDesa->jenis_kerawanan }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Status</strong>
                        </div>
                        <div class="col-sm-8">
                            @if ($kerawananSosialDesa->status == 'Arsip')
                                <span class="badge bg-primary">{{ $kerawananSosialDesa->status }}</span>
                            @elseif($kerawananSosialDesa->status == 'Pending')
                                <span class="badge bg-warning">{{ $kerawananSosialDesa->status }}</span>
                            @elseif ($kerawananSosialDesa->status == 'Approved')
                                <span class="badge bg-success">{{ $kerawananSosialDesa->status }}</span>
                            @elseif ($kerawananSosialDesa->status == 'Rejected')
                                <span class="badge bg-danger">{{ $kerawananSosialDesa->status }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $kerawananSosialDesa->status }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>created By</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $kerawananSosialDesa->created_by }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Reject Reason</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $kerawananSosialDesa->reject_reason ?? 'Tidak ada keterangan' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Approved By</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $kerawananSosialDesa->approved_by ?? 'Belum Di Approved' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Approved At:</strong>
                        </div>
                        <div class="col-sm-8">
                            {{ $kerawananSosialDesa->approved_at ?? 'Belum Di Approved' }}
                        </div>
                    </div>
                    {{-- Form Approval untuk Admin Kabupaten --}}
                    @if (
                        (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                            $kerawananSosialDesa->status == 'Pending')
                        <hr>

                        <div class="card-body">
                            <form
                                action="{{ route('approval', ['table' => 'kerawanan_sosial_desas', 'id' => $kerawananSosialDesa->id]) }}"
                                method="POST" id="approvalForm{{ $kerawananSosialDesa->id }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="approval_status{{ $kerawananSosialDesa->id }}" class="form-label">
                                        <strong>Status Approval <span class="text-danger">*</span></strong>
                                    </label>
                                    <select class="form-select" id="approval_status{{ $kerawananSosialDesa->id }}"
                                        name="status" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Approved">Approve</option>
                                        <option value="Rejected">Reject</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="reject_reason_container{{ $kerawananSosialDesa->id }}"
                                    style="display: none;">
                                    <label for="reject_reason{{ $kerawananSosialDesa->id }}" class="form-label">
                                        <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                    </label>
                                    <textarea class="form-control" id="reject_reason{{ $kerawananSosialDesa->id }}" name="reject_reason" rows="3"
                                        placeholder="Masukkan alasan penolakan..."></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirmApproval{{ $kerawananSosialDesa->id }}()">
                                        <i class="fa fa-save"></i> Proses Approval
                                    </button>
                                </div>
                            </form>
                        </div>


                        <script>
                            document.getElementById('approval_status{{ $kerawananSosialDesa->id }}').addEventListener('change', function() {
                                const rejectContainer = document.getElementById(
                                    'reject_reason_container{{ $kerawananSosialDesa->id }}');
                                const rejectTextarea = document.getElementById('reject_reason{{ $kerawananSosialDesa->id }}');

                                if (this.value === 'Rejected') {
                                    rejectContainer.style.display = 'block';
                                    rejectTextarea.required = true;
                                } else {
                                    rejectContainer.style.display = 'none';
                                    rejectTextarea.required = false;
                                    rejectTextarea.value = '';
                                }
                            });

                            function confirmApproval{{ $kerawananSosialDesa->id }}() {
                                const status = document.getElementById('approval_status{{ $kerawananSosialDesa->id }}').value;
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
