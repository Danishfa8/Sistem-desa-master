@extends('layouts.app')

@section('template_title')
    {{ $kondisiLingkunganKeluargaDesa->name ?? __('Show') . " " . __('Kondisi Lingkungan Keluarga Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Kondisi Lingkungan Keluarga Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('kondisi-lingkungan-keluarga-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tahun:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->tahun }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Kondisi:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->jenis_kondisi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $kondisiLingkunganKeluargaDesa->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
