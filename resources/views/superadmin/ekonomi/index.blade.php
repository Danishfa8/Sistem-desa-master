@extends('layouts.app')

@section('template_title')
    Ekonomis
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
                                {{ __('Ekonomis') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.ekonomi.create') }}" class="btn btn-primary btn-sm float-right"
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
                                        <th>Tahun</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Pemilik</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ekonomis as $ekonomi)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $ekonomi->desa_id }}</td>
                                            <td>{{ $ekonomi->tahun }}</td>
                                            <td>{{ $ekonomi->jenis }}</td>
                                            <td>{{ $ekonomi->nama }}</td>
                                            <td>{{ $ekonomi->pemilik }}</td>
                                            <td>{{ $ekonomi->created_by }}</td>
                                            <td>{{ $ekonomi->status }}</td>

                                            <td>
                                                <form action="{{ route('superadmin.ekonomi.destroy', $ekonomi->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $ekonomi->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button> <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.ekonomi.edit', $ekonomi->id) }}"><i
                                                            class="las.la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las.la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_ekonomi')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $ekonomis])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
