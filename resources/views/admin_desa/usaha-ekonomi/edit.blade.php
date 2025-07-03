@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Usaha Ekonomi
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Usaha Ekonomi</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('admin_desa.usaha-ekonomi.update', $usahaEkonomi->id) }}"
                            role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin_desa.usaha-ekonomi.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
