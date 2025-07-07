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
                {{-- ✅ FOTO di Tengah --}}
                @if ($jembatanDesa->foto)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/foto_jembatan/' . $jembatanDesa->foto) }}"
                            alt="Foto Jembatan"
                            style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                    </div>
                @endif

                {{-- ✅ Detail --}}
                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Nama Desa</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->desa->nama_desa }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>RT/RW</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->rtRwDesa->rt }}/{{ $jembatanDesa->rtRwDesa->rw }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Nama Jembatan</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->nama_jembatan }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Panjang Jembatan</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->panjang }} Meter</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Lebar Jembatan</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->lebar }} Meter</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Kondisi</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->kondisi }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Lokasi</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->lokasi }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Status</strong></div>
                    <div class="col-sm-8">
                        <span class="badge
                            @if ($jembatanDesa->status === 'Approved') bg-success
                            @elseif ($jembatanDesa->status === 'Pending') bg-warning text-dark
                            @elseif ($jembatanDesa->status === 'Rejected') bg-danger
                            @else bg-secondary @endif">
                            {{ $jembatanDesa->status }}
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Created By</strong></div>
                    <div class="col-sm-8">{{ $jembatanDesa->created_by }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Reject Reason</strong></div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->reject_reason ?? 'Tidak ada keterangan' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Approved By</strong></div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->approved_by ?? 'Belum Di Approved' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4"><strong>Approved At</strong></div>
                    <div class="col-sm-8">
                        {{ $jembatanDesa->approved_at ?? 'Belum Di Approved' }}
                    </div>
                </div>

                {{-- Approval Form untuk Admin Kabupaten/Superadmin --}}
                @if ((auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) && $jembatanDesa->status === 'Pending')
                    <hr>
                    <form action="{{ route('approval', ['table' => 'jembatan_desas', 'id' => $jembatanDesa->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="approval_status{{ $jembatanDesa->id }}" class="form-label">
                                <strong>Status Approval</strong>
                            </label>
                            <select class="form-select" id="approval_status{{ $jembatanDesa->id }}" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Approved">Approve</option>
                                <option value="Rejected">Reject</option>
                            </select>
                        </div>

                        <div class="mb-3" id="reject_reason_container{{ $jembatanDesa->id }}" style="display: none;">
                            <label for="reject_reason{{ $jembatanDesa->id }}" class="form-label">
                                <strong>Alasan Penolakan</strong>
                            </label>
                            <textarea class="form-control" id="reject_reason{{ $jembatanDesa->id }}" name="reject_reason"
                                rows="3" placeholder="Masukkan alasan penolakan..."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"
                                onclick="return confirmApproval{{ $jembatanDesa->id }}()">
                                <i class="fa fa-check-circle"></i> Proses Approval
                            </button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('approval_status{{ $jembatanDesa->id }}').addEventListener('change', function () {
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
                            const message = status === 'Approved'
                                ? 'Apakah Anda yakin ingin menyetujui data ini?'
                                : 'Apakah Anda yakin ingin menolak data ini?';
                            return confirm(message);
                        }
                    </script>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
