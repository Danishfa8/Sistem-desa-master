@extends('layouts.app')

@section('template_title')
    {{ $rtRwDesa->name ?? __('Show') . " " . __('Rt Rw Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Rt Rw Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('rt-rw-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $rtRwDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rt:</strong>
                                    {{ $rtRwDesa->rt }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rw:</strong>
                                    {{ $rtRwDesa->rw }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
