@extends('layouts.app')

@section('template_title')
    Industri Penghasil Limbah Desa
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
                                {{ __('Industri Penghasil Limbah Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.industri-penghasil-limbah-desa.create') }}"
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
                                        <th>Jenis Industri</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($industriPenghasilLimbahDesas as $industriPenghasilLimbahDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $industriPenghasilLimbahDesa->desa->nama_desa }}</td>
                                            <td>{{ $industriPenghasilLimbahDesa->rtRwDesa->rt }}/{{ $industriPenghasilLimbahDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $industriPenghasilLimbahDesa->tahun }}</td>
                                            <td>{{ $industriPenghasilLimbahDesa->jenis_industri }}</td>
                                            <td>{{ $industriPenghasilLimbahDesa->created_by }}</td>

                                            <x-action-buttons :item="$industriPenghasilLimbahDesa"
                                                route-prefix="admin_desaindustri-penghasil-limbah-desa" :ajukan-route="true"
                                                status-field="status" />
                                        </tr>
                                        @include('layouts.partials.modal.modal_industri_penghasil_limbah')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $industriPenghasilLimbahDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
