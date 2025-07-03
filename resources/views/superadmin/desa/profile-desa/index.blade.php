@extends('layouts.app')

@section('template_title')
    Profile Desas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Profile Desas') }}
                            </span>

                            {{-- <div class="float-right">
                                <a href="{{ route('superadmin.profile-desa.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Desa Id</th>
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

                                            <td>{{ $profileDesa->desa->nama_desa }}</td>
                                            <td>{{ $profileDesa->visi }}</td>
                                            <td>{{ $profileDesa->misi }}</td>
                                            <td>{{ $profileDesa->program_unggulan }}</td>
                                            <td>{{ $profileDesa->batas_wilayah }}</td>
                                            <td>{{ $profileDesa->alamat }}</td>
                                            <td>{{ $profileDesa->telepon }}</td>
                                            <td>{{ $profileDesa->foto }}</td>

                                            {{-- <td>
                                                <form
                                                    action="{{ route('superadmin.profile-desa.destroy', $profileDesa->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.profile-desa.show', $profileDesa->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.profile-desa.edit', $profileDesa->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $profileDesas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
