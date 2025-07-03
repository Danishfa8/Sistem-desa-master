@extends('layouts.app')

@section('template_title')
    {{ $desa->name ?? __('Show') . ' ' . __('Desa') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-animate">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Detail Desa <strong>{{ $desa->nama_desa }}</strong></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('superadmin.desas.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama Desa</th>
                                        <td>{{ $desa->nama_desa }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>{{ $desa->kecamatan->nama_kecamatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Klas</th>
                                        <td>{{ $desa->klas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stat Pem</th>
                                        <td>{{ $desa->stat_pem }}</td>
                                    </tr>
                                    <tr>
                                        <th>Latitude</th>
                                        <td>{{ $desa->latitude }}</td>
                                    </tr>
                                    <tr>
                                        <th>Longitude</th>
                                        <td>{{ $desa->longitude }}</td>
                                    </tr>
                                    <tr>
                                        <th>Update</th>
                                        <td>{{ $desa->updated_at }}</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Profile Desa --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-animate">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Profile Desa <strong>{{ $desa->nama_desa }}</strong></span>
                        </div>
                        <div class="float-right">
                            @if ($desa->profileDesa)
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('superadmin.profile-desas.edit', $desa->profileDesa->id) }}">
                                    {{ __('Edit Profile') }}</a>
                            @else
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('superadmin.profile-desas.create', $desa->id) }}">
                                    {{ __('Create Profile') }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Visi</th>
                                        <td>{{ $desa->profileDesa->visi ?? 'Belum ada visi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Misi</th>
                                        <td>{{ $desa->profileDesa->misi ?? 'Belum ada Misi' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program Unggulan</th>
                                        <td>{{ $desa->profileDesa->program_unggulan ?? 'Belum ada Program Unggulan' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Batas Wilayah</th>
                                        <td>{{ $desa->profileDesa->batas_wilayah ?? 'Belum ada Batas Wilayah' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $desa->profileDesa->alamat ?? 'Belum ada Wilayah' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telephone</th>
                                        <td>{{ $desa->profileDesa->telepon ?? 'Belum ada Telephone' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Foto</th>
                                        <td>
                                            <div class="mt-2">
                                                @if ($desa->profileDesa && $desa->profileDesa->foto)
                                                    <img src="{{ asset('storage/' . $desa->profileDesa->foto) }}"
                                                        alt="Foto Profile Desa" height="100">
                                                @else
                                                    <p>Belum ada Foto</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Update</th>
                                        <td>{{ $desa->profileDesa->updated_at ?? 'Belum ada Update' }}</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
