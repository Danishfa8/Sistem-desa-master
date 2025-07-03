@extends('layouts.app')

@section('template_title')
    Usaha Ekonomi
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
                                {{ __('Usaha Ekonomi') }}
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
                                        <th>Tahun</th>
                                        <th>Nama Usaha</th>
                                        <th>Luas</th>
                                        <th>Created By</th>
                                        <th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usahaEkonomis as $usahaEkonomi)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $usahaEkonomi->desa->nama_desa }}</td>
                                            <td>{{ $usahaEkonomi->tahun }}</td>
                                            <td>{{ $usahaEkonomi->nama_usaha }}</td>
                                            <td>{{ $usahaEkonomi->luas }}</td>
                                            <td>{{ $usahaEkonomi->created_by }}</td>
                                            <td>
                                                @if ($usahaEkonomi->status == 'Arsip')
                                                    <span class="badge bg-primary">{{ $usahaEkonomi->status }}</span>
                                                @elseif($usahaEkonomi->status == 'Pending')
                                                    <span class="badge bg-warning">{{ $usahaEkonomi->status }}</span>
                                                @elseif ($usahaEkonomi->status == 'Approved')
                                                    <span class="badge bg-success">{{ $usahaEkonomi->status }}</span>
                                                @elseif ($usahaEkonomi->status == 'Rejected')
                                                    <span class="badge bg-danger">{{ $usahaEkonomi->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $usahaEkonomi->status }}</span>
                                                @endif
                                            </td>
                                            <x-action-buttons :item="$usahaEkonomi" route-prefix="admin_desa.usaha-ekonomi"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_usaha_ekonomi')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $usahaEkonomis])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
