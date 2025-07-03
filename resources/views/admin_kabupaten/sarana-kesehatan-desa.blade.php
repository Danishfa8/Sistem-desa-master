@extends('layouts.app')

@section('template_title')
    Sarana Kesehatan Desa
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
                                {{ __('Sarana Kesehatan Desa') }}
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
                                        <th>Tahun</th>
                                        <th>Jenis Sarana</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($saranaKesehatanDesas as $saranaKesehatanDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $saranaKesehatanDesa->desa->nama_desa }}</td>
                                            <td>{{ $saranaKesehatanDesa->rtRwDesa->rt }}/{{ $saranaKesehatanDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $saranaKesehatanDesa->tahun }}</td>
                                            <td>{{ $saranaKesehatanDesa->jenis_sarana }}</td>
                                            <td>{{ $saranaKesehatanDesa->created_by }}</td>
                                            <x-action-buttons :item="$saranakesehatanDesa"
                                                route-prefix="admin_desa.sarana-kesehatan-desa" :ajukan-route="true"
                                                status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_sarana_kesehatan', [
                                            'saranaKesehatanDesa' => $saranaKesehatanDesa,
                                        ])
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $saranaKesehatanDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
