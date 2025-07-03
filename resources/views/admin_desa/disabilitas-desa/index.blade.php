@extends('layouts.app')

@section('template_title')
    Disabilitas Desa
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
                                {{ __('Disabilitas Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.disabilitas-desa.create') }}"
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
                                        <th>Jenis Disabilitas</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disabilitasDesas as $disabilitasDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $disabilitasDesa->desa->nama_desa }}</td>
                                            <td>{{ $disabilitasDesa->rtRwDesa->rt }}/{{ $disabilitasDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $disabilitasDesa->tahun }}</td>
                                            <td>{{ $disabilitasDesa->jenis_disabilitas }}</td>
                                            <td>{{ $disabilitasDesa->created_by }}</td>

                                            <x-action-buttons :item="$disabilitasDesa" route-prefix="admin_desa.disabilitas-desa"
                                                :ajukan-route="true" status-field="status" />
                                        </tr>
                                        @include('layouts.partials.modal.modal_disabilitas')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $disabilitasDesas])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
