@extends('layouts.app')

@section('template_title')
    {{ $jembatanDesa->name ?? __('Show') . " " . __('Jembatan Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Jembatan Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('jembatan-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $jembatanDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $jembatanDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Jembatan:</strong>
                                    {{ $jembatanDesa->nama_jembatan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Panjang:</strong>
                                    {{ $jembatanDesa->panjang }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lebar:</strong>
                                    {{ $jembatanDesa->lebar }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Kondisi:</strong>
                                    {{ $jembatanDesa->kondisi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lokasi:</strong>
                                    {{ $jembatanDesa->lokasi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $jembatanDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $jembatanDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $jembatanDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $jembatanDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $jembatanDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $jembatanDesa->approved_at }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Latitude:</strong>
                                    {{ $jembatanDesa->latitude }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Longitude:</strong>
                                    {{ $jembatanDesa->longitude }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
