 <!-- Modal for Show -->
 <div id="showModal{{ $disabilitasDesa->id }}" class="modal flip" tabindex="-1"
     aria-labelledby="showModalLabel{{ $disabilitasDesa->id }}" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="showModalLabel{{ $disabilitasDesa->id }}">
                     Detail Disabilitas Desa {{ $disabilitasDesa->desa->nama_desa }} -
                     {{ $disabilitasDesa->nama_disabilitasDesas }}
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Nama Desa</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->desa->nama_desa }}
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>RT/RW</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->rtRwDesa->rt }}/{{ $disabilitasDesa->rtRwDesa->rw }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Tahun</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->tahun }}
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Jenis Disabilitas</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->jenis_disabilitas }}
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Created By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->created_by }}
                     </div>
                 </div>



                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Status</strong>
                     </div>
                     <div class="col-sm-8">
                         @if ($disabilitasDesa->status == 'Arsip')
                             <span class="badge bg-primary">{{ $disabilitasDesa->status }}</span>
                         @elseif($disabilitasDesa->status == 'Pending')
                             <span class="badge bg-warning">{{ $disabilitasDesa->status }}</span>
                         @elseif ($disabilitasDesa->status == 'Approved')
                             <span class="badge bg-success">{{ $disabilitasDesa->status }}</span>
                         @elseif ($disabilitasDesa->status == 'Rejected')
                             <span class="badge bg-danger">{{ $disabilitasDesa->status }}</span>
                         @else
                             <span class="badge bg-secondary">{{ $disabilitasDesa->status }}</span>
                         @endif
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>created By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->created_by }}
                     </div>
                 </div>


                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Reject Reason</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->reject_reason ?? 'Tidak ada keterangan' }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Approved By</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->approved_by ?? 'Belum Di Approved' }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Approved At:</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $disabilitasDesa->approved_at ?? 'Belum Di Approved' }}
                     </div>
                 </div>
                 {{-- Form Approval untuk Admin Kabupaten --}}
                 @if (
                     (auth()->user()->hasRole('admin_kabupaten') || auth()->user()->hasRole('superadmin')) &&
                         $disabilitasDesa->status == 'Pending')
                     <hr>

                     <div class="card-body">
                         {{-- PERBAIKAN ROUTE: tukar posisi table dan id --}}
                         <form
                             action="{{ route('approval', ['table' => 'disabilitas_desas', 'id' => $disabilitasDesa->id]) }}"
                             method="POST" id="approvalForm{{ $disabilitasDesa->id }}">
                             @csrf
                             @method('PUT')
                             <div class="mb-3">
                                 <label for="approval_status{{ $disabilitasDesa->id }}" class="form-label">
                                     <strong>Status Approval <span class="text-danger">*</span></strong>
                                 </label>
                                 <select class="form-select" id="approval_status{{ $disabilitasDesa->id }}"
                                     name="status" required>
                                     <option value="">-- Pilih Status --</option>
                                     <option value="Approved">Approve</option>
                                     <option value="Rejected">Reject</option>
                                 </select>
                             </div>

                             <div class="mb-3" id="reject_reason_container{{ $disabilitasDesa->id }}"
                                 style="display: none;">
                                 <label for="reject_reason{{ $disabilitasDesa->id }}" class="form-label">
                                     <strong>Alasan Penolakan <span class="text-danger">*</span></strong>
                                 </label>
                                 <textarea class="form-control" id="reject_reason{{ $disabilitasDesa->id }}" name="reject_reason" rows="3"
                                     placeholder="Masukkan alasan penolakan..."></textarea>
                             </div>

                             <div class="d-grid gap-2">
                                 <button type="submit" class="btn btn-success"
                                     onclick="return confirmApproval{{ $disabilitasDesa->id }}()">
                                     <i class="fa fa-save"></i> Proses Approval
                                 </button>
                             </div>
                         </form>
                     </div>


                     <script>
                         document.getElementById('approval_status{{ $disabilitasDesa->id }}').addEventListener('change', function() {
                             const rejectContainer = document.getElementById('reject_reason_container{{ $disabilitasDesa->id }}');
                             const rejectTextarea = document.getElementById('reject_reason{{ $disabilitasDesa->id }}');

                             if (this.value === 'Rejected') {
                                 rejectContainer.style.display = 'block';
                                 rejectTextarea.required = true;
                             } else {
                                 rejectContainer.style.display = 'none';
                                 rejectTextarea.required = false;
                                 rejectTextarea.value = '';
                             }
                         });

                         function confirmApproval{{ $disabilitasDesa->id }}() {
                             const status = document.getElementById('approval_status{{ $disabilitasDesa->id }}').value;
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
