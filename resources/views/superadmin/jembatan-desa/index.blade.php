@extends('layouts.app')

@section('template_title')
    Jembatan Desa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.messages')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span id="card_title">{{ __('Jembatan Desa') }}</span>
                        <a href="{{ route('superadmin.jembatan-desa.create') }}"
                           class="btn btn-primary btn-sm">
                            {{ __('Create New') }}
                        </a>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Desa</th>
                                        <th>RT/RW</th>
                                        <th>Nama Jembatan</th>
                                        <th>Panjang</th>
                                        <th>Lebar</th>
                                        <th>Kondisi</th>
                                        <th>Lokasi</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jembatanDesas as $jembatanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>
                                                @if ($jembatanDesa->foto)
                                                    <img src="{{ asset('storage/foto_jembatan/' . $jembatanDesa->foto) }}"
                                                         alt="Foto"
                                                         style="max-height: 80px; border-radius: 5px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>{{ $jembatanDesa->desa->nama_desa }}</td>
                                            <td>{{ $jembatanDesa->rtRwDesa->rt }}/{{ $jembatanDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $jembatanDesa->nama_jembatan }}</td>
                                            <td>{{ $jembatanDesa->panjang }} M</td>
                                            <td>{{ $jembatanDesa->lebar }} M</td>
                                            <td>
                                                @if ($jembatanDesa->kondisi == 'Baik')
                                                    <span class="badge bg-success">{{ $jembatanDesa->kondisi }}</span>
                                                @elseif($jembatanDesa->kondisi == 'Rusak Ringan')
                                                    <span class="badge bg-warning text-dark">{{ $jembatanDesa->kondisi }}</span>
                                                @elseif($jembatanDesa->kondisi == 'Rusak Berat')
                                                    <span class="badge bg-danger">{{ $jembatanDesa->kondisi }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $jembatanDesa->kondisi }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $jembatanDesa->lokasi }}</td>
                                            <td>{{ $jembatanDesa->created_by }}</td>
                                            <td>
                                                <span class="badge
                                                    @if ($jembatanDesa->status === 'Approved') bg-success
                                                    @elseif ($jembatanDesa->status === 'Pending') bg-warning text-dark
                                                    @elseif ($jembatanDesa->status === 'Arsip') bg-secondary
                                                    @elseif ($jembatanDesa->status === 'Rejected') bg-danger
                                                    @else bg-light text-dark @endif">
                                                    {{ $jembatanDesa->status }}
                                                </span>
                                            </td>

                                            {{-- Komponen tombol aksi --}}
                                            <x-action-buttons-superadmin 
                                                :item="$jembatanDesa" 
                                                routePrefix="superadmin.jembatan-desa"
                                                :deleteRoute="true" />
                                        </tr>

                                        {{-- Modal Show detail (pakai modal lama) --}}
                                        @include('layouts.partials.modal.modal_jembatan', ['jembatanDesa' => $jembatanDesa])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $jembatanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
