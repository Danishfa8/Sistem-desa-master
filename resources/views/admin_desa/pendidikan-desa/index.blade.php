@extends('layouts.app')

@section('template_title')
    Pendidikan Desa
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
                                {{ __('Pendidikan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.pendidikan-desa.create') }}"
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
                                        <th>Jenis Pendidikan</th>
                                        <th>Status Pendidikan</th>
                                        <th>Foto</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendidikanDesas as $pendidikanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $pendidikanDesa->desa->nama_desa }}</td>
                                            <td>{{ $pendidikanDesa->rtRwDesa->rt }}/{{ $pendidikanDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $pendidikanDesa->tahun }}</td>
                                            <td>{{ $pendidikanDesa->jenis_pendidikan }}</td>
                                            <td>{{ $pendidikanDesa->status_pendidikan }}</td>
                                            <td><img src="{{ asset('storage/' . $pendidikanDesa->foto) }}"
                                                    alt="Pendidikan Desa"
                                                    style="width: 100px; height: 100px; object-fit: cover;"></td>
                                            <td>{{ $pendidikanDesa->created_by }}</td>
                                            <x-action-buttons :item="$pendidikanDesa" route-prefix="admin_desa.pendidikan-desa"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_pendidikan', [
                                            'pendidikanDesa' => $pendidikanDesa,
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $pendidikanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
