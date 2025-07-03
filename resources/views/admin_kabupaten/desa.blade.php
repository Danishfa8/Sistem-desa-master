@extends('layouts.app')

@section('template_title')
    Data Desa
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
                                {{ __('Data Desa') }}
                            </span>

                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Kecamatan</th>
                                        <th>Nama Desa</th>
                                        <th>Klas</th>
                                        <th>Stat Pem</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($desas as $desa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $desa->kecamatan->nama_kecamatan }}</td>
                                            <td>{{ $desa->nama_desa }}</td>
                                            <td>{{ $desa->klas }}</td>
                                            <td>{{ $desa->stat_pem }}</td>
                                            <td>{{ $desa->latitude }}</td>
                                            <td>{{ $desa->longitude }}</td>
                                            <td> <button type="button" class="btn btn-sm btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#showModal{{ $desa->id }}">
                                                    <i class="las la-eye"></i> {{ __('Show') }}
                                                </button></td>

                                        </tr>
                                        @include('layouts.partials.modal.modal_desa')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $desas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
