@extends('layouts.app')

@section('template_title')
    {{ $budayas->nama_kebudayaan ?? __('Show') . " " . __('Kebudayaan') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Kebudayaan</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('budaya.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $budayas->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tahun:</strong>
                                    {{ $budayas->tahun }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Kebudayaan:</strong>
                                    {{ $budayas->jenis_kebudayaan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Kebudayaan:</strong>
                                    {{ $budayas->nama_kebudayaan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $budayas->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $budayas->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $budayas->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $budayas->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $budayas->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $budayas->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
