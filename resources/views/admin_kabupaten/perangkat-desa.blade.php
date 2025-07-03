@extends('layouts.app')

@section('template_title')
    Perangkat Desa
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
                                {{ __('Perangkat Desa') }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Desa</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Foto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perangkatDesas as $perangkatDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $perangkatDesa->desa->nama_desa }}</td>
                                            <td>{{ $perangkatDesa->nama }}</td>
                                            <td>{{ $perangkatDesa->jabatan }}</td>
                                            <td><img src="{{ asset('storage/' . $perangkatDesa->foto) }}"
                                                    alt="perangkat desa"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </td>

                                            <td>

                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#showModal{{ $perangkatDesa->id }}">
                                                    <i class="las la-eye"></i> {{ __('Show') }}
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_perangkat_desa')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $perangkatDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
