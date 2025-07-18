@extends('layouts.app')

@section('template_title')
    Pelaku Umkm Desa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.messages')
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pelaku Umkm Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.pelaku-umkm-desa.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Desa</th>
                                        <th>RT/RW</th>
                                        <th>Tahun</th>
                                        <th>Jumlah UMKM</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelakuUmkmDesas as $pelakuUmkmDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $pelakuUmkmDesa->desa->nama_desa }}</td>
                                            <td>{{ $pelakuUmkmDesa->rtRwDesa->rt }}/{{ $pelakuUmkmDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $pelakuUmkmDesa->tahun }}</td>
                                            <td>{{ number_format($pelakuUmkmDesa->jumlah_umkm) }}</td> 
                                            <td>{{ $pelakuUmkmDesa->created_by }}</td>

                                            <td>
                                            <x-action-buttons-superadmin 
                                                :item="$pelakuUmkmDesa" 
                                                routePrefix="superadmin.pelaku-umkm-desa"
                                                :deleteRoute="true" />
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_pelaku_umkm')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $pelakuUmkmDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
