@extends('layouts.app')

@section('template_title')
    Sarana Kesehatan Desa
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
                                {{ __('Sarana Kesehatan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.sarana-kesehatan-desa.create') }}"
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
                                        <th>Jenis Sarana</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saranaKesehatanDesas as $saranaKesehatanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $saranaKesehatanDesa->desa->nama_desa }}</td>
                                            <td>{{ $saranaKesehatanDesa->rtRwDesa->rt }}/{{ $saranaKesehatanDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $saranaKesehatanDesa->tahun }}</td>
                                            <td>{{ $saranaKesehatanDesa->jenis_sarana }}</td>
                                            <td>{{ $saranaKesehatanDesa->created_by }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.sarana-kesehatan-desa.destroy', $saranaKesehatanDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $saranaKesehatanDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button>

                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.sarana-kesehatan-desa.edit', $saranaKesehatanDesa->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_sarana_kesehatan', [
                                            'saranaKesehatanDesa' => $saranaKesehatanDesa,
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $saranaKesehatanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
