@extends('layouts.app')

@section('template_title')
    PKK Desa
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
                                {{ __('PKK Desas') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('superadmin.pkk-desa.create') }}" class="btn btn-primary btn-sm float-right"
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
                                        <th>RT/RW</th>
                                        <th>Jumlah Pengurus</th>
                                        <th>Jumlah Anggota</th>
                                        <th>Jumlah Kegiatan</th>
                                        <th>Jumlah Buku Administrasi</th>
                                        <th>Jumlah Dana</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pkkDesas as $pkkDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $pkkDesa->desa->nama_desa }}</td>
                                            <td>{{ $pkkDesa->rtRwDesa->rt }}/{{ $pkkDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $pkkDesa->jumlah_pengurus }}</td>
                                            <td>{{ $pkkDesa->jumlah_anggota }}</td>
                                            <td>{{ $pkkDesa->jumlah_kegiatan }}</td>
                                            <td>{{ $pkkDesa->jumlah_buku_administrasi }}</td>
                                            <td>@rupiah($pkkDesa->jumlah_dana)</td>
                                            <td>{{ $pkkDesa->created_by }}</td>

                                            <td>
                                                <form action="{{ route('superadmin.pkk-desa.destroy', $pkkDesa->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('superadmin.pkk-desa.show', $pkkDesa->id) }}"><i
                                                            class="las la--eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('superadmin.pkk-desa.edit', $pkkDesa->id) }}"><i
                                                            class="las la--edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                            class="las la--trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $pkkDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
