@extends('layouts.app')

@section('template_title')
    Balita Desa
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
                                {{ __('Balita Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.balita-desa.create') }}"
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
                                        <th>Tahun</th>
                                        <th>Jenis Balita</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($balitaDesas as $balitaDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $balitaDesa->desa->nama_desa }}</td>
                                            <td>{{ $balitaDesa->rtRwDesa->rt }}/{{ $balitaDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $balitaDesa->tahun }}</td>
                                            <td>{{ $balitaDesa->jenis_balita }}</td>
                                            <td>{{ $balitaDesa->created_by }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('superadmin.balita-desa.destroy', $balitaDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $balitaDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.balita-desa.edit', $balitaDesa->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_balita')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $balitaDesas])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
