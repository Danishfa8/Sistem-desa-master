<div id="showModal{{ $jalanDesa->id }}" class="modal flip" tabindex="-1"
    aria-labelledby="showModalLabel{{ $jalanDesa->id }}" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $jalanDesa->id }}">
                    Detail Jembatan Desa {{ $jalanDesa->desa->nama_desa }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Desa</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->desa->nama_desa }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>RT/RW</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->rtRwDesa->rt }}/{{ $jalanDesa->rtRwDesa->rw }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Nama Jalan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->nama_jalan }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Panjang Jalan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->panjang }} Meter
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Lebar Jalan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->lebar }} Meter
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Kondisi Jalan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->kondisi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Jenis Jalan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->jenis_jalan }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Lokasi Jalan</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->lokasi }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Status</strong>
                    </div>
                    <div class="col-sm-8">
                        @if ($jalanDesa->status == 'Arsip')
                            <span class="badge bg-primary">{{ $jalanDesa->status }}</span>
                        @elseif($jalanDesa->status == 'Pending')
                            <span class="badge bg-warning">{{ $jalanDesa->status }}</span>
                        @elseif ($jalanDesa->status == 'Approved')
                            <span class="badge bg-success">{{ $jalanDesa->status }}</span>
                        @elseif ($jalanDesa->status == 'Rejected')
                            <span class="badge bg-danger">{{ $jalanDesa->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $jalanDesa->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>created By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->created_by }}
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Reject Reason</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->reject_reason ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved By</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->approved_by ?? 'Belum Di Approved' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Approved At:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $jalanDesa->approved_at ?? 'Belum Di Approved' }}
                    </div>
                </div>
                {{-- Form Approval untuk Admin Kabupaten --}}
                @if (
                    (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                        $jalanDesa->status == 'Pending')
                    <hr>

                    <div class="card-body">
                        {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                        <form action="{{ route('approval', ['table' => 'jalan_desas', 'id' => $jalanDesa->id]) }}"
                            method="POST" id="approvalForm{{ $jalanDesa->id }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="approval_status{{ $jalanDesa->id }}" class="form-label">
                                    <strong>Status Approval <span class="text-danger">*</span></strong>
                                </label>
                                <select class="form-select" id="approval_status{{ $jalanDesa->id }}" name="status"
                                    required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>
                                </select>
                            </div>

                            <div class="mb-3" id="reject_reason_container{{ $jalanDesa->id }}"
                                style="display: none;">
                                <label for="reject_reason{{ $jalanDesa->id }}" class="form-label">
                                    <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                </label>
                                <textarea class="form-control" id="reject_reason{{ $jalanDesa->id }}" name="reject_reason" rows="3"
                                    placeholder="Masukkan alasan penolakan..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirmApproval{{ $jalanDesa->id }}()">
                                    <i class="fa fa-save"></i> Proses Approval
                                </button>
                            </div>
                        </form>
                    </div>


                    <script>
                        document.getElementById('approval_status{{ $jalanDesa->id }}').addEventListener('change', function() {
                            const rejectContainer = document.getElementById('reject_reason_container{{ $jalanDesa->id }}');
                            const rejectTextarea = document.getElementById('reject_reason{{ $jalanDesa->id }}');

                            if (this.value === 'Rejected') {
                                rejectContainer.style.display = 'block';
                                rejectTextarea.required = true;
                            } else {
                                rejectContainer.style.display = 'none';
                                rejectTextarea.required = false;
                                rejectTextarea.value = '';
                            }
                        });

                        function confirmApproval {
                            {
                                $jalanDesa - > id
                            }
                        }() {
                            const status = document.getElementById('approval_status{{ $jalanDesa->id }}').value;
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
