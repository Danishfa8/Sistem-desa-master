@extends('layouts.app')

@section('template_title')
    {{ $bumde->name ?? __('Show') . ' ' . __('Bumdes') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Bumdes</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('superadmin.bumdes.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="30%">Desa</th>
                                        <td>{{ $bumde->desa->nama_desa }}</td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td>{{ $bumde->rtRwDesa->rt }}/{{ $bumde->rtRwDesa->rw }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tahun</th>
                                        <td>{{ $bumde->tahun }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelembagaan</th>
                                        <td>{{ $bumde->jenis_kelembagaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kelembagaan</th>
                                        <td>{{ $bumde->nama_kelembagaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created By</th>
                                        <td>{{ $bumde->created_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>{{ $bumde->updated_by }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($bumde->status === 'Arsip')
                                                <span class="badge bg-primary">{{ $bumde->status }}</span>
                                            @elseif ($bumde->status === 'Pending')
                                                <span class="badge bg-warning">{{ $bumde->status }}</span>
                                            @elseif ($bumde->status === 'Approved')
                                                <span class="badge bg-success">{{ $bumde->status }}</span>
                                            @elseif ($bumde->status === 'Rejected')
                                                <span class="badge bg-danger">{{ $bumde->status }}</span>
                                            @else
                                                {{ $bumde->status }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Reject Reason</th>
                                        <td>{{ $bumde->reject_reason ?? 'Tidak ada keterangan' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Approved By</th>
                                        <td>{{ $bumde->approved_by ?? 'Belum diperiksa' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Approved At</th>
                                        <td>{{ $bumde->approved_at ?? 'Belum Diperiksa' }}</td>
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
