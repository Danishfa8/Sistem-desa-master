 <!-- Modal for Show -->
 <div id="showModal{{ $items->id }}" class="modal flip" tabindex="-1"
     aria-labelledby="showModalLabel{{ $items->id }}" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="showModalLabel{{ $items->id }}">
                     Detail Disabilitas Desa {{ $items->desa->nama_desa }} -
                     {{ $items->nama_items }}
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Nama Desa</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->desa->nama_desa }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Tahun</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->tahun }}
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Jenis Transportasi </strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->jenis_transportasi }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Status</strong>
                     </div>
                     <div class="col-sm-8">
                         @if ($items->status == 'Arsip')
                             <span class="badge bg-primary">{{ $items->status }}</span>
                         @elseif($items->status == 'Pending')
                             <span class="badge bg-warning">{{ $items->status }}</span>
                         @elseif ($items->status == 'Approved')
                             <span class="badge bg-success">{{ $items->status }}</span>
                         @elseif ($items->status == 'Rejected')
                             <span class="badge bg-danger">{{ $items->status }}</span>
                         @else
                             <span class="badge bg-secondary">{{ $items->status }}</span>
                         @endif
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>created By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->created_by }}
                     </div>
                 </div>


                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Reject Reason</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->reject_reason ?? 'Tidak ada keterangan' }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Approved By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->approved_by ?? 'Belum Di Approved' }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Approved At:</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $items->approved_at ?? 'Belum Di Approved' }}
                     </div>
                 </div>
                 {{-- Form Approval untuk Admin Kabupaten --}}
                 @if (
                     (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                         $items->status == 'Pending')
                     <hr>

                     <div class="card-body">
                         {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                         <form action="{{ route('approval', ['table' => 'items', 'id' => $items->id]) }}"
                             method="POST" id="approvalForm{{ $items->id }}">
                             @csrf
                             @method('PUT')
                             <div class="mb-3">
                                 <label for="approval_status{{ $items->id }}" class="form-label">
                                     <strong>Status Approval <span class="text-danger">*</span></strong>
                                 </label>
                                 <select class="form-select" id="approval_status{{ $items->id }}" name="status"
                                     required>
                                     <option value="">-- Pilih Status --</option>
                                     <option value="Approved">Approve</option>
                                     <option value="Rejected">Reject</option>
                                 </select>
                             </div>

                             <div class="mb-3" id="reject_reason_container{{ $items->id }}"
                                 style="display: none;">
                                 <label for="reject_reason{{ $items->id }}" class="form-label">
                                     <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                 </label>
                                 <textarea class="form-control" id="reject_reason{{ $items->id }}" name="reject_reason" rows="3"
                                     placeholder="Masukkan alasan penolakan..."></textarea>
                             </div>

                             <div class="d-grid gap-2">
                                 <button type="submit" class="btn btn-success"
                                     onclick="return confirmApproval{{ $items->id }}()">
                                     <i class="fa fa-save"></i> Proses Approval
                                 </button>
                             </div>
                         </form>
                     </div>


                     <script>
                         document.getElementById('approval_status{{ $items->id }}').addEventListener('change', function() {
                             const rejectContainer = document.getElementById('reject_reason_container{{ $items->id }}');
                             const rejectTextarea = document.getElementById('reject_reason{{ $items->id }}');

                             if (this.value === 'Rejected') {
                                 rejectContainer.style.display = 'block';
                                 rejectTextarea.required = true;
                             } else {
                                 rejectContainer.style.display = 'none';
                                 rejectTextarea.required = false;
                                 rejectTextarea.value = '';
                             }
                         });

                         function confirmApproval{{ $items->id }}() {
                             const status = document.getElementById('approval_status{{ $items->id }}').value;
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
