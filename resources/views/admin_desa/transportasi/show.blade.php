@extends('layouts.app')

@section('template_title')
    {{ $transportasi->jenis_transportasi ?? __('Show') . " " . __('Transportasi') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Transportasi</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('transportasi.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $transportasi->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tahun:</strong>
                                    {{ $transportasi->tahun }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Transportasi:</strong>
                                    {{ $transportasi->jenis_transportasi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $transportasi->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $transportasi->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $transportasi->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $transportasi->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $transportasi->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $transportasi->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
