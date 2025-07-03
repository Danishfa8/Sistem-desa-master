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
                                <a href="{{ route('superadmin.lpmdk.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

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
                                            <td>
                                                <form action="{{ route('superadmin.lpmdk.destroy', $lpmdk->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.lpmdk.show', $lpmdk->id) }}"><i
                                                            class="las la-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.lpmdk.edit', $lpmdk->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
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
