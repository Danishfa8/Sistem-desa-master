@extends('layouts.app')

@section('template_title')
    Sarana Ibadah Desa
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
                                {{ __('Sarana Ibadah Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.sarana-ibadah-desa.create') }}"
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
                                        <th>Jenis Sarana Ibadah</th>
                                        <th>Nama Sarana Ibadah</th>
                                        <th>Foto</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saranaIbadahDesas as $saranaIbadahDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $saranaIbadahDesa->desa->nama_desa }}</td>
                                            <td>{{ $saranaIbadahDesa->rtRwDesa->rt }}/{{ $saranaIbadahDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $saranaIbadahDesa->tahun }}</td>
                                            <td>{{ $saranaIbadahDesa->jenis_sarana_ibadah }}</td>
                                            <td>{{ $saranaIbadahDesa->nama_sarana_ibadah }}</td>
                                            <td><img src="{{ asset('storage/' . $saranaIbadahDesa->foto) }}"
                                                    alt="Ibadah desa"
                                                    style="width: 100px; height: 100px; object-fit: cover;"></td>
                                            <td>{{ $saranaIbadahDesa->created_by }}</td>
                                            <x-action-buttons :item="$saranaIbadahDesa" route-prefix="admin_desa.sarana-ibadah-desa"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_sarana_ibadah')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $saranaIbadahDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
