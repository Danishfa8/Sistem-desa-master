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
                                        <th>Jenis Kelembagaan</th>
                                        <th>Nama Kelembagaan</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelembagaanDesas as $kelembagaanDesa)
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
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse

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
