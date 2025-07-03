 <!-- Modal for Show -->
 <div id="showModal{{ $desa->id }}" class="modal flip" tabindex="-1"
     aria-labelledby="showModalLabel{{ $desa->id }}" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="showModalLabel{{ $desa->id }}">
                     Detail Disabilitas Desa {{ $desa->nama_desa }} Kec.
                     {{ $desa->kecamatan->nama_kecamatan }}
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Nama Desa</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $desa->nama_desa }}
                     </div>
                 </div>
                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>klas</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $desa->klas }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Stat Pem</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $desa->stat_pem }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Latitude</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $desa->latitude }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Longitude</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $desa->longitude }}
                     </div>
                 </div>

                 <div class="row mb-3">
                     <div class="col-sm-4">
                         <strong>Updated</strong>
                     </div>
                     <div class="col-sm-8">
                         {{ $desa->updated_at }}
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
