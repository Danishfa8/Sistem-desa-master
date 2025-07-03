@extends('layouts.app')

@section('template_title')
    LPMD/LPMK
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('LPMD/LPMK') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.lpmdk.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
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
                                        <th>Jumlah Pengurus</th>
                                        <th>Jumlah Anggota</th>
                                        <th>Jumlah Kegiatan</th>
                                        <th>Jumlah Buku Administrasi</th>
                                        <th>Jumlah Dana</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lpmdks as $lpmdk)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $lpmdk->desa->nama_desa }}</td>
                                            <td>{{ $lpmdk->rtRwDesa->rt }}/{{ $lpmdk->rtRwDesa->rw }}</td>
                                            <td>{{ $lpmdk->jumlah_pengurus }}</td>
                                            <td>{{ $lpmdk->jumlah_anggota }}</td>
                                            <td>{{ $lpmdk->jumlah_kegiatan }}</td>
                                            <td>{{ $lpmdk->jumlah_buku_administrasi }}</td>
                                            <td>@rupiah($lpmdk->jumlah_dana)</td>
                                            <td>{{ $lpmdk->created_by }}</td>
                                            <x-action-buttons :item="$lpmdk" route-prefix="admin_desa.lpmdk"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_lpmdks')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $lpmdks])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
