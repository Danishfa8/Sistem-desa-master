@extends('layouts.app')

@section('template_title')
    Usaha Ekonomi
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('layouts.messages')
                <div class="card card-animate">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Usaha Ekonomi') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.usaha-ekonomi.create') }}"
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
                                        <th>Tahun</th>
                                        <th>Nama Usaha</th>
                                        <th>Luas</th>
                                        <th>Created By</th>
                                        <th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usahaEkonomis as $usahaEkonomi)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $usahaEkonomi->desa->nama_desa }}</td>
                                            <td>{{ $usahaEkonomi->tahun }}</td>
                                            <td>{{ $usahaEkonomi->nama_usaha }}</td>
                                            <td>{{ $usahaEkonomi->luas }}</td>
                                            <td>{{ $usahaEkonomi->created_by }}</td>
                                            <td>{{ $usahaEkonomi->status }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.usaha-ekonomi.destroy', $usahaEkonomi->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $usahaEkonomi->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }} <a
                                                            class="btn btn-sm btn-success"
                                                            href="{{ route('superadmin.usaha-ekonomi.edit', $usahaEkonomi->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_usaha_ekonomi')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $usahaEkonomis])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
