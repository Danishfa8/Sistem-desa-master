@extends('layouts.app')

@section('template_title')
    Jalan Desa
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
                                {{ __('Jalan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.jalan-desa.create') }}"
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
                                        <th>Nama Jalan</th>
                                        <th>Panjang</th>
                                        <th>Lebar</th>
                                        <th>Kondisi</th>
                                        <th>Jenis Jalan</th>
                                        <th>Lokasi</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jalanDesas as $jalanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $jalanDesa->desa->nama_desa }}</td>
                                            <td>{{ $jalanDesa->rtRwDesa->rt }}/{{ $jalanDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $jalanDesa->nama_jalan }}</td>
                                            <td>{{ $jalanDesa->panjang }} M</td>
                                            <td>{{ $jalanDesa->lebar }} M</td>
                                            <td>
                                                @if ($jalanDesa->kondisi == 'Baik')
                                                    <span class="badge bg-success">{{ $jalanDesa->kondisi }}</span>
                                                @elseif($jalanDesa->kondisi == 'Rusak Ringan')
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $jalanDesa->kondisi }}</span>
                                                @elseif($jalanDesa->kondisi == 'Rusak Berat')
                                                    <span class="badge bg-danger">{{ $jalanDesa->kondisi }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $jalanDesa->kondisi }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $jalanDesa->jenis_jalan }}</td>
                                            <td>{{ $jalanDesa->lokasi }}</td>
                                            <td>{{ $jalanDesa->created_by }}</td>

                                            <td>
                                                <form action="{{ route('superadmin.jalan-desa.destroy', $jalanDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $jalanDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.jalan-desa.edit', $jalanDesa->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_jalan_desa')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $jalanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
