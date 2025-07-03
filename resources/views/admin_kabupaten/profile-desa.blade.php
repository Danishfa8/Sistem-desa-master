@extends('layouts.app')

@section('template_title')
    Profile Desas
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
                                {{ __('Profile Desas') }}
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
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Program Unggulan</th>
                                        <th>Batas Wilayah</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Foto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($profileDesas as $profileDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $profileDesa->desa_id }}</td>
                                            <td>{{ $profileDesa->visi }}</td>
                                            <td>{{ $profileDesa->misi }}</td>
                                            <td>{{ $profileDesa->program_unggulan }}</td>
                                            <td>{{ $profileDesa->batas_wilayah }}</td>
                                            <td>{{ $profileDesa->alamat }}</td>
                                            <td>{{ $profileDesa->telepon }}</td>
                                            <td>{{ $profileDesa->foto }}</td>
                                            <td> <button type="button" class="btn btn-sm btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#showModal{{ $profileDesa->id }}">
                                                    <i class="las la-eye"></i> {{ __('Show') }}
                                                </button></td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_profile_desa')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $profileDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
