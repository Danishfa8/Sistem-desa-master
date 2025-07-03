@extends('layouts.app')

@section('template_title')
    Pelaku Umkm Desa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.messages')
                <div class="card card-animate">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pelaku Umkm Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.pelaku-umkm-desa.create') }}"
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
                                        <th>Jenis Pelaku Umkm</th>
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
                                            <td>{{ $pelakuUmkmDesa->jenis_pelaku_umkm }}</td>
                                            <td>{{ $pelakuUmkmDesa->created_by }}</td>
                                            <x-action-buttons :item="$pelakuDesa" route-prefix="admin_desa.pelaku-desa"
                                                :ajukan-route="true" status-field="status" />

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
