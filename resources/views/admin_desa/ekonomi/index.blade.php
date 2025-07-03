@extends('layouts.app')

@section('template_title')
    Ekonomis
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
                                {{ __('Ekonomis') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin_desa.ekonomi.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
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
                                        <th>Tahun</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Pemilik</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ekonomis as $ekonomi)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $ekonomi->desa_id }}</td>
                                            <td>{{ $ekonomi->tahun }}</td>
                                            <td>{{ $ekonomi->jenis }}</td>
                                            <td>{{ $ekonomi->nama }}</td>
                                            <td>{{ $ekonomi->pemilik }}</td>
                                            <td>{{ $ekonomi->created_by }}</td>
                                            <td>
                                                @if ($ekonomi->status == 'Arsip')
                                                    <span class="badge bg-primary">{{ $ekonomi->status }}</span>
                                                @elseif($ekonomi->status == 'Pending')
                                                    <span class="badge bg-warning">{{ $ekonomi->status }}</span>
                                                @elseif ($ekonomi->status == 'Approved')
                                                    <span class="badge bg-success">{{ $ekonomi->status }}</span>
                                                @elseif ($ekonomi->status == 'Rejected')
                                                    <span class="badge bg-danger">{{ $ekonomi->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $ekonomi->status }}</span>
                                                @endif
                                            </td>
                                            <x-action-buttons :item="$ekonomi" route-prefix="admin_desa.bumdes"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_ekonomi')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $ekonomis])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
