@extends('layouts.app')

@section('template_title')
    Sarana Pendukung Kesehatan Desa
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
                                {{ __('Sarana Pendukung Kesehatan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.sarana-pendukung-kesehatan-desa.create') }}"
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
                                        <th>Jenis Sarana</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saranaPendukungKesehatanDesas as $saranaPendukungKesehatanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $saranaPendukungKesehatanDesa->desa->nama_desa }}</td>
                                            <td>{{ $saranaPendukungKesehatanDesa->rtRwDesa->rt }}/{{ $saranaPendukungKesehatanDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $saranaPendukungKesehatanDesa->tahun }}</td>
                                            <td>{{ $saranaPendukungKesehatanDesa->jenis_sarana }}</td>
                                            <td>{{ $saranaPendukungKesehatanDesa->created_by }}</td>
                                            <x-action-buttons :item="$saranaPendukungKesehatan"
                                                route-prefix="admin_desa.sarana-pendukung-kesehatan-desa" :ajukan-route="true"
                                                status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_sarana_pendukung_kesehatan')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $saranaPendukungKesehatanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
