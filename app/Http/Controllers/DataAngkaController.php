<?php

namespace App\Http\Controllers;

use App\Models\Bumde;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Ekonomi;
use App\Models\EnergiDesa;
use App\Models\IndustriPenghasilLimbahDesa;
use App\Models\JalanDesa;
use App\Models\JalanKabupatenDesa;
use App\Models\JembatanDesa;
use App\Models\Kategori;
use App\Models\Kebudayaan;
use App\Models\KelembagaanDesa;
use App\Models\KerawananSosialDesa;
use App\Models\KondisiLingkunganKeluargaDesa;
use App\Models\OlahragaDesa;
use App\Models\PkkDesa;
use App\Models\ProdukUnggulan;
use App\Models\SaranaKesehatanDesa;
use App\Models\SaranaLainyaDesa;
use App\Models\SaranaPendukungKesehatanDesa;
use App\Models\SumberDayaAlamDesa;
use App\Models\TempatTinggalDesa;
use App\Models\Transportasi;
use App\Models\UsahaEkonomi;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FilteredExport;
use Barryvdh\DomPDF\Facade\Pdf;

class DataAngkaController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        $kategoris = Kategori::all();
        return view('web.data-angka', compact('kecamatans', 'kategoris'));
    }

    /**
     * AJAX endpoint untuk mendapatkan data berdasarkan kategori dan kolom tahun di semua tabel
     */
    public function getDataByCategory(Request $request)
    {
        try {
            $year = $request->year;
            $category = $request->category;
            $data = [];

            if (!$year || !$category) {
                return response()->json([], 200);
            }

            // return response()->json($data);
        } catch (Exception $e) {
            Log::error('Error in getDataByCategory:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Error loading data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get desa by kecamatan
     */
    public function getDesaByKecamatan(Request $request)
    {
        try {
            $kecamatan_id = $request->kecamatan_id;

            $desas = Desa::where('kecamatan_id', $kecamatan_id)
                ->select('id', 'nama_desa')
                ->get();

            return response()->json($desas);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error loading desa: ' . $e->getMessage()], 500);
        }
    }
    public function getTahunByDesa(Request $request)
    {
        try {
            $desa_id = $request->desa_id;
            $category_id = $request->category_id;

            if (!$desa_id || !$category_id) {
                return response()->json([], 200);
            }

            // Mapping kategori ID ke model
            $mapKategoriModel = [
                1 => \App\Models\KelembagaanDesa::class,
                3 => \App\Models\KerawananSosialDesa::class,
                4 => SaranaLainyaDesa::class,
                5 => TempatTinggalDesa::class,
                6 => SumberDayaAlamDesa::class,
                7 => EnergiDesa::class,
                8 => OlahragaDesa::class,
                9 => Ekonomi::class,
                10 => SaranaPendukungKesehatanDesa::class,
                11 => SaranaKesehatanDesa::class,
                12 => Transportasi::class,
                13 => UsahaEkonomi::class,
                14 => ProdukUnggulan::class,
                15 => Kebudayaan::class,
                16 => IndustriPenghasilLimbahDesa::class,
                17 => KondisiLingkunganKeluargaDesa::class,
            ];

            if (!isset($mapKategoriModel[$category_id])) {
                return response()->json(['error' => 'Kategori tidak dikenali'], 400);
            }

            $model = $mapKategoriModel[$category_id];
            $tahunList = $model::where('desa_id', $desa_id)
                ->where('id_kategori', $category_id)
                ->distinct()
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');

            return response()->json($tahunList);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil tahun: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get final result based on all filters
     */
    public function getResult(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'year' => 'required',
                'category_id' => 'required',
                'kecamatan_id' => 'required',
                'desa_id' => 'required'
            ]);

            $desa_id = $request->desa_id;
            $kecamatan_id = $request->kecamatan_id;
            $year = $request->year;
            $category_id = $request->category_id;
            $desaId = $request->desa_id;

            // Mapping kategori ke model dan konfigurasi kolom
            $mapping = [
                1 => [ // ID kategori kelembagaan
                    'model' => \App\Models\KelembagaanDesa::class,
                    'columns' => ['jenis_kelembagaan'],
                    'groupBy' => ['jenis_kelembagaan'],
                    'filter_kategori' => true,
                ],
                3 => [ // ID kategori kerawanan sosial
                    'model' => \App\Models\KerawananSosialDesa::class,
                    'columns' => ['jenis_kerawanan'],
                    'groupBy' => ['jenis_kerawanan'],
                    'filter_kategori' => true,
                ],
                4 => [ 
                    'model' => \App\Models\SaranaLainyaDesa::class,
                    'columns' => ['jenis_sarana_lainnya'],
                    'groupBy' => ['jenis_sarana_lainnya'],
                    'filter_kategori' => true,
                ],
                5 => [
                    'model' => \App\Models\TempatTinggalDesa::class,
                    'columns' => ['jenis_tempat_tinggal'],
                    'groupBy' => ['jenis_tempat_tinggal'],
                    'filter_kategori' => true,
                ],
                6 => [
                    'model' => \App\Models\SumberDayaAlamDesa::class,
                    'columns' => ['jenis_sumber_daya_alam'],
                    'groupBy' => ['jenis_sumber_daya_alam'],
                    'filter_kategori' => true,
                ],
                7 => [
                    'model' => \App\Models\EnergiDesa::class,
                    'columns' => ['jenis_energi'],
                    'groupBy' => ['jenis_energi'],
                    'filter_kategori' => true,
                ],
                8 => [
                    'model' => \App\Models\OlahragaDesa::class,
                    'columns' => ['jenis_olahraga'],
                    'groupBy' => ['jenis_olahraga'],
                    'filter_kategori' => true,
                ],
                9 => [
                    'model' => \App\Models\Ekonomi::class,
                    'columns' => ['jenis'],
                    'groupBy' => ['jenis'],
                    'filter_kategori' => true,
                ],
                10 => [
                    'model' => \App\Models\SaranaPendukungKesehatanDesa::class,
                    'columns' => ['jenis_sarana'],
                    'groupBy' => ['jenis_sarana'],
                    'filter_kategori' => true,
                ],
                11 => [
                    'model' => \App\Models\SaranaKesehatanDesa::class,
                    'columns' => ['jenis_sarana'],
                    'groupBy' => ['jenis_sarana'],
                    'filter_kategori' => true,
                ],
                12 => [
                    'model' => \App\Models\Transportasi::class,
                    'columns' => ['jenis_transportasi'],
                    'groupBy' => ['jenis_transportasi'],
                    'filter_kategori' => true,
                ],
                13 => [
                    'model' => \App\Models\UsahaEkonomi::class,
                    'columns' => ['nama_usaha'],
                    'groupBy' => ['nama_usaha'],
                    'filter_kategori' => true,
                ],
                14 => [
                    'model' => \App\Models\ProdukUnggulan::class,
                    'columns' => ['jenis_produk'],
                    'groupBy' => ['jenis_produk'],
                    'filter_kategori' => true,
                ],
                15 => [
                    'model' => \App\Models\Kebudayaan::class,
                    'columns' => ['jenis_kebudayaan'],
                    'groupBy' => ['jenis_kebudayaan'],
                    'filter_kategori' => true,
                ],
                16 => [
                    'model' => \App\Models\IndustriPenghasilLimbahDesa::class,
                    'columns' => ['jenis_industri'],
                    'groupBy' => ['jenis_industri'],
                    'filter_kategori' => true,
                ],
                17 => [
                    'model' => \App\Models\KondisiLingkunganKeluargaDesa::class,
                    'columns' => ['jenis_kondisi'],
                    'groupBy' => ['jenis_kondisi'],
                    'filter_kategori' => true,
                ],
            ];

            if (!isset($mapping[$category_id])) {
                return response()->json(['error' => 'Kategori tidak dikenali'], 400);
            }

            $config = $mapping[$category_id];
            $model = $config['model'];
            $columns = $config['columns'];
            $groupBys = $config['groupBy'];
            $groupingKey = $columns[0];
            
            $table = (new $model)->getTable();
            $query = $model::query()
                ->selectRaw("$groupingKey as jenis_grouping, COUNT(*) as total")
                ->addSelect('desas.nama_desa', 'kecamatans.nama_kecamatan')
                ->join('desas', 'desas.id', '=', "$table.desa_id")
                ->join('kecamatans', 'kecamatans.id', '=', 'desas.kecamatan_id')
                ->where('tahun', $year)
                ->where("$table.desa_id", $desaId);

            if ($config['filter_kategori'] && Schema::hasColumn($table, 'id_kategori')) {
                $query->where('id_kategori', $category_id);
            }

            $query->groupBy($groupingKey, 'desas.nama_desa', 'kecamatans.nama_kecamatan');

            $data = $query->get();

            $kategori = Kategori::find($category_id);
            $desa = Desa::find($desa_id);
            $kecamatan = Kecamatan::find($kecamatan_id);

            return response()->json([
                'data' => $data,
                'header_column' => $columns[0],
                'show_location' => true,
                'nama_kategori' => $kategori->nama ?? '-',
                'nama_desa' => $desa->nama_desa ?? '-',
                'nama_kecamatan' => $kecamatan->nama_kecamatan ?? '-',
                'tahun' => $year,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validasi gagal', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data desa dalam angka', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
    }

    public function detailResult(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'desa_id' => 'required',
            'year' => 'required',
            'jenis' => 'required',
        ]);

        $category_id = $request->category_id;
        $desa_id = $request->desa_id;
        $year = $request->year;
        $jenis = $request->jenis;

        $mapping = [
                    1 => [ // ID kategori kelembagaan
                        'model' => \App\Models\KelembagaanDesa::class,
                        'columns' => ['jenis_kelembagaan', 'nama_kelembagaan'],
                        'groupBy' => ['jenis_kelembagaan', 'nama_kelembagaan'],
                        'filter_kategori' => true,
                    ],
                    3 => [ // ID kategori kerawanan sosial
                        'model' => \App\Models\KerawananSosialDesa::class,
                        'columns' => ['jenis_kerawanan'],
                        'groupBy' => ['jenis_kerawanan'],
                        'filter_kategori' => true,
                    ],
                    4 => [ 
                        'model' => \App\Models\SaranaLainyaDesa::class,
                        'columns' => ['jenis_sarana_lainnya','nama_sarana_lainnya'],
                        'groupBy' => ['jenis_sarana_lainnya','nama_sarana_lainnya'],
                        'filter_kategori' => true,
                    ],
                    5 => [
                        'model' => \App\Models\TempatTinggalDesa::class,
                        'columns' => ['jenis_tempat_tinggal'],
                        'groupBy' => ['jenis_tempat_tinggal'],
                        'filter_kategori' => true,
                    ],
                    6 => [
                        'model' => \App\Models\SumberDayaAlamDesa::class,
                        'columns' => ['jenis_sumber_daya_alam'],
                        'groupBy' => ['jenis_sumber_daya_alam'],
                        'filter_kategori' => true,
                    ],
                    7 => [
                        'model' => \App\Models\EnergiDesa::class,
                        'columns' => ['jenis_energi'],
                        'groupBy' => ['jenis_energi'],
                        'filter_kategori' => true,
                    ],
                    8 => [
                        'model' => \App\Models\OlahragaDesa::class,
                        'columns' => ['jenis_olahraga','nama_kelompok_olahraga'],
                        'groupBy' => ['jenis_olahraga','nama_kelompok_olahraga'],
                        'filter_kategori' => true,
                    ],
                    9 => [
                        'model' => \App\Models\Ekonomi::class,
                        'columns' => ['jenis','nama','pemilik'],
                        'groupBy' => ['jenis','nama','pemilik'],
                        'filter_kategori' => true,
                    ],
                    10 => [
                        'model' => \App\Models\SaranaPendukungKesehatanDesa::class,
                        'columns' => ['jenis_sarana'],
                        'groupBy' => ['jenis_sarana'],
                        'filter_kategori' => true,
                    ],
                    11 => [
                        'model' => \App\Models\SaranaKesehatanDesa::class,
                        'columns' => ['jenis_sarana'],
                        'groupBy' => ['jenis_sarana'],
                        'filter_kategori' => true,
                    ],
                    12 => [
                        'model' => \App\Models\Transportasi::class,
                        'columns' => ['jenis_transportasi'],
                        'groupBy' => ['jenis_transportasi'],
                        'filter_kategori' => true,
                    ],
                    13 => [
                        'model' => \App\Models\UsahaEkonomi::class,
                        'columns' => ['nama_usaha','luas'],
                        'groupBy' => ['nama_usaha','luas'],
                        'filter_kategori' => true,
                    ],
                    14 => [
                        'model' => \App\Models\ProdukUnggulan::class,
                        'columns' => ['jenis_produk','nama_produk'],
                        'groupBy' => ['jenis_produk','nama_produk'],
                        'filter_kategori' => true,
                    ],
                    15 => [
                        'model' => \App\Models\Kebudayaan::class,
                        'columns' => ['jenis_kebudayaan','nama_kebudayaan'],
                        'groupBy' => ['jenis_kebudayaan','nama_kebudayaan'],
                        'filter_kategori' => true,
                    ],
                    16 => [
                        'model' => \App\Models\IndustriPenghasilLimbahDesa::class,
                        'columns' => ['jenis_industri'],
                        'groupBy' => ['jenis_industri'],
                        'filter_kategori' => true,
                    ],
                    17 => [
                        'model' => \App\Models\KondisiLingkunganKeluargaDesa::class,
                        'columns' => ['jenis_kondisi'],
                        'groupBy' => ['jenis_kondisi'],
                        'filter_kategori' => true,
                    ],
        ];

        
        if (!isset($mapping[$category_id])) {
            return response()->json(['error' => 'Kategori tidak dikenali'], 400);
        }

        $config = $mapping[$category_id];
        $model = $config['model'];
        $groupingKey = $config['columns'][0];
        $table = (new $model)->getTable();

        $data = $model::select("$table.*", 'desas.nama_desa', 'kecamatans.nama_kecamatan', 'rt_rw_desas.rt', 'rt_rw_desas.rw')
        ->join('desas', 'desas.id', '=', "$table.desa_id")
        ->join('kecamatans', 'kecamatans.id', '=', 'desas.kecamatan_id')
        ->join('rt_rw_desas', 'rt_rw_desas.id', '=', "$table.rt_rw_desa_id")
        ->where("$table.desa_id", $desa_id)
        ->where("$table.tahun", $year)
        ->where("$table.$groupingKey", $jenis);

        if ($config['filter_kategori'] && Schema::hasColumn((new $model)->getTable(), 'id_kategori')) {
            $data->where('id_kategori', $category_id);
        }

        $result = $data->get();

        return response()->json($result);
    }

    // cetak download
public function downloadPdf(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'desa_id' => 'required',
        'year' => 'required',
    ]);

    $data = $this->getFilteredData($request);
    $categoryName = self::$categoryLabels[$request->category_id] ?? 'kategori';

    $pdf = PDF::loadView('exports.filtered_pdf', [
        'data' => $data,
        'categoryName' => $categoryName
    ]);

    return $pdf->download('data-' . strtolower(str_replace(' ', '-', $categoryName)) . '.pdf');
}

public function downloadExcel(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'desa_id' => 'required',
        'year' => 'required',
    ]);

    $categoryName = self::$categoryLabels[$request->category_id] ?? 'kategori';

    return Excel::download(
        new FilteredExport($request, $categoryName),
        'data-' . strtolower(str_replace(' ', '-', $categoryName)) . '.xlsx'
    );
}


// filter download
public function getFilteredData($request)
{
    $category_id = $request->category_id;
    $desa_id = $request->desa_id;
    $year = $request->year;

    $mapping = [
                    1 => [ // ID kategori kelembagaan
                        'model' => \App\Models\KelembagaanDesa::class,
                        'columns' => ['jenis_kelembagaan', 'nama_kelembagaan'],
                        'groupBy' => ['jenis_kelembagaan', 'nama_kelembagaan'],
                        'filter_kategori' => true,
                    ],
                    3 => [ // ID kategori kerawanan sosial
                        'model' => \App\Models\KerawananSosialDesa::class,
                        'columns' => ['jenis_kerawanan'],
                        'groupBy' => ['jenis_kerawanan'],
                        'filter_kategori' => true,
                    ],
                    4 => [ 
                        'model' => \App\Models\SaranaLainyaDesa::class,
                        'columns' => ['jenis_sarana_lainnya','nama_sarana_lainnya'],
                        'groupBy' => ['jenis_sarana_lainnya','nama_sarana_lainnya'],
                        'filter_kategori' => true,
                    ],
                    5 => [
                        'model' => \App\Models\TempatTinggalDesa::class,
                        'columns' => ['jenis_tempat_tinggal'],
                        'groupBy' => ['jenis_tempat_tinggal'],
                        'filter_kategori' => true,
                    ],
                    6 => [
                        'model' => \App\Models\SumberDayaAlamDesa::class,
                        'columns' => ['jenis_sumber_daya_alam'],
                        'groupBy' => ['jenis_sumber_daya_alam'],
                        'filter_kategori' => true,
                    ],
                    7 => [
                        'model' => \App\Models\EnergiDesa::class,
                        'columns' => ['jenis_energi'],
                        'groupBy' => ['jenis_energi'],
                        'filter_kategori' => true,
                    ],
                    8 => [
                        'model' => \App\Models\OlahragaDesa::class,
                        'columns' => ['jenis_olahraga','nama_kelompok_olahraga'],
                        'groupBy' => ['jenis_olahraga','nama_kelompok_olahraga'],
                        'filter_kategori' => true,
                    ],
                    9 => [
                        'model' => \App\Models\Ekonomi::class,
                        'columns' => ['jenis','nama','pemilik'],
                        'groupBy' => ['jenis','nama','pemilik'],
                        'filter_kategori' => true,
                    ],
                    10 => [
                        'model' => \App\Models\SaranaPendukungKesehatanDesa::class,
                        'columns' => ['jenis_sarana'],
                        'groupBy' => ['jenis_sarana'],
                        'filter_kategori' => true,
                    ],
                    11 => [
                        'model' => \App\Models\SaranaKesehatanDesa::class,
                        'columns' => ['jenis_sarana'],
                        'groupBy' => ['jenis_sarana'],
                        'filter_kategori' => true,
                    ],
                    12 => [
                        'model' => \App\Models\Transportasi::class,
                        'columns' => ['jenis_transportasi'],
                        'groupBy' => ['jenis_transportasi'],
                        'filter_kategori' => true,
                    ],
                    13 => [
                        'model' => \App\Models\UsahaEkonomi::class,
                        'columns' => ['nama_usaha','luas'],
                        'groupBy' => ['nama_usaha','luas'],
                        'filter_kategori' => true,
                    ],
                    14 => [
                        'model' => \App\Models\ProdukUnggulan::class,
                        'columns' => ['jenis_produk','nama_produk'],
                        'groupBy' => ['jenis_produk','nama_produk'],
                        'filter_kategori' => true,
                    ],
                    15 => [
                        'model' => \App\Models\Kebudayaan::class,
                        'columns' => ['jenis_kebudayaan','nama_kebudayaan'],
                        'groupBy' => ['jenis_kebudayaan','nama_kebudayaan'],
                        'filter_kategori' => true,
                    ],
                    16 => [
                        'model' => \App\Models\IndustriPenghasilLimbahDesa::class,
                        'columns' => ['jenis_industri'],
                        'groupBy' => ['jenis_industri'],
                        'filter_kategori' => true,
                    ],
                    17 => [
                        'model' => \App\Models\KondisiLingkunganKeluargaDesa::class,
                        'columns' => ['jenis_kondisi'],
                        'groupBy' => ['jenis_kondisi'],
                        'filter_kategori' => true,
                    ],
    ];

    if (!isset($mapping[$category_id])) {
        abort(404, 'Kategori tidak ditemukan');
    }

    $config = $mapping[$category_id];
    $model = $config['model'];
    $groupingKey = $config['columns'][0];
    $table = (new $model)->getTable();

    $query = $model::select(
        "$table.tahun",
        'kecamatans.nama_kecamatan',
        'desas.nama_desa',
        'rt_rw_desas.rt',
        'rt_rw_desas.rw',
        "$table.$groupingKey as jenis",
        ...array_slice($config['columns'], 1)
    )
    ->join('desas', 'desas.id', '=', "$table.desa_id")
    ->join('kecamatans', 'kecamatans.id', '=', 'desas.kecamatan_id')
    ->join('rt_rw_desas', 'rt_rw_desas.id', '=', "$table.rt_rw_desa_id")
    ->where("$table.desa_id", $desa_id)
    ->where("$table.tahun", $year);

    if ($config['filter_kategori'] && Schema::hasColumn($table, 'id_kategori')) {
        $query->where('id_kategori', $category_id);
    }

    return $query->get();
}

//label kategori
protected static $categoryLabels = [
    1 => 'Kelembagaan Desa',
    3 => 'Kerawanan Sosial Desa',
    4 => 'Sarana Lainnya Desa',
    5 => 'Tempat Tinggal Desa',
    6 => 'Sumber Daya Alam Desa',
    7 => 'Energi Desa',
    8 => 'Olahraga Desa',
    9 => 'Ekonomi Desa',
    10 => 'Sarana Pendukung Kesehatan Desa',
    11 => 'Sarana Kesehatan Desa',
    12 => 'Transportasi Desa',
    13 => 'Usaha Ekonomi Desa',
    14 => 'Produk Unggulan Desa',
    15 => 'Kebudayaan Desa',
    16 => 'Industri Limbah Desa',
    17 => 'Kondisi Lingkungan Keluarga Desa',
];

}
