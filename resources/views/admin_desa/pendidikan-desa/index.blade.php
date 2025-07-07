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
                                        <th>Nama Pendidikan</th>
                                        <th>Status Pendidikan</th>
                                        <th>Foto</th>
                                        <th>Created By</th>
                                        <th>Status</th>
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
                                            <td>{{ $pendidikanDesa->nama_pendidikan }}</td>
                                            <td>{{ $pendidikanDesa->status_pendidikan }}</td>
                                            <td>
                                                @if ($pendidikanDesa->foto)
                                                    <img src="{{ asset('storage/foto_pendidikan/' . $pendidikanDesa->foto) }}"
                                                        alt="Foto Pendidikan"
                                                        style="max-height: 60px; border-radius: 4px;">
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
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
                                            <x-action-buttons :item="$pendidikanDesa"
                                                route-prefix="admin_desa.pendidikan-desa"
                                                :ajukan-route="true" status-field="status" />
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Render semua modal di luar table --}}
                        @foreach ($pendidikanDesas as $pendidikanDesa)
                            @include('layouts.partials.modal.modal_pendidikan', ['pendidikanDesa' => $pendidikanDesa])
                        @endforeach

                        @include('layouts.pagination', ['paginator' => $pendidikanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
