@extends('layouts.app')

@section('template_title')
    Balita Desa
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
                                {{ __('Balita Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.balita-desa.create') }}"
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
                                        <th>Jenis Balita</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($balitaDesas as $balitaDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $balitaDesa->desa->nama_desa }}</td>
                                            <td>{{ $balitaDesa->rtRwDesa->rt }}/{{ $balitaDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $balitaDesa->tahun }}</td>
                                            <td>{{ $balitaDesa->jenis_balita }}</td>
                                            <td>{{ $balitaDesa->created_by }}</td>
                                            <x-action-buttons :item="$balitaDesa" route-prefix="admin_desa.balita-desa"
                                                :ajukan-route="true" status-field="status" />
                                        </tr>
                                        @include('layouts.partials.modal.modal_balita')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $balitaDesas])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
