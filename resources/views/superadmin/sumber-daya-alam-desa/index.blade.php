@extends('layouts.app')

@section('template_title')
    Sumber Daya Alam Desa
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
                                {{ __('Sumber Daya Alam Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.sumber-daya-alam-desa.create') }}"
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
                                        <th>Jenis Sumber Daya Alam</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sumberDayaAlamDesas as $sumberDayaAlamDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $sumberDayaAlamDesa->desa->nama_desa }}</td>
                                            <td>{{ $sumberDayaAlamDesa->rtRwDesa->rt }}/{{ $sumberDayaAlamDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $sumberDayaAlamDesa->tahun }}</td>
                                            <td>{{ $sumberDayaAlamDesa->jenis_sumber_daya_alam }}</td>
                                            <td>{{ $sumberDayaAlamDesa->created_by }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.sumber-daya-alam-desa.destroy', $sumberDayaAlamDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $sumberDayaAlamDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button> <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.sumber-daya-alam-desa.edit', $sumberDayaAlamDesa->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_sumber_daya_alam')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $sumberDayaAlamDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
