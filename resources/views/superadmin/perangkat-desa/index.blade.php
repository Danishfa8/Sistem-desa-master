@extends('layouts.app')

@section('template_title')
    Perangkat Desa
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
                                {{ __('Perangkat Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.perangkat-desa.create') }}"
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
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Foto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perangkatDesas as $perangkatDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $perangkatDesa->desa->nama_desa }}</td>
                                            <td>{{ $perangkatDesa->nama }}</td>
                                            <td>{{ $perangkatDesa->jabatan }}</td>
                                            <td><img src="{{ asset('storage/' . $perangkatDesa->foto) }}"
                                                    alt="Foto Profil Desa"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.perangkat-desa.destroy', $perangkatDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $perangkatDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button> <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.perangkat-desa.edit', $perangkatDesa->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $perangkatDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
