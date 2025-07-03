@extends('layouts.app')

@section('template_title')
    {{ $pendapatanDesa->name ?? __('Show') . " " . __('Pendapatan Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pendapatan Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('pendapatan-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $pendapatanDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Sumber Pendapatan:</strong>
                                    {{ $pendapatanDesa->sumber_pendapatan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Jumlah Pendapatan:</strong>
                                    {{ $pendapatanDesa->jumlah_pendapatan }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
