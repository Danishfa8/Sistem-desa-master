@extends('layouts.app')

@section('template_title')
    Balita Desa
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
                                {{ __('Balita Desa') }}
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
                                        <th>Jumlah Balita</th>
                                        <th>Created By</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($balitaDesas as $balitaDesa)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $balitaDesa->desa->nama_desa }}</td>
                                            <td>{{ $balitaDesa->rtRwDesa->rt }}/{{ $balitaDesa->rtRwDesa->rw }}</td>
                                            <td>{{ $balitaDesa->tahun }}</td>
                                            <td>{{ $balitaDesa->jumlah_balita }}</td>
                                            <td>{{ $balitaDesa->created_by }}</td>
                                            <td>
                                                <span class="badge
                                                    @if ($balitaDesa->status === 'Approved') bg-success
                                                    @elseif ($balitaDesa->status === 'Pending') bg-warning text-dark
                                                    @elseif ($balitaDesa->status === 'Arsip') bg-secondary
                                                    @elseif ($balitaDesa->status === 'Rejected') bg-danger
                                                    @else bg-light text-dark @endif">
                                                    {{ $balitaDesa->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <x-action-buttons-kabupaten :item="$balitaDesa" route-prefix="admin_desa.balita-desa"
                                                table_name="balita_desas" status-field="status" />
                                            </td>
                                        </tr>
                                        @include('layouts.partials.modal.modal_balita')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $balitaDesas])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
