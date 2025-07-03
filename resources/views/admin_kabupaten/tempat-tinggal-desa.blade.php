@extends('layouts.app')

@section('template_title')
    Tempat Tinggal Desa
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
                                {{ __('Tempat Tinggal Desa') }}
                            </span>
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
                                        <th>Jenis Tempat Tinggal</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tempatTinggalDesas as $tempatTinggalDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $tempatTinggalDesa->desa->nama_desa }}</td>
                                            <td>{{ $tempatTinggalDesa->rtRwDesa->rt }}/{{ $tempatTinggalDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $tempatTinggalDesa->tahun }}</td>
                                            <td>{{ $tempatTinggalDesa->jenis_tempat_tinggal }}</td>
                                            <td>{{ $tempatTinggalDesa->created_by }}</td>
                                            <x-action-buttons :item="$tempatTinggalDesa"
                                                route-prefix="admin_desa.tempat-tinggal-desa" :ajukan-route="true"
                                                status-field="status" />

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $tempatTinggalDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
