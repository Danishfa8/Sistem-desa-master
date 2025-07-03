@extends('layouts.app')

@section('template_title')
    Sumber Daya Alam Desa
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
                                {{ __('Sumber Daya Alam Desa') }}
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
                                        <th>Jenis Sumber Daya Alam</th>
                                        <th>Created By</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sumberDayaAlamDesas as $sumberDayaAlamDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $sumberDayaAlamDesa->desa->nama_desa }}</td>
                                            <td>{{ $sumberDayaAlamDesa->rtRwDesa->rt }}/{{ $sumberDayaAlamDesa->rtRwDesa->rw }}
                                            </td>
                                            <td>{{ $sumberDayaAlamDesa->tahun }}</td>
                                            <td>{{ $sumberDayaAlamDesa->jenis_sumber_daya_alam }}</td>
                                            <td>{{ $sumberDayaAlamDesa->created_by }}</td>
                                            <x-action-buttons :item="$sumberDayaAlamDesa"
                                                route-prefix="admin_desa.sumber-daya-alam-desa-desa" :ajukan-route="true"
                                                status-field="status" />

                                        </tr>
                                        @include('layouts.partials.modal.modal_sumber_daya_alam')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $sumberDayaAlamDesas])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
