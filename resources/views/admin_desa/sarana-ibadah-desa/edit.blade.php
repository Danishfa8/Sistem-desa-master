@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Sarana Ibadah Desa
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Sarana Ibadah Desa</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST"
                            action="{{ route('admin_desa.sarana-ibadah-desas.update', $saranaIbadahDesa->id) }}"
                            role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin_desa.sarana-ibadah-desa.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
