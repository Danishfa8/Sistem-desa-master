@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Kerawanan Sosial Desa
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-animate">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Kerawanan Sosial Desa</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST"
                            action="{{ route('admin_desa.kerawanan-sosial-desa.update', $kerawananSosialDesa->id) }}"
                            role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin_desa.kerawanan-sosial-desa.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
