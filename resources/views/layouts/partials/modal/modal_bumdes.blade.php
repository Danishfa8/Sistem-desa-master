 <div id="showModal{{ $bumde->id }}" class="modal flip" tabindex="-1"
     aria-labelledby="showModalLabel{{ $bumde->id }}" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="showModalLabel{{ $bumde->id }}">
                     Detail Bumdes - {{ $bumde->nama_bumdes }}
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Nama Bumdes</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->nama_bumdes }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Desa</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->desa->nama_desa }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>RT/RW</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->rtRwDesa->rt }}/{{ $bumde->rtRwDesa->rw }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Deskripsi</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->deskripsi }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Status</strong>
                     </div>
                     <div class="col-sm-8">
                         @if ($bumde->status == 'Arsip')
                             <span class="badge bg-primary">{{ $bumde->status }}</span>
                         @elseif($bumde->status == 'Pending')
                             <span class="badge bg-warning">{{ $bumde->status }}</span>
                         @elseif ($bumde->status == 'Approved')
                             <span class="badge bg-success">{{ $bumde->status }}</span>
                         @elseif ($bumde->status == 'Rejected')
                             <span class="badge bg-danger">{{ $bumde->status }}</span>
                         @else
                             <span class="badge bg-secondary">{{ $bumde->status }}</span>
                         @endif
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>created By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->created_by }}
                     </div>
                 </div>


                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Reject Reason</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->reject_reason ?? 'Tidak ada keterangan' }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Approved By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->approved_by ?? 'Belum Di Approved' }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Approved At:</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $bumde->approved_at ?? 'Belum Di Approved' }}
                     </div>
                 </div>
                 {{-- Form Approval untuk Admin Kabupaten --}}
                 @if (
                     (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                         $bumde->status == 'Pending')
                     <hr>

                     <div class="card-body">
                         {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                         <form action="{{ route('approval', ['table' => 'bumdes', 'id' => $bumde->id]) }}"
                             method="POST" id="approvalForm{{ $bumde->id }}">
                             @csrf
                             @method('PUT')
                             <div class="mb-3">
                                 <label for="approval_status{{ $bumde->id }}" class="form-label">
                                     <strong>Status Approval <span class="text-danger">*</span></strong>
                                 </label>
                                 <select class="form-select" id="approval_status{{ $bumde->id }}" name="status"
                                     required>
                                     <option value="">-- Pilih Status --</option>
                                     <option value="Approved">Approve</option>
                                     <option value="Rejected">Reject</option>
                                 </select>
                             </div>

                             <div class="mb-3" id="reject_reason_container{{ $bumde->id }}"
                                 style="display: none;">
                                 <label for="reject_reason{{ $bumde->id }}" class="form-label">
                                     <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                 </label>
                                 <textarea class="form-control" id="reject_reason{{ $bumde->id }}" name="reject_reason" rows="3"
                                     placeholder="Masukkan alasan penolakan..."></textarea>
                             </div>

                             <div class="d-grid gap-2">
                                 <button type="submit" class="btn btn-success"
                                     onclick="return confirmApproval{{ $bumde->id }}()">
                                     <i class="fa fa-save"></i> Proses Approval
                                 </button>
                             </div>
                         </form>
                     </div>


                     <script>
                         document.getElementById('approval_status{{ $bumde->id }}').addEventListener('change', function() {
                             const rejectContainer = document.getElementById('reject_reason_container{{ $bumde->id }}');
                             const rejectTextarea = document.getElementById('reject_reason{{ $bumde->id }}');

                             if (this.value === 'Rejected') {
                                 rejectContainer.style.display = 'block';
                                 rejectTextarea.required = true;
                             } else {
                                 rejectContainer.style.display = 'none';
                                 rejectTextarea.required = false;
                                 rejectTextarea.value = '';
                             }
                         });

                         function confirmApproval{{ $bumde->id }}() {
                             const status = document.getElementById('approval_status{{ $bumde->id }}').value;
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
