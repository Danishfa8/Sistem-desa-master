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
                                <a href="{{ route('admin_desa.pendapatan-desas.create') }}"
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
                                            <td>{{ $pendapatanDesa->created_by }}</td>
                                            <x-action-buttons :item="$pendapatanDesa" route-prefix="admin_desa.pendapatan-desa"
                                                :ajukan-route="true" status-field="status" />
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
