@extends('layouts.app')

@section('template_title')
    Data RT/RW
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
                                {{ __('Data RT/RW') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.rt-rw-desa.create') }}"
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
                                        <th>RT</th>
                                        <th>RW</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rtRwDesas as $rtRwDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $rtRwDesa->desa->nama_desa }}</td>
                                            <td>{{ $rtRwDesa->rt }}</td>
                                            <td>{{ $rtRwDesa->rw }}</td>

                                            <td>
                                                <form action="{{ route('admin_desa.rt-rw-desa.destroy', $rtRwDesa->id) }}"
                                                    method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('admin_desa.rt-rw-desa.show', $rtRwDesa->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin_desa.rt-rw-desa.edit', $rtRwDesa->id) }}"><i
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
                        @include('layouts.pagination', ['paginator' => $rtRwDesas])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
