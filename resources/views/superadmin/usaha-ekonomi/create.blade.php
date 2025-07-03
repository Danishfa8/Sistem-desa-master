@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Usaha Ekonomi
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Usaha Ekonomi</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('superadmin.usaha-ekonomi.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('superadmin.usaha-ekonomi.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
