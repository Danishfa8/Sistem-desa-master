@props([
    'item',
    'routePrefix' => '',
    'showRoute' => true,
    'editRoute' => true,
    'deleteRoute' => true,
])

<td>
@if ($showRoute)
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
            data-bs-target="#showModal{{ $item->id }}">
            <i class="las la-eye"></i> {{ __('Show') }}
        </button>
    @endif

    {{-- Tombol Edit --}}
    @if ($editRoute)
        <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-sm btn-success">
            <i class="fa fa-edit"></i> Edit
        </a>
    @endif

    {{-- Tombol Delete --}}
    @if ($deleteRoute)
        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
            data-bs-target="#deleteModal{{ $item->id }}">
            <i class="fa fa-trash"></i> Delete
        </button>
    @endif
</td>

{{-- Modal Delete --}}
@if ($deleteRoute)
    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route($routePrefix . '.destroy', $item->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
