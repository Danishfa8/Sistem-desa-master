@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Ekonomi
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-animate">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Ekonomi</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('superadmin.ekonomi.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('superadmin.ekonomi.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
