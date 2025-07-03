@extends('layouts.app')

@section('template_title')
    Kecamatans
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
                                {{ __('Data Kecamatan') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.kecamatans.create') }}"
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

                                        <th>Nama Kecamatan</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kecamatans as $kecamatan)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $kecamatan->nama_kecamatan }}</td>

                                            <td>
                                                <form action="{{ route('superadmin.kecamatans.destroy', $kecamatan->id) }}"
                                                    method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.kecamatans.show', $kecamatan->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.kecamatans.edit', $kecamatan->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la-trash "></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $kecamatans])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
