@extends('layouts.app')

@section('template_title')
    Olahraga Desa
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
                                {{ __('Olahraga Desa') }}
                            </span>
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
                                    <th>Jenis Olahraga</th>
                                    <th>Nama Kelompok Olahraga</th>
                                    <th>Created By</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($olahragaDesas as $olahragaDesa)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $olahragaDesa->desa->nama_desa }}</td>
                                        <td>{{ $olahragaDesa->rtRwDesa->rt }}/{{ $olahragaDesa->rtRwDesa->rw }}</td>
                                        <td>{{ $olahragaDesa->tahun }}</td>
                                        <td>{{ $olahragaDesa->jenis_olahraga }}</td>
                                        <td>{{ $olahragaDesa->nama_kelompok_olahraga }}</td>
                                        <td>{{ $olahragaDesa->created_by }}</td>
                                        <x-action-buttons :item="$olahragaDesa" route-prefix="admin_desa.olahraga-desa"
                                            :ajukan-route="true" status-field="status" />

                                    </tr>
                                    @include('layouts.partials.modal.modal_olahraga', [
                                        'olahragaDesa' => $olahragaDesa,
                                    ])
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @include('layouts.pagination', ['paginator' => $olahragaDesas])
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
