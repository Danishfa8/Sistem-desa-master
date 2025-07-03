<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto space-y-6">

        @if ($lpmdk)
            {{-- LPMDK --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">LPMDK</h2>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Data</th>
                                <th class="text-right py-3 px-4 font-medium text-gray-700">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah
                                        Pengurus</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">{{ $lpmdk['jumlah_pengurus'] }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah
                                        Kegiatan</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">{{ $lpmdk['jumlah_kegiatan'] }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah Dana</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">@rupiah($lpmdk['jumlah_dana'])</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if ($pkk)
            {{-- PKK --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">TP PKK Desa</h2>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Data</th>
                                <th class="text-right py-3 px-4 font-medium text-gray-700">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah
                                        Pengurus</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">{{ $pkk['jumlah_pengurus'] }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah Anggota</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">{{ $pkk['jumlah_anggota'] }}</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah Buku
                                        Administrasi</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">{{ $pkk['jumlah_buku_administrasi'] }}
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah Dana</span>
                                </td>
                                <td class="py-3 px-4 text-right text-gray-900">@rupiah($pkk['jumlah_dana'])</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if ($totalBumdes > 0)
            {{-- BUMDES --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Bumdes (Badan Usaha Milik Desa)</h2>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Data</th>
                                <th class="text-center py-3 px-4 font-medium text-gray-700">Jumlah</th>
                                <th class="text-center py-3 px-4 font-medium text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    <span class="text-blue-600 cursor-pointer hover:text-blue-800">Jumlah BUMDES</span>
                                </td>
                                <td class="py-3 px-4 text-center text-gray-900">{{ $totalBumdes }}</td>
                                <td class="py-3 px-4 text-center">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
