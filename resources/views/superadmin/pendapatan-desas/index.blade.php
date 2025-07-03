{{-- @php
    dump(session()->all());
@endphp --}}
@extends('layouts.app')

@section('template_title')
    Pendapatan Desa
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
                                {{ __('Pendapatan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.pendapatan-desas.create') }}"
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
                                        <th>Sumber Pendapatan</th>
                                        <th>Jumlah Pendapatan</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendapatanDesas as $pendapatanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $pendapatanDesa->desa->nama_desa }}</td>
                                            <td>{{ $pendapatanDesa->sumber_pendapatan }}</td>
                                            <td>@rupiah($pendapatanDesa->jumlah_pendapatan)</td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.pendapatan-desas.destroy', $pendapatanDesa->id) }}"
                                                    method="POST">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showModal{{ $pendapatanDesa->id }}">
                                                        <i class="las la-eye"></i> {{ __('Show') }}
                                                    </button>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.pendapatan-desas.edit', $pendapatanDesa->id) }}"><i
                                                            class="las la-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @include('layouts.partials.modal.modal_pendapatan')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $pendapatanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
