<div id="showModal{{ $jembatanDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $jembatanDesa->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $jembatanDesa->id }}">
                    Detail Jembatan Desa {{ $jembatanDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Desa</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->desa->nama_desa }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->rtRwDesa->rt }}/{{ $jembatanDesa->rtRwDesa->rw }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Jembatan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->nama_jembatan }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Panjang Jembatan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->panjang }} Meter
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Lebar Jembatan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->lebar }} Meter
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Kondisi Jembatan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->kondisi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Lokasi Jembatan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->lokasi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-sm-8">
                        @if ($jembatanDesa->status == 'Arsip')
                            <span class="badge bg-primary">{{ $jembatanDesa->status }}</span>
                        @elseif($jembatanDesa->status == 'Pending')
                            <span class="badge bg-warning">{{ $jembatanDesa->status }}</span>
                        @elseif ($jembatanDesa->status == 'Approved')
                            <span class="badge bg-success">{{ $jembatanDesa->status }}</span>
                        @elseif ($jembatanDesa->status == 'Rejected')
                            <span class="badge bg-danger">{{ $jembatanDesa->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $jembatanDesa->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>created By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->created_by }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Reject Reason</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->reject_reason ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->approved_by ?? 'Belum Di Approved' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved At:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->approved_at ?? 'Belum Di Approved' }}
                    </div>
                </div>
                {{-- Form Approval untuk Admin Kabupaten --}}
                @if (
                    (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                        $jembatanDesa->status == 'Pending')
                    <hr>

                    <div class="card-body">
                        {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                        <form
                            action="{{ route('approval', ['table' => 'jembatan_desas', 'id' => $jembatanDesa->id]) }}"
                            method="POST" id="approvalForm{{ $jembatanDesa->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="approval_status{{ $jembatanDesa->id }}" class="form-label">
                                    <strong>Status Approval <span class="text-danger">*</span></strong>
                                </label>
                                <select class="form-select" id="approval_status{{ $jembatanDesa->id }}" name="status"
                                    required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>
                                </select>
                            </div>

                            <div class="mb-3" id="reject_reason_container{{ $jembatanDesa->id }}"
                                style="display: none;">
                                <label for="reject_reason{{ $jembatanDesa->id }}" class="form-label">
                                    <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                </label>
                                <textarea class="form-control" id="reject_reason{{ $jembatanDesa->id }}" name="reject_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirmApproval{{ $jembatanDesa->id }}()">
                                    <i class="fa fa-save"></i> Proses Approval
                                </button>
                            </div>
                        </form>
                    </div>


                    <script>
                        document.getElementById('approval_status{{ $jembatanDesa->id }}').addEventListener('change', function() {
                            const rejectContainer = document.getElementById('reject_reason_container{{ $jembatanDesa->id }}');
                            const rejectTextarea = document.getElementById('reject_reason{{ $jembatanDesa->id }}');

                            if (this.value === 'Rejected') {
                                rejectContainer.style.display = 'block';
                                rejectTextarea.required = true;
                            } else {
                                rejectContainer.style.display = 'none';
                                rejectTextarea.required = false;
                                rejectTextarea.value = '';
                            }
                        });

                        function confirmApproval{{ $jembatanDesa->id }}() {
                            const status = document.getElementById('approval_status{{ $jembatanDesa->id }}').value;
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
