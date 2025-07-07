@extends('layouts.app')

@section('template_title')
    Pendidikan Desa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.messages')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span id="card_title">{{ __('Pendidikan Desa') }}</span>
                        <a href="{{ route('superadmin.pendidikan-desa.create') }}" class="btn btn-primary btn-sm">
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
                                        <th>Nama Pendidikan</th>
                                        <th>Jenis Pendidikan</th>
                                        <th>Status Pendidikan</th>
                                        <th>Tahun</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendidikanDesas as $pendidikanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                @if ($pendidikanDesa->foto)
                                                    <img src="{{ asset('storage/foto_pendidikan/' . $pendidikanDesa->foto) }}" alt="Foto Pendidikan" style="max-height: 60px; border-radius: 4px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $pendidikanDesa->desa->nama_desa }}</td>
                                            <td>{{ $pendidikanDesa->rtRwDesa->rt }}/{{ $pendidikanDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $pendidikanDesa->nama_pendidikan }}</td>
                                            <td>{{ $pendidikanDesa->jenis_pendidikan }}</td>
                                            <td>{{ $pendidikanDesa->status_pendidikan }}</td>
                                            <td>{{ $pendidikanDesa->tahun }}</td>
                                            <td>{{ $pendidikanDesa->created_by }}</td>
                                            <td>
                                                <span class="badge
                                                    @if ($pendidikanDesa->status === 'Approved') bg-success
                                                    @elseif ($pendidikanDesa->status === 'Pending') bg-warning text-dark
                                                    @elseif ($pendidikanDesa->status === 'Arsip') bg-secondary
                                                    @elseif ($pendidikanDesa->status === 'Rejected') bg-danger
                                                    @else bg-light text-dark @endif">
                                                    {{ $pendidikanDesa->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <x-action-buttons-superadmin 
                                                    :item="$pendidikanDesa" 
                                                    routePrefix="superadmin.pendidikan-desa"
                                                    :deleteRoute="true" />
                                            </td>
                                        </tr>

                                        {{-- Modal Show detail --}}
                                        @include('layouts.partials.modal.modal_pendidikan', ['pendidikanDesa' => $pendidikanDesa])
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
