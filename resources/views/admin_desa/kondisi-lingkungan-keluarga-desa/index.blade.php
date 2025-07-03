@extends('layouts.app')

@section('template_title')
    Kondisi Lingkungan Keluarga Desa
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
                                {{ __('Kondisi Lingkungan Keluarga Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.kondisi-lingkungan-keluarga-desa.create') }}"
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
                                        <th>Jenis Kondisi</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kondisiLingkunganKeluargaDesas as $kondisiLingkunganKeluargaDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $kondisiLingkunganKeluargaDesa->desa->nama_desa }}</td>
                                            <td>{{ $kondisiLingkunganKeluargaDesa->rtRwDesa->rt }}/{{ $kondisiLingkunganKeluargaDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $kondisiLingkunganKeluargaDesa->tahun }}</td>
                                            <td>{{ $kondisiLingkunganKeluargaDesa->jenis_kondisi }}</td>
                                            <td>{{ $kondisiLingkunganKeluargaDesa->created_by }}</td>
                                            <x-action-buttons :item="$kondisiLingkunganKeluargaDesa"
                                                route-prefix="admin_desa.kondisi-lingkungan-keluarga-desa" :ajukan-route="true"
                                                status-field="status" />
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $kondisiLingkunganKeluargaDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
