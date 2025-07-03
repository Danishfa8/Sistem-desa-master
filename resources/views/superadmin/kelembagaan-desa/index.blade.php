@extends('layouts.app')

@section('template_title')
    Kelembagaan Desas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Kelembagaan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.kelembagaan-desa.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
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
                                        <th>Tahun</th>
                                        <th>Jenis Kelembagaan</th>
                                        <th>Nama Kelembagaan</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelembagaanDesas as $kelembagaanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $kelembagaanDesa->desa->nama_desa }}</td>
                                            <td>{{ $kelembagaanDesa->rtRwDesa->rt }}/{{ $kelembagaanDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $kelembagaanDesa->tahun }}</td>
                                            <td>{{ $kelembagaanDesa->jenis_kelembagaan }}</td>
                                            <td>{{ $kelembagaanDesa->nama_kelembagaan }}</td>
                                            <td>{{ $kelembagaanDesa->created_by }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('superadmin.kelembagaan-desa.destroy', $kelembagaanDesa->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.kelembagaan-desa.show', $kelembagaanDesa->id) }}"><i
                                                            class="las la-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.kelembagaan-desa.edit', $kelembagaanDesa->id) }}">
                                                        <i class="las la-edit"></i> {{ __('Edit') }}
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                        <i class="las la-trash"></i> {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $kelembagaanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
