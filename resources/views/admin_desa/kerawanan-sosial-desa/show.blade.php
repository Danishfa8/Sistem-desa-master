@extends('layouts.app')

@section('template_title')
    {{ $kerawananSosialDesa->name ?? __('Show') . " " . __('Kerawanan Sosial Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Kerawanan Sosial Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('kerawanan-sosial-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $kerawananSosialDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $kerawananSosialDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tahun:</strong>
                                    {{ $kerawananSosialDesa->tahun }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Kerawanan:</strong>
                                    {{ $kerawananSosialDesa->jenis_kerawanan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $kerawananSosialDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $kerawananSosialDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $kerawananSosialDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $kerawananSosialDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $kerawananSosialDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $kerawananSosialDesa->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
