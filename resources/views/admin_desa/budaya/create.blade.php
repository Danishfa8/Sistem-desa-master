@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Kebudayaan
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-animate">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Kebudayaan</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin_desa.budaya.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('admin_desa.budaya.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
