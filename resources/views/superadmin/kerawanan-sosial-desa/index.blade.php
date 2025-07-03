@extends('layouts.app')

@section('template_title')
    Kerawanan Sosial Desa
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
                                {{ __('Kerawanan Sosial Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.kerawanan-sosial-desa.create') }}"
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
                                        <th>Jenis Kerawanan</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kerawananSosialDesas as $kerawananSosialDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $kerawananSosialDesa->desa->nama_desa }}</td>
                                            <td>{{ $kerawananSosialDesa->rtRwDesa->rt }}/{{ $kerawananSosialDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $kerawananSosialDesa->tahun }}</td>
                                            <td>{{ $kerawananSosialDesa->jenis_kerawanan }}</td>
                                            <td>{{ $kerawananSosialDesa->created_by }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('superadmin.kerawanan-sosial-desa.destroy', $kerawananSosialDesa->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.kerawanan-sosial-desa.show', $kerawananSosialDesa->id) }}"><i
                                                            class="las-la-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.kerawanan-sosial-desa.edit', $kerawananSosialDesa->id) }}"><i
                                                            class="las-la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las-la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $kerawananSosialDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
