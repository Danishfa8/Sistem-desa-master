@extends('layouts.app')

@section('template_title')
    Data Desa
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
                                {{ __('Data Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.desas.create') }}" class="btn btn-primary btn-sm float-right"
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

                                        <th>Kecamatan</th>
                                        <th>Nama Desa</th>
                                        <th>Klas</th>
                                        <th>Stat Pem</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($desas as $desa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $desa->kecamatan->nama_kecamatan }}</td>
                                            <td>{{ $desa->nama_desa }}</td>
                                            <td>{{ $desa->klas }}</td>
                                            <td>{{ $desa->stat_pem }}</td>
                                            <td>{{ $desa->latitude }}</td>
                                            <td>{{ $desa->longitude }}</td>

                                            <td>
                                                <form action="{{ route('superadmin.desas.destroy', $desa->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('superadmin.profile-desas.create', $desa->id) }}"
                                                        class="btn btn-sm btn-primary"><i
                                                            class="las la-users"></i>{{ __('Create Profile') }}</a>
                                                    <a class="btn btn-sm btn-warning"
                                                        href="{{ route('superadmin.desas.show', $desa->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.desas.edit', $desa->id) }}"><i
                                                            class="las la-trash"></i> {{ __('Edit') }}</a>
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
                        @include('layouts.pagination', ['paginator' => $desas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
