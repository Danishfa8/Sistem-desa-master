@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                                    <p class="text-muted mb-0">Here's what's happening with your store today.
                                    </p>
                                </div>


                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end .rightbar-->

                </div> <!-- end col -->
            </div>

        </div>
        <!-- container-fluid -->
        @if (is_null(Auth::user()->email_verified_at))
            <!-- Trigger otomatis modal saat halaman dimuat -->
            <script>
                window.addEventListener('DOMContentLoaded', function() {
                    var verifyModal = new bootstrap.Modal(document.getElementById('firstmodal'));
                    verifyModal.show();
                });
            </script>
        @endif
        <!-- First modal dialog -->
        <div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px">
                        </lord-icon>
                        <div class="mt-4 pt-4">
                            <h4>Email Belum Diverifikasi</h4>
                            <p class="text-muted">Silakan verifikasi email Anda untuk melanjutkan menggunakan fitur
                                aplikasi.</p>
                            <button class="btn btn-warning" data-bs-target="#secondmodal" data-bs-toggle="modal"
                                data-bs-dismiss="modal">
                                Verifikasi Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second modal dialog -->
        <div class="modal fade" id="secondmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <lord-icon src="https://cdn.lordicon.com/zpxybbhl.json" trigger="loop"
                            colors="primary:#405189,secondary:#0ab39c" style="width:150px;height:150px">
                        </lord-icon>
                        <div class="mt-4 pt-3">
                            <h4 class="mb-3">Kirim Ulang Email Verifikasi</h4>
                            <p class="text-muted mb-4">Klik tombol di bawah untuk mengirim ulang email verifikasi ke alamat
                                Anda.</p>
                            <div class="hstack gap-2 justify-content-center">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Kirim Ulang</button>
                                </form>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
