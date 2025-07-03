@props([
    'item',
    'routePrefix',
    'showRoute' => true,
    'editRoute' => true,
    'deleteRoute' => true,
    'ajukanRoute' => false,
    'statusField' => 'status',
])
<td>
    {{-- Button Show --}}
    @if ($showRoute)
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
            data-bs-target="#showModal{{ $item->id }}">
            <i class="las la-eye"></i> {{ __('Show') }}
        </button>
    @endif

    {{-- Button Edit (hilang jika Pending/Approved) --}}
    @if ($editRoute && !in_array($item->{$statusField}, ['Pending', 'Approved']))
        <a class="btn btn-sm btn-success" href="{{ route($routePrefix . '.edit', $item->id) }}">
            <i class="las la-edit"></i> {{ __('Edit') }}
        </a>
    @endif

    {{-- Button Delete (hilang jika Pending/Approved) --}}
    @if ($deleteRoute && !in_array($item->{$statusField}, ['Pending', 'Approved']))
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
            data-bs-target="#deleteModal{{ $item->id }}">
            <i class="las la-trash"></i> {{ __('Delete') }}
        </button>
    @endif

    {{-- Button Ajukan --}}
    @if ($ajukanRoute && $item->{$statusField} === 'Arsip')
        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
            data-bs-target="#ajukanModal{{ $item->id }}">
            <i class="las la-paper-plane"></i> {{ __('Ajukan') }}
        </button>
    @endif
</td>

{{-- Modal Delete --}}
@if ($deleteRoute && !in_array($item->{$statusField}, ['Pending', 'Approved']))
    <div class="modal flip" id="deleteModal{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:120px;height:120px">
                    </lord-icon>

                    <div class="mt-4">
                        <h4 class="mb-3">Konfirmasi Hapus</h4>
                        <p class="text-muted mb-4">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat
                            dibatalkan.</p>
                        <div class="hstack gap-2 justify-content-center">
                            <button type="button" class="btn btn-link link-secondary fw-medium material-shadow-none"
                                data-bs-dismiss="modal">
                                <i class="ri-close-line me-1 align-middle"></i> Batal
                            </button>
                            <form action="{{ route($routePrefix . '.destroy', $item->id) }}" method="POST"
                                class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete">
                                    <i class="las la-trash me-1"></i> Ya, Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Modal Konfirmasi Pengajuan --}}
@if ($ajukanRoute && $item->{$statusField} === 'Arsip')
    @php
        $resource = str_replace(['admin_desa.', 'admin.'], '', $routePrefix);
    @endphp
    <!-- Modal Ajukan -->
    <div class="modal flip" id="ajukanModal{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="ajukanModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                        colors="primary:#121331,secondary:#ffc107" style="width:120px;height:120px">
                    </lord-icon>

                    <div class="mt-4">
                        <h4 class="mb-3">Konfirmasi Pengajuan</h4>
                        <p class="text-muted mb-4">Apakah Anda yakin ingin mengajukan data ini untuk approval? Setelah
                            diajukan, data tidak dapat diedit lagi.</p>
                        <div class="hstack gap-2 justify-content-center">
                            <button type="button" class="btn btn-link link-secondary fw-medium material-shadow-none"
                                data-bs-dismiss="modal">
                                <i class="ri-close-line me-1 align-middle"></i> Batal
                            </button>
                            <form action="{{ route('admin_desa.universal.ajukan', [$resource, $item->id]) }}"
                                method="POST" class="d-inline ajukan-form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-ajukan">
                                    <i class="las la-paper-plane me-1"></i> Ya, Ajukan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete form submission with loading state
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('.btn-delete');
                // Disable button to prevent double submit
                button.disabled = true;
                button.innerHTML = '<i class="las la-spinner la-spin me-1"></i> Processing...';
            });
        });

        // Handle ajukan form submission with loading state
        document.querySelectorAll('.ajukan-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('.btn-ajukan');
                // Disable button to prevent double submit
                button.disabled = true;
                button.innerHTML = '<i class="las la-spinner la-spin me-1"></i> Processing...';
            });
        });
    });
</script>
