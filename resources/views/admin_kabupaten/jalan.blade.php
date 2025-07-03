@extends('layouts.app')

@section('template_title')
    Jalan Desa
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
                                {{ __('Jalan Desa') }}
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
                                        <th>Nama Jalan</th>
                                        <th>Panjang</th>
                                        <th>Lebar</th>
                                        <th>Kondisi</th>
                                        <th>Jenis Jalan</th>
                                        <th>Lokasi</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jalanDesas as $jalanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $jalanDesa->desa->nama_desa }}</td>
                                            <td>{{ $jalanDesa->rtRwDesa->rt }}/{{ $jalanDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $jalanDesa->nama_jalan }}</td>
                                            <td>{{ $jalanDesa->panjang }} M</td>
                                            <td>{{ $jalanDesa->lebar }} M</td>
                                            <td>
                                                @if ($jalanDesa->kondisi == 'Baik')
                                                    <span class="badge bg-success">{{ $jalanDesa->kondisi }}</span>
                                                @elseif($jalanDesa->kondisi == 'Rusak Ringan')
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $jalanDesa->kondisi }}</span>
                                                @elseif($jalanDesa->kondisi == 'Rusak Berat')
                                                    <span class="badge bg-danger">{{ $jalanDesa->kondisi }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $jalanDesa->kondisi }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $jalanDesa->jenis_jalan }}</td>
                                            <td>{{ $jalanDesa->lokasi }}</td>
                                            <td>{{ $jalanDesa->created_by }}</td>
                                            <x-action-buttons :item="$jalanDesa" route-prefix="admin_desa.jalan-desa"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_jalan_desa')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $jalanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
