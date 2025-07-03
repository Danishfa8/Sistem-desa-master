<div class="max-w-6xl mx-auto space-y-6">

    <!-- Ringkasan Keuangan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Keuangan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if ($data)
                <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                    <div class="text-green-700 text-sm font-medium mb-2">Pendapatan</div>
                    <div class="text-2xl font-bold text-green-800">@rupiah($totalPendapatan)</div>
                    <div class="text-green-600 text-xs mt-1">Total pendapatan desa.</div>
                </div>
            @endif

            <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                <div class="text-blue-700 text-sm font-medium mb-2">Belanja</div>
                <div class="text-2xl font-bold text-blue-800">
                    Rp.0
                </div>
                <div class="text-blue-600 text-xs mt-1">Total belanja desa.</div>
            </div>
        </div>
    </div>

    <!-- Rincian Pendapatan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Rincian Pendapatan</h2>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-700">Sumber Pendapatan</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-700">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $item->sumber_pendapatan }}</td>
                            <td class="py-3 px-4 text-right">@rupiah($item->jumlah_pendapatan)</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-8 text-gray-500 italic">
                                Belum ada data pendapatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rincian Pembelanjaan -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Rincian Pembelanjaan</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-medium text-gray-700">Jenis Belanja</th>
                        <th class="text-right py-3 px-4 font-medium text-gray-700">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="text-center py-8 text-gray-500 italic">
                            Belum ada data belanja.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
