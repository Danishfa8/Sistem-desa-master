@extends('layouts.app')

@section('template_title')
    {{ $lpmdk->name ?? __('Show') . " " . __('Lpmdk') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Lpmdk</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('lpmdks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>User Id:</strong>
                                    {{ $lpmdk->user_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lpmdk Id:</strong>
                                    {{ $lpmdk->lpmdk_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Pengurus:</strong>
                                    {{ $lpmdk->jumlah_pengurus }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Anggota:</strong>
                                    {{ $lpmdk->jumlah_anggota }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Kegiatan:</strong>
                                    {{ $lpmdk->jumlah_kegiatan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Buku Administrasi:</strong>
                                    {{ $lpmdk->jumlah_buku_administrasi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Dana:</strong>
                                    {{ $lpmdk->jumlah_dana }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $lpmdk->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $lpmdk->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $lpmdk->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $lpmdk->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $lpmdk->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $lpmdk->approved_at }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
