@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Disabilitas Desa
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-animate">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Disabilitas Desa</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('superadmin.disabilitas-desa.update', $disabilitasDesa->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('superadmin.disabilitas-desa.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
