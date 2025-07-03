@extends('layouts.appweb2')
@section('content')

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Desa Dalam Angka</h1>

                <!-- Filter Controls - Grid yang konsisten untuk semua card bersebelahan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                    <!-- Tahun -->
                    <div class="flex flex-col">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select id="year" name="year"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih Tahun</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div class="flex flex-col">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="category" name="category"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih Kategori</option>
                            <option value="kelembagaan">Kelembagaan</option>
                            <option value="infrastruktur">Infrastruktur</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>

                    <!-- Data -->
                    <div class="flex flex-col">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Data</label>
                        <select id="data_type" name="data_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100"
                            disabled>
                            <option value="">Pilih Data</option>
                        </select>
                    </div>

                    <!-- Kecamatan -->
                    <div class="flex flex-col">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-100"
                            disabled>
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="flex flex-col justify-end">
                        <button id="filterBtn" type="button"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500">
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
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 id="table-title" class="text-lg font-semibold text-gray-800">
                        Hasil Data
                    </h2>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Download
                    </button>
                </div>  

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full">
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

        <script>
            $(document).ready(function() {
                // CSRF Token diatur langsung di JavaScript
                const csrfToken = '{{ csrf_token() }}';

                // Event handler untuk perubahan tahun dan kategori
                $('#year, #category').change(function() {
                    var year = $('#year').val();
                    var category = $('#category').val();

                    console.log('Year/Category changed:', {
                        year: year,
                        category: category
                    });

                    if (year && category) {
                        loadDataByCategory(year, category);
                    } else {
                        resetDataDropdown();
                    }
                });

                // Event handler untuk perubahan kecamatan
                $('#kecamatan').change(function() {
                    var kecamatan_id = $(this).val();

                    if (kecamatan_id) {
                        loadDesaByKecamatan(kecamatan_id);
                    } else {
                        resetDesaDropdown();
                    }

                    checkFilterButton();
                });

                // Event handler untuk perubahan desa dan data_type
                $('#desa, #data_type').change(function() {
                    checkFilterButton();
                });

                // Event handler untuk tombol filter
                $('#filterBtn').click(function() {
                    var year = $('#year').val();
                    var category = $('#category').val();
                    var data_type = $('#data_type').val();
                    var kecamatan_id = $('#kecamatan').val();
                    var desa_id = $('#desa').val();

                    if (year && category && data_type && kecamatan_id && desa_id) {
                        loadResult(year, category, data_type, kecamatan_id, desa_id);
                    }
                });

                // Fungsi untuk load data berdasarkan kategori
                function loadDataByCategory(year, category) {
                    console.log('Loading data by category:', {
                        year: year,
                        category: category
                    });

                    $.ajax({
                        url: '{{ route('data.getByCategory') }}',
                        type: 'POST',
                        data: {
                            year: year,
                            category: category,
                            _token: csrfToken
                        },
                        beforeSend: function() {
                            $('#data_type').html('<option value="">Loading...</option>').prop('disabled',
                                    true)
                                .removeClass('bg-white').addClass('bg-gray-100');
                        },
                        success: function(response) {
                            console.log('Response from getByCategory:', response);

                            var options = '<option value="">Pilih Data</option>';

                            // Loop through response array
                            if (Array.isArray(response) && response.length > 0) {
                                $.each(response, function(index, item) {
                                    options += '<option value="' + item.key + '">' + item.label +
                                        '</option>';
                                });
                            } else {
                                console.log('No data found for this category/year');
                                options +=
                                    '<option value="" disabled>Tidak ada data untuk tahun ini</option>';
                            }

                            $('#data_type').html(options).prop('disabled', false)
                                .removeClass('bg-gray-100').addClass('bg-white');
                            checkFilterButton();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading data:', {
                                status: status,
                                error: error,
                                responseText: xhr.responseText
                            });

                            var errorMessage = 'Error loading data';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }

                            alert(errorMessage);
                            resetDataDropdown();
                        }
                    });
                }

                // Fungsi untuk load desa berdasarkan kecamatan
                function loadDesaByKecamatan(kecamatan_id) {
                    $.ajax({
                        url: '{{ route('data.getDesaByKecamatan') }}',
                        type: 'POST',
                        data: {
                            kecamatan_id: kecamatan_id,
                            _token: csrfToken
                        },
                        beforeSend: function() {
                            $('#desa').html('<option value="">Loading...</option>').prop('disabled', true)
                                .removeClass('bg-white').addClass('bg-gray-100');
                        },
                        success: function(response) {
                            var options = '<option value="">Pilih Desa</option>';

                            if (response.length > 0) {
                                $.each(response, function(index, desa) {
                                    options += '<option value="' + desa.id + '">' + desa.nama_desa +
                                        '</option>';
                                });
                            }

                            $('#desa').html(options).prop('disabled', false)
                                .removeClass('bg-gray-100').addClass('bg-white');
                            checkFilterButton();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading desa:', error);
                            alert('Error loading desa');
                            resetDesaDropdown();
                        }
                    });
                }

                // Fungsi untuk load hasil akhir
                function loadResult(year, category, data_type, kecamatan_id, desa_id) {
                    $('#loading').show();
                    $('#result-container').hide();

                    console.log('Loading result with params:', {
                        year: year,
                        category: category,
                        data_type: data_type,
                        kecamatan_id: kecamatan_id,
                        desa_id: desa_id
                    });

                    $.ajax({
                        url: '{{ route('data.getResult') }}',
                        type: 'POST',
                        data: {
                            year: year,
                            category: category,
                            data_type: data_type,
                            kecamatan_id: kecamatan_id,
                            desa_id: desa_id,
                            _token: csrfToken
                        },
                        success: function(response) {
                            console.log('Result response:', response);

                            // Update title dengan informasi yang dipilih
                            var selectedKecamatan = $('#kecamatan option:selected').text();
                            var selectedDesa = $('#desa option:selected').text();
                            var selectedDataType = $('#data_type option:selected').text();
                            var title = selectedDataType + ' di Desa ' + selectedDesa + ' Kecamatan ' +
                                selectedKecamatan + ', Tahun ' + year;
                            $('#table-title').text(title);

                            displayResult(response, data_type);
                            $('#loading').hide();
                            $('#result-container').show();
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error Details:', {
                                status: status,
                                error: error,
                                responseText: xhr.responseText,
                                statusCode: xhr.status
                            });

                            let errorMessage = 'Error loading result';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            } else if (xhr.responseText) {
                                try {
                                    const errorResponse = JSON.parse(xhr.responseText);
                                    errorMessage = errorResponse.error || errorMessage;
                                } catch (e) {
                                    errorMessage += ': ' + xhr.responseText.substring(0, 100);
                                }
                            }

                            alert(errorMessage);
                            $('#loading').hide();
                        }
                    });
                }

                // Fungsi untuk menampilkan hasil
                function displayResult(data, data_type) {
                    var tableHeader =
                        '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">No</th>';
                    var tableBody = '';

                    if (data.length > 0) {
                        // Generate header dari keys object pertama
                        var firstItem = data[0];
                        for (var key in firstItem) {
                            if (key !== 'id' && key !== 'created_at' && key !== 'updated_at' &&
                                key !== 'kecamatan_id' && key !== 'desa_id') {
                                // Format header dengan capitalization
                                var headerText = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                                tableHeader +=
                                    '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">' +
                                    headerText + '</th>';
                            }
                        }

                        // Generate body
                        $.each(data, function(index, item) {
                            tableBody += '<tr class="hover:bg-gray-50">';
                            tableBody += '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' + (
                                index + 1) + '</td>';

                            for (var key in item) {
                                if (key !== 'id' && key !== 'created_at' && key !== 'updated_at' &&
                                    key !== 'kecamatan_id' && key !== 'desa_id') {
                                    var cellClass = 'px-6 py-4 whitespace-nowrap text-sm text-gray-900';
                                    if (typeof item[key] === 'number') {
                                        cellClass += ' text-center';
                                    }
                                    tableBody += '<td class="' + cellClass + '">' + (item[key] || '-') +
                                        '</td>';
                                }
                            }

                            tableBody += '</tr>';
                        });
                    } else {
                        tableBody =
                            '<tr><td colspan="100%" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data ditemukan</td></tr>';
                    }

                    $('#table-header').html(tableHeader);
                    $('#table-body').html(tableBody);
                }

                // Fungsi untuk reset dropdown data
                function resetDataDropdown() {
                    $('#data_type').html('<option value="">Pilih Data</option>').prop('disabled', true)
                        .removeClass('bg-white').addClass('bg-gray-100');
                    checkFilterButton();
                }

                // Fungsi untuk reset dropdown desa
                function resetDesaDropdown() {
                    $('#desa').html('<option value="">Pilih Desa</option>').prop('disabled', true)
                        .removeClass('bg-white').addClass('bg-gray-100');
                    checkFilterButton();
                }

                // Fungsi untuk mengecek apakah tombol filter bisa diaktifkan
                function checkFilterButton() {
                    var year = $('#year').val();
                    var category = $('#category').val();
                    var data_type = $('#data_type').val();
                    var kecamatan = $('#kecamatan').val();
                    var desa = $('#desa').val();

                    if (year && category && data_type && kecamatan && desa) {
                        $('#filterBtn').prop('disabled', false).removeClass('bg-gray-400').addClass(
                            'bg-green-600 hover:bg-green-700');
                    } else {
                        $('#filterBtn').prop('disabled', true).removeClass('bg-green-600 hover:bg-green-700').addClass(
                            'bg-gray-400');
                    }
                }

                // Download button functionality
                $('.bg-blue-600').click(function() {
                    var $btn = $(this);
                    var originalText = $btn.text();

                    $btn.text('Downloading...');
                    setTimeout(() => {
                        $btn.text(originalText);
                        alert('Data berhasil didownload!');
                    }, 1000);
                });
            });
        </script>
    @endsection
