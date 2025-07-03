@extends('layouts.app')

@section('template_title')
    Bumdes
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
                                {{ __('Bumdes') }}
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
                                        <th>Nama Bumdes</th>
                                        <th>Deskripsi</th>
                                        <th>Created By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bumdes as $bumde)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $bumde->desa->nama_desa }}</td>
                                            <td>{{ $bumde->rtRwDesa->rt }}/{{ $bumde->rtRwDesa->rw }}</td>
                                            <td>{{ $bumde->nama_bumdes }}</td>
                                            <td>{{ $bumde->deskripsi }}</td>
                                            <td>{{ $bumde->created_by }}</td>
                                            <x-action-buttons :item="$bumde" route-prefix="admin_desa.bumdes"
                                                :ajukan-route="true" status-field="status" />
                                        </tr>
                                        @include('layouts.partials.modal.modal_bumdes')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum Ada Data Yang Diajukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @include('layouts.pagination', ['paginator' => $bumdes])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
