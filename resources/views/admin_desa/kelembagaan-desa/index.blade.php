@extends('layouts.app')

@section('template_title')
    Kelembagaan Desas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Kelembagaan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.kelembagaan-desa.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Desa</th>
                                        <th>RT/RW</th>
                                        <th>Tahun</th>
                                        <th>Jenis Kelembagaan</th>
                                        <th>Nama Kelembagaan</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelembagaanDesas as $kelembagaanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $kelembagaanDesa->desa->nama_desa }}</td>
                                            <td>{{ $kelembagaanDesa->rtRwDesa->rt }}/{{ $kelembagaanDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $kelembagaanDesa->tahun }}</td>
                                            <td>{{ $kelembagaanDesa->jenis_kelembagaan }}</td>
                                            <td>{{ $kelembagaanDesa->nama_kelembagaan }}</td>
                                            <td>{{ $kelembagaanDesa->created_by }}</td>
                                            <x-action-buttons :item="$kelembagaanDesa" route-prefix="admin_desa.kelembagaan-desa"
                                                :ajukan-route="true" status-field="status" />
                                        </tr>
                                        @include('layouts.partials.modal.modal_kelembagaan')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $kelembagaanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
