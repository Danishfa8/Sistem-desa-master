@extends('layouts.app')

@section('template_title')
    Sarana Ibadah Desa
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
                                {{ __('Sarana Ibadah Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.sarana-ibadah-desa.create') }}"
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
                                        <th>Jenis Sarana Ibadah</th>
                                        <th>Nama Sarana Ibadah</th>
                                        <th>Foto</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saranaIbadahDesas as $saranaIbadahDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $saranaIbadahDesa->desa->nama_desa }}</td>
                                            <td>{{ $saranaIbadahDesa->rtRwDesa->rt }}/{{ $saranaIbadahDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $saranaIbadahDesa->tahun }}</td>
                                            <td>{{ $saranaIbadahDesa->jenis_sarana_ibadah }}</td>
                                            <td>{{ $saranaIbadahDesa->nama_sarana_ibadah }}</td>
                                            <td><img src="{{ asset('storage/' . $saranaIbadahDesa->foto) }}"
                                                    alt="Ibadah desa"
                                                    style="width: 100px; height: 100px; object-fit: cover;"></td>
                                            <td>{{ $saranaIbadahDesa->created_by }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.sarana-ibadah-desa.destroy', $saranaIbadahDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $saranaIbadahDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.sarana-ibadah-desa.edit', $saranaIbadahDesa->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_sarana_ibadah')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $saranaIbadahDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
