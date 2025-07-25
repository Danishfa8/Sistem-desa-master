@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Produk Unggulan
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Produk Unggulan</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('superadmin.produk.update', $produk->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('superadmin.produk.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
