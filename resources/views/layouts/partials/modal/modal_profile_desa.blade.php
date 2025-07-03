 <!-- Modal for Show -->
 <div id="showModal{{ $profileDesa->id }}" class="modal flip" tabindex="-1"
     aria-labelledby="showModalLabel{{ $profileDesa->id }}" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="showModalLabel{{ $profileDesa->id }}">
                     Detail Profile profileDesa {{ $profileDesa->desa->nama_desa }} </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Nama profileDesa</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->desa->nama_desa }}
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Visi</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->visi }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Misi</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->misi }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Program Unggulan</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->program_unggulan }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Batas Wilayah</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->batas_wilayah }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Alamat</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->alamat }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Telephone</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->telepon }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Foto</strong>
                     </div>
                     <div class="col-sm-8">
                         <img src="{{ asset($profileDesa->foto) }}" alt="Foto Desa"
                             style="height: 100px; width: 100px">
                     </div>
                 </div>


                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Updated</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $profileDesa->updated_at }}
                     </div>
                 </div>


                 {{-- Form Approval untuk Admin Kabupaten --}}
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
             </div>
         </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
