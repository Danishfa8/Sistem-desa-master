@extends('layouts.app')

@section('template_title')
    Jalan Kabupaten Desa
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
                                {{ __('Jalan Kabupaten Desa') }}
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
                                        <th>Rt/RW</th>
                                        <th>Nama Jalan</th>
                                        <th>Panjang Jalan</th>
                                        <th>Lebar Jalan</th>
                                        <th>Kondisi</th>
                                        <th>Jenis Jalan</th>
                                        <th>Lokasi</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jalanKabupatenDesas as $jalanKabupatenDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $jalanKabupatenDesa->desa->nama_desa }}</td>
                                            <td>{{ $jalanKabupatenDesa->rtRwDesa->rt }}/{{ $jalanKabupatenDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $jalanKabupatenDesa->nama_jalan }}</td>
                                            <td>{{ $jalanKabupatenDesa->panjang_jalan }}</td>
                                            <td>{{ $jalanKabupatenDesa->lebar_jalan }}</td>
                                            <td>
                                                @if ($jalanKabupatenDesa->kondisi == 'Baik')
                                                    <span class="badge bg-success">{{ $jalanKabupatenDesa->kondisi }}</span>
                                                @elseif($jalanKabupatenDesa->kondisi == 'Rusak Ringan')
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $jalanKabupatenDesa->kondisi }}</span>
                                                @elseif($jalanKabupatenDesa->kondisi == 'Rusak Berat')
                                                    <span class="badge bg-danger">{{ $jalanKabupatenDesa->kondisi }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ $jalanKabupatenDesa->kondisi }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $jalanKabupatenDesa->jenis_jalan }}</td>
                                            <td>{{ $jalanKabupatenDesa->lokasi }}</td>
                                            <td>{{ $jalanKabupatenDesa->created_by }}</td>
                                            <x-action-buttons :item="$jalanKabupatenDesa"
                                                route-prefix="admin_desa.jalan-kabupaten-desa" :ajukan-route="true"
                                                status-field="status" />
                                        </tr>
                                        @include('layouts.partials.modal.modal_jalan_kabupaten')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $jalanKabupatenDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
