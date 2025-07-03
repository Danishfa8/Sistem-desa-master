@extends('layouts.app')

@section('template_title')
    {{ $pendidikanDesa->name ?? __('Show') . " " . __('Pendidikan Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pendidikan Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pendidikan-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $pendidikanDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $pendidikanDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tahun:</strong>
                                    {{ $pendidikanDesa->tahun }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Pendidikan:</strong>
                                    {{ $pendidikanDesa->jenis_pendidikan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status Pendidikan:</strong>
                                    {{ $pendidikanDesa->status_pendidikan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Foto:</strong>
                                    {{ $pendidikanDesa->foto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Latitude:</strong>
                                    {{ $pendidikanDesa->latitude }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Longitude:</strong>
                                    {{ $pendidikanDesa->longitude }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $pendidikanDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $pendidikanDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $pendidikanDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $pendidikanDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $pendidikanDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $pendidikanDesa->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
