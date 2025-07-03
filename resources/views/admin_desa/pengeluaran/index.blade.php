@extends('layouts.app')

@section('template_title')
    Pengeluaran Desa
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
                                {{ __('Pengeluaran Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.pengeluaran.create') }}"
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
                                        <th>Tahun</th>
                                        <th>Jenis Pengeluaran</th>
                                        <th>Jumlah</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengeluarans as $pengeluaran)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $pengeluaran->desa->nama_desa }}</td>
                                            <td>{{ $pengeluaran->tahun }}</td>
                                            <td>{{ $pengeluaran->jenis_pengeluaran }}</td>
                                            <td>@rupiah($pengeluaran->jumlah)</td>
                                            <td>{{ $pengeluaran->created_by }}</td>
                                            <td>{{ $pengeluaran->updated_by }}</td>
                                            <td>
                                                @if ($pengeluaran->status == 'Arsip')
                                                    <span class="badge bg-primary">{{ $pengeluaran->status }}</span>
                                                @elseif($pengeluaran->status == 'Pending')
                                                    <span class="badge bg-warning">{{ $pengeluaran->status }}</span>
                                                @elseif ($pengeluaran->status == 'Approved')
                                                    <span class="badge bg-success">{{ $pengeluaran->status }}</span>
                                                @elseif ($pengeluaran->status == 'Rejected')
                                                    <span class="badge bg-danger">{{ $pengeluaran->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $pengeluaran->status }}</span>
                                                @endif
                                            </td>
                                            <x-action-buttons :item="$pengeluaran" route-prefix="admin_desa.bumdes"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_pengeluaran')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $pengeluarans])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
