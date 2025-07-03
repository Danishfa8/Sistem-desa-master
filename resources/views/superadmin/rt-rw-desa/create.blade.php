@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} RT/RW
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} RT/RW</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('superadmin.rt-rw-desa.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('superadmin.rt-rw-desa.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
