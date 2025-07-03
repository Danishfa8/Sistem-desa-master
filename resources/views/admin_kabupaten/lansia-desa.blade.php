@extends('layouts.app')

@section('template_title')
    Lansia Desa
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
                                {{ __('Lansia Desa') }}
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
                                        <th>Jenis Lansia</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lansiaDesas as $lansiaDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $lansiaDesa->desa->nama_desa }}</td>
                                            <td>{{ $lansiaDesa->rtRwDesa->rt }}/{{ $lansiaDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $lansiaDesa->tahun }}</td>
                                            <td>{{ $lansiaDesa->jenis_lansia }}</td>
                                            <td>{{ $lansiaDesa->created_by }}</td>
                                            <x-action-buttons :item="$lansiaDesa" route-prefix="admin_desa.lansia-desa"
                                                :ajukan-route="true" status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_lansia')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $lansiaDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
