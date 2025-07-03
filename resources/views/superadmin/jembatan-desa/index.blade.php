@extends('layouts.app')

@section('template_title')
    Jembatan Desa
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
                                {{ __('Jembatan Desa') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.jembatan-desa.create') }}"
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
                                        <th>Nama Jembatan</th>
                                        <th>Panjang</th>
                                        <th>Lebar</th>
                                        <th>Kondisi</th>
                                        <th>Lokasi</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jembatanDesas as $jembatanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $jembatanDesa->desa->nama_desa }}</td>
                                            <td>{{ $jembatanDesa->rtRwDesa->rt }}/{{ $jembatanDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $jembatanDesa->nama_jembatan }}</td>
                                            <td>{{ $jembatanDesa->panjang }} M</td>
                                            <td>{{ $jembatanDesa->lebar }} M</td>
                                            <td>
                                                @if ($jembatanDesa->kondisi == 'Baik')
                                                    <span class="badge bg-success">{{ $jembatanDesa->kondisi }}</span>
                                                @elseif($jembatanDesa->kondisi == 'Rusak Ringan')
                                                    <span
                                                        class="badge bg-warning text-dark">{{ $jembatanDesa->kondisi }}</span>
                                                @elseif($jembatanDesa->kondisi == 'Rusak Berat')
                                                    <span class="badge bg-danger">{{ $jembatanDesa->kondisi }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $jembatanDesa->kondisi }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $jembatanDesa->lokasi }}</td>
                                            <td>{{ $jembatanDesa->created_by }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('superadmin.jembatan-desa.destroy', $jembatanDesa->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.jembatan-desa.show', $jembatanDesa->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.jembatan-desa.edit', $jembatanDesa->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $jembatanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
