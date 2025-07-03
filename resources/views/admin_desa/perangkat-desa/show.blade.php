@extends('layouts.app')

@section('template_title')
    {{ $perangkatDesa->name ?? __('Show') . " " . __('Perangkat Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Perangkat Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('perangkat-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $perangkatDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nama:</strong>
                                    {{ $perangkatDesa->nama }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jabatan:</strong>
                                    {{ $perangkatDesa->jabatan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Foto:</strong>
                                    {{ $perangkatDesa->foto }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
