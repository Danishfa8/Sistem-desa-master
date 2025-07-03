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
                                    @forelse ($pkkDesas as $pkkDesa)
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
                                            <x-action-buttons :item="$pkkDesa" route-prefix="admin_desa.pkk-desa"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_pkk')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
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
