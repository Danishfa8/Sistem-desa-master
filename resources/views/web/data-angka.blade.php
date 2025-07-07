@extends('layouts.appweb2')
@section('content')

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Desa Dalam Angka</h1>

            <!-- Filter Controls - Grid yang konsisten untuk semua card bersebelahan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-5">
                <!-- Kategori -->
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Data</label>
                    <select id="category" name="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kecamatan -->
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100" disabled>
                        <option value="">Pilih Kecamatan</option>
                        @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Desa -->
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Desa</label>
                    <select id="desa" name="desa"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100" disabled>
                        <option value="">Pilih Desa</option>
                    </select>
                </div>

                <!-- Tahun -->
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select id="year" name="year"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100" disabled>
                        <option value="">Pilih Tahun</option>
                        @for ($tahun = 2020; $tahun <= now()->year; $tahun++)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endfor
                    </select>
                </div>

                <!-- Tombol Filter -->
                <div class="flex flex-col justify-end">
                    <button id="filterBtn" type="button" disabled
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Tampilkan Data
                    </button>
                </div>
            </div>

        </div>

        <!-- Loading Indicator -->
        <div id="loading" class="text-center mt-6" style="display: none;">
            <div
                class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-blue-500 bg-white transition ease-in-out duration-150 cursor-not-allowed">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Loading...
            </div>
        </div>

        <!-- Data Table -->
        <div id="result-container" class="bg-white rounded-lg shadow-sm overflow-hidden" style="display: none;">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:justify-between md:items-center gap-3">
                <!-- hadil header -->
                <div class="w-full flex flex-col justify-center items-center text-center">
                    <h2 id="table-title" class="text-xl font-bold text-gray-900">Hasil Data</h2>
                    <h1 id="table-location" class="text-blue-600 font-semibold">
                        Desa <span class="uppercase tracking-wider" id="desa-name">...</span> - Kecamatan <span class="uppercase tracking-wider" id="kecamatan-name">...</span>
                    </h1>
                    <p id="table-year" class="text-gray-500">Tahun ...</p>
                </div>

                <!-- download -->
                <div class="relative inline-block text-left self-center md:self-end">
                    <button id="downloadBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md flex items-center gap-2">
                        Download
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="downloadMenu" class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <form method="POST" action="{{ route('data.downloadPdf') }}">
                            @csrf
                            <input type="hidden" name="category_id" id="download_category_id">
                            <input type="hidden" name="desa_id" id="download_desa_id">
                            <input type="hidden" name="year" id="download_year">
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-red-700 hover:bg-gray-100">PDF</button>
                        </form>
                        <form method="POST" action="{{ route('data.downloadExcel') }}">
                            @csrf
                            <input type="hidden" name="category_id" id="download_category_id_excel">
                            <input type="hidden" name="desa_id" id="download_desa_id_excel">
                            <input type="hidden" name="year" id="download_year_excel">
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-green-700 hover:bg-gray-100">Excel</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full text-gray-800 border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr id="table-header">
                            {{-- Ajax Action --}}
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                        {{-- Ajax Action --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="relative mx-auto my-12 w-11/12 max-w-6xl bg-white rounded-lg shadow-lg">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">Detail Data</h3>
            <button onclick="closeDetail()" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border-b" id="detailTable">
                    <thead class="text-left">
                        <tr id="detailHead"></tr>
                    </thead>
                    <tbody id="detailBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <script>
    $(document).ready(function () {
        const csrfToken = '{{ csrf_token() }}';
        let categoryTable = null;

        // kategori
        $('#category').change(function () {
            const categoryId = $(this).val();
            categoryTable = categoryId;
            console.log("kategori tabel:", categoryTable);

            if (categoryId) {
                $('#kecamatan').prop('disabled', false).removeClass('bg-gray-100');
                resetDropdown('#desa');
                resetDropdown('#year');
            } else {
                resetDropdown('#kecamatan');
                resetDropdown('#desa');
                resetDropdown('#year');
            }

            disableButton();
        });

        // kecamatan
        $('#kecamatan').change(function () {
            const kecamatanId = $(this).val();
            if (!kecamatanId) {
                resetDropdown('#desa');
                resetDropdown('#year');
                disableButton();
                return;
            }

            $.ajax({
                url: '{{ route('data.getDesaByKecamatan') }}',
                type: 'POST',
                data: {
                    kecamatan_id: kecamatanId,
                    _token: csrfToken
                },
                beforeSend: function () {
                    loadingDropdown('#desa');
                },
                success: function (response) {
                    let options = '<option value="">Pilih Desa</option>';
                    $.each(response, function (i, desa) {
                        options += `<option value="${desa.id}">${desa.nama_desa}</option>`;
                    });
                    $('#desa').html(options).prop('disabled', false).removeClass('bg-gray-100');
                },
                error: function () {
                    alert('Gagal memuat desa.');
                    resetDropdown('#desa');
                }
            });

            resetDropdown('#year');
            disableButton();
        });

        // desa dipilih
        $('#desa').change(function () {
            const desaId = $(this).val();
            console.log("Selected desa:", desaId);
            if (desaId && categoryTable) {
                $.ajax({
                    url: '{{ route('data.getTahunByDesa') }}',
                    type: 'POST',
                    data: {
                        desa_id: desaId,
                        category_id: categoryTable,
                        _token: csrfToken
                    },
                    beforeSend: function () {
                        loadingDropdown('#year');
                    },
                    success: function (tahunList) {
                        let options = '<option value="">Pilih Tahun</option>';
                        $.each(tahunList, function (i, tahun) {
                            options += `<option value="${tahun}">${tahun}</option>`;
                        });
                        $('#year').html(options).prop('disabled', false).removeClass('bg-gray-100');
                    },
                    error: function () {
                        alert('Gagal memuat. Data Ditemukan');
                        resetDropdown('#year');
                    }
                });
            } else {
                resetDropdown('#year');
            }

            disableButton();
        });

        // tahun dipilih
        $('#year').change(function () {
            const year = $(this).val();
            if (year) {
                enableButton();
            } else {
                disableButton();
            }
        });

        // Tombol aktif
        $('#filterBtn').click(function () {
            const year = $('#year').val();
            const categoryId = $('#category').val();
            const kecamatanId = $('#kecamatan').val();
            const desaId = $('#desa').val();
            $.ajax({
                url: '{{ route('data.getResult') }}',
                type: 'POST',
                data: {
                    year: year,
                    category: categoryTable,
                    category_id: categoryId,
                    kecamatan_id: kecamatanId,
                    desa_id: desaId,
                    _token: csrfToken
                },
                beforeSend: function () {
                    $('#loading').show();
                    $('#result-container').hide();
                },
                success: function (response) {
                    $('#loading').hide();
                    $('#result-container').show();
                    renderResult(response);

                    // nama title h2
                    $('#table-title').text(`Hasil Data ${response.nama_kategori}`);
                    $('#desa-name').text(response.nama_desa);
                    $('#kecamatan-name').text(response.nama_kecamatan);
                    $('#table-year').text(`Tahun ${response.tahun}`);
                },
                error: function (xhr) {
                    $('#loading').hide();
                    alert(xhr.responseJSON?.error || 'Gagal memuat data');
                }
            });
            // download
            $('#download_category_id').val(categoryTable);
            $('#download_desa_id').val(desaId);
            $('#download_year').val(year);

            $('#download_category_id_excel').val(categoryTable);
            $('#download_desa_id_excel').val(desaId);
            $('#download_year_excel').val(year);
        });

        // ======= fungsi =======

        function resetDropdown(selector) {
            $(selector)
                .html('<option value="">Pilih</option>')
                .prop('disabled', true)
                .addClass('bg-gray-100')
                .val('');
        }

        function loadingDropdown(selector) {
            $(selector)
                .html('<option value="">Loading...</option>')
                .prop('disabled', true)
                .addClass('bg-gray-100');
        }

        function disableButton() {
            $('#filterBtn').prop('disabled', true).removeClass('bg-blue-500').addClass('bg-gray-400');
        }

        function enableButton() {
            $('#filterBtn').prop('disabled', false).removeClass('bg-gray-400').addClass('bg-blue-500');
        }

        function renderResult(response) {
            const data = response.data || [];
            const headerColumn = response.header_column || 'jenis_grouping';
            let header = `
                <th class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider border-b border-gray-200">No</th>
                <th class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider border-b border-gray-200">KECAMATAN</th>
                <th class="px-6 py-3 text-left text-md font-medium uppercase tracking-wider border-b border-gray-200">DESA</th>
                <th class="px-6 py-3 text-center text-md font-medium uppercase tracking-wider border-b border-gray-200">${headerColumn.replace(/_/g, ' ').toUpperCase()}</th>
                <th class="px-6 py-3 text-center text-md font-medium uppercase tracking-wider border-b border-gray-200">TOTAL</th>
            `;
            let body = '';

            if (data.length > 0) {
                data.forEach((row, i) => {
                    body += `<tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-3 text-left text-md border-b">${i + 1}</td>
                        <td class="px-6 py-3 text-left text-md border-b">${row.nama_kecamatan}</td>
                        <td class="px-6 py-3 text-left text-md border-b">${row.nama_desa}</td>
                        <td class="px-6 py-3 text-center text-md border-b">${row.jenis_grouping}</td>
                        <td class="px-6 py-3 text-center text-md text-blue-600 underline-none cursor-pointer border-b" onclick="showDetail('${row.jenis_grouping}')">${row.total}</td>
                    </tr>`;
                });
            } else {
                body = '<tr><td colspan="3">Tidak ada data</td></tr>';
            }

            $('#table-header').html(header);
            $('#table-body').html(body);
        }
    });

    // detail
    const hiddenColumns = [
    'id', 'id_kategori', 'desa_id', 'rt_rw_desa_id',
    'created_at', 'updated_at', 'created_by', 'updated_by',
    'approved_by', 'approved_at', 'reject_reason'
    ];
    const Labels = {
        nama_kecamatan: 'Kecamatan',
        nama_desa: 'Desa',
        rt: 'RT',
        rw: 'RW',
    };

    
    function showDetail(jenis) {
    const year = $('#year').val();
    const categoryId = $('#category').val();
    const desaId = $('#desa').val();

    $.ajax({
        url: '{{ route('data.getDetailResult') }}',
        type: 'POST',
        data: {
            category_id: categoryId,
            desa_id: desaId,
            year: year,
            jenis: jenis,
            _token: '{{ csrf_token() }}'
        },
        success: function (data) {
            const hiddenColumns = [
                'id', 'id_kategori', 'desa_id', 'rt_rw_desa_id',
                'created_at', 'updated_at', 'created_by', 'updated_by',
                'approved_by', 'approved_at', 'reject_reason', 'status'
            ];
            const Labels = {
                nama_kecamatan: 'Kecamatan',
                nama_desa: 'Desa',
                rt: 'RT',
                rw: 'RW',
                tahun: 'TAHUN'
            };

            if (data.length === 0) {
                $('#detailHead').html('<th colspan="10">Tidak ada data</th>');
                $('#detailBody').html('');
                $('#detailModal').removeClass('hidden');
                return;
            }

            const orderedKeys = [
                'nama_kecamatan',
                'nama_desa',
                'rt',
                'rw',
                ...Object.keys(data[0]).filter(key => 
                    !hiddenColumns.includes(key) && 
                    !['nama_kecamatan', 'nama_desa', 'rt', 'rw'].includes(key)
                )
            ];

            let headers = '<th class="px-3 py-2 border-b">No</th>';
            let rows = '';

            orderedKeys.forEach(key => {
                headers += `<th class="px-3 py-2 border-b">${Labels[key] || key.replace(/_/g, ' ').toUpperCase()}</th>`;
            });

            data.forEach((row, index) => {
                let cols = `<td class="px-3 py-2 border-b">${index + 1}</td>`;
                orderedKeys.forEach(key => {
                    cols += `<td class="px-3 py-2 border-b">${row[key] ?? '-'}</td>`;
                });
                rows += `<tr>${cols}</tr>`;
            });

            $('#detailHead').html(headers);
            $('#detailBody').html(rows);
            $('#detailModal').removeClass('hidden');
        },
        error: function () {
            alert('Gagal mengambil detail');
        }
    });
}
function closeDetail() {
    $('#detailModal').addClass('hidden');
}
// menu download
$('#downloadBtn').on('click', function (e) {
    e.stopPropagation();
    $('#downloadMenu').toggleClass('hidden');
});

// menu diluar
$(document).on('click', function (e) {
    if (!$(e.target).closest('#downloadBtn').length && !$(e.target).closest('#downloadMenu').length) {
        $('#downloadMenu').addClass('hidden');
    }
});
</script>
    @endsection