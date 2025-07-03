@extends('layouts.app')

@section('template_title')
    {{ $pkkDesa->name ?? __('Show') . " " . __('Pkk Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pkk Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pkk-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $pkkDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $pkkDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Pengurus:</strong>
                                    {{ $pkkDesa->jumlah_pengurus }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Anggota:</strong>
                                    {{ $pkkDesa->jumlah_anggota }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Kegiatan:</strong>
                                    {{ $pkkDesa->jumlah_kegiatan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Buku Administrasi:</strong>
                                    {{ $pkkDesa->jumlah_buku_administrasi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Dana:</strong>
                                    {{ $pkkDesa->jumlah_dana }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $pkkDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $pkkDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $pkkDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $pkkDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $pkkDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $pkkDesa->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
