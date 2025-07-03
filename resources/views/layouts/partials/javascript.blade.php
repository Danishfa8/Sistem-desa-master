<!-- jQuery (required by Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#desa_id').select2({
            placeholder: "-- Pilih Desa --",
            allowClear: true
        });

        $('#desa_id').on('change', function() {
            const desaId = $(this).val();
            $('#rt_rw_desa_id').empty().append('<option value="">Memuat...</option>');

            if (desaId) {
                $.ajax({
                    url: `/get-rt-rw/${desaId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#rt_rw_desa_id').empty().append(
                            '<option value="">-- Pilih RT/RW --</option>');

                        if (data.length === 0) {
                            $('#rt_rw_desa_id').append(
                                '<option value="">Tidak ada data RT/RW</option>');
                        } else {
                            $.each(data, function(index, item) {
                                const rtRwText = `RT ${item.rt} / RW ${item.rw}`;
                                $('#rt_rw_desa_id').append(
                                    `<option value="${item.id}">${rtRwText}</option>`
                                );
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        $('#rt_rw_desa_id').empty().append(
                            '<option value="">Gagal memuat RT/RW</option>');
                    }
                });
            } else {
                $('#rt_rw_desa_id').empty().append('<option value="">-- Pilih RT/RW --</option>');
            }
        });
    });
</script>
