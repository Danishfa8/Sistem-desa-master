@extends('layouts.app')

@section('template_title')
    {{ $jalanKabupatenDesa->name ?? __('Show') . " " . __('Jalan Kabupaten Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Jalan Kabupaten Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('jalan-kabupaten-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $jalanKabupatenDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt Rw Desa Id:</strong>
                                    {{ $jalanKabupatenDesa->rt_rw_desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama Jalan:</strong>
                                    {{ $jalanKabupatenDesa->nama_jalan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Panjang Jalan:</strong>
                                    {{ $jalanKabupatenDesa->panjang_jalan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lebar Jalan:</strong>
                                    {{ $jalanKabupatenDesa->lebar_jalan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Kondisi:</strong>
                                    {{ $jalanKabupatenDesa->kondisi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jenis Jalan:</strong>
                                    {{ $jalanKabupatenDesa->jenis_jalan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Lokasi:</strong>
                                    {{ $jalanKabupatenDesa->lokasi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Created By:</strong>
                                    {{ $jalanKabupatenDesa->created_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Updated By:</strong>
                                    {{ $jalanKabupatenDesa->updated_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Status:</strong>
                                    {{ $jalanKabupatenDesa->status }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reject Reason:</strong>
                                    {{ $jalanKabupatenDesa->reject_reason }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved By:</strong>
                                    {{ $jalanKabupatenDesa->approved_by }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Approved At:</strong>
                                    {{ $jalanKabupatenDesa->approved_at }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Latitude:</strong>
                                    {{ $jalanKabupatenDesa->latitude }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Longitude:</strong>
                                    {{ $jalanKabupatenDesa->longitude }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
