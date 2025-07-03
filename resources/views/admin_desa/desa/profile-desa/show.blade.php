@extends('layouts.app')

@section('template_title')
    {{ $profileDesa->name ?? __('Show') . " " . __('Profile Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Profile Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('profile-desas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Desa Id:</strong>
                                    {{ $profileDesa->desa_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Visi:</strong>
                                    {{ $profileDesa->visi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Misi:</strong>
                                    {{ $profileDesa->misi }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Program Unggulan:</strong>
                                    {{ $profileDesa->program_unggulan }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Batas Wilayah:</strong>
                                    {{ $profileDesa->batas_wilayah }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Alamat:</strong>
                                    {{ $profileDesa->alamat }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telepon:</strong>
                                    {{ $profileDesa->telepon }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Foto:</strong>
                                    {{ $profileDesa->foto }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
