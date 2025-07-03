@extends('layouts.app')

@section('template_title')
    {{ $jalanDesa->name ?? __('Show') . " " . __('Jalan Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Jalan Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('jalan-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $jalanDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $jalanDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Jalan:</strong>
                                    {{ $jalanDesa->nama_jalan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Panjang:</strong>
                                    {{ $jalanDesa->panjang }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lebar:</strong>
                                    {{ $jalanDesa->lebar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Kondisi:</strong>
                                    {{ $jalanDesa->kondisi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Jalan:</strong>
                                    {{ $jalanDesa->jenis_jalan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lokasi:</strong>
                                    {{ $jalanDesa->lokasi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $jalanDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $jalanDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $jalanDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $jalanDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $jalanDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $jalanDesa->approved_at }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Latitude:</strong>
                                    {{ $jalanDesa->latitude }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Longitude:</strong>
                                    {{ $jalanDesa->longitude }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
