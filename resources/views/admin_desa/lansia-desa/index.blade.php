@extends('layouts.app')

@section('template_title')
    Lansia Desa
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
                                {{ __('Lansia Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.lansia-desa.create') }}"
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
                                        <th>Jumlah Lansia</th>
                                        <th>Created By</th>
                                        <th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lansiaDesas as $lansiaDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $lansiaDesa->desa->nama_desa }}</td>
                                            <td>{{ $lansiaDesa->rtRwDesa->rt }}/{{ $lansiaDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $lansiaDesa->tahun }}</td>
                                            <td>{{ $lansiaDesa->jumlah_lansia }}</td>
                                            <td>{{ $lansiaDesa->created_by }}</td>
                                            <td>
                                            <span class="badge
                                                @if ($lansiaDesa->status === 'Approved') bg-success
                                                @elseif ($lansiaDesa->status === 'Pending') bg-warning text-dark
                                                @elseif ($lansiaDesa->status === 'Arsip') bg-secondary
                                                @elseif ($lansiaDesa->status === 'Rejected') bg-danger
                                                @else bg-light text-dark @endif">
                                                {{ $lansiaDesa->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <x-action-buttons :item="$lansiaDesa" route-prefix="admin_desa.lansia-desa"
                                                :ajukan-route="true" status-field="status" />
                                        </td>
                                            </tr>
                                            @include('layouts.partials.modal.modal_lansia')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $lansiaDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
