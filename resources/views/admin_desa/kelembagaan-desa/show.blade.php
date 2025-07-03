@extends('layouts.app')

@section('template_title')
    {{ $kelembagaanDesa->name ?? __('Show') . ' ' . __('Kelembagaan Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Kelembagaan Desa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('superadmin.kelembagaan-desa.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="30%">Desa</th>
                                        <td>{{ $kelembagaanDesa->desa->nama_desa }}</td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td>{{ $kelembagaanDesa->rtRwDesa->rt }}/{{ $kelembagaanDesa->rtRwDesa->rw }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tahun</th>
                                        <td>{{ $kelembagaanDesa->tahun }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelembagaan</th>
                                        <td>{{ $kelembagaanDesa->jenis_kelembagaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kelembagaan</th>
                                        <td>{{ $kelembagaanDesa->nama_kelembagaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>{{ $kelembagaanDesa->created_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>{{ $kelembagaanDesa->updated_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($kelembagaanDesa->status === 'Arsip')
                                                <span class="badge bg-primary">{{ $kelembagaanDesa->status }}</span>
                                            @elseif ($kelembagaanDesa->status === 'Pending')
                                                <span class="badge bg-warning">{{ $kelembagaanDesa->status }}</span>
                                            @elseif ($kelembagaanDesa->status === 'Approved')
                                                <span class="badge bg-success">{{ $kelembagaanDesa->status }}</span>
                                            @elseif ($kelembagaanDesa->status === 'Rejected')
                                                <span class="badge bg-danger">{{ $kelembagaanDesa->status }}</span>
                                            @else
                                                {{ $kelembagaanDesa->status }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Reject Reason</th>
                                        <td>{{ $kelembagaanDesa->reject_reason ?? 'Tidak ada keterangan' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Approved By</th>
                                        <td>{{ $kelembagaanDesa->approved_by ?? 'Belum diperiksa' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Approved At</th>
                                        <td>{{ $kelembagaanDesa->approved_at ?? 'Belum Diperiksa' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
