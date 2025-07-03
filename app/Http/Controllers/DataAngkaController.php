<?php

namespace App\Http\Controllers;

use App\Models\Bumde;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\JalanDesa;
use App\Models\JalanKabupatenDesa;
use App\Models\JembatanDesa;
use App\Models\KelembagaanDesa;
use App\Models\KerawananSosialDesa;
use App\Models\PkkDesa;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class DataAngkaController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        return view('web.data-angka', compact('kecamatans'));
    }

    /**
     * AJAX endpoint untuk mendapatkan data berdasarkan kategori dan tahun
     */
    public function getDataByCategory(Request $request)
    {
        try {
            $year = $request->year;
            $category = $request->category;
            $data = [];

            // Log untuk debugging
            Log::info('GetDataByCategory called with:', [
                'year' => $year,
                'category' => $category
            ]);

            switch ($category) {
                case 'kelembagaan':
                    // Tampilkan semua opsi kelembagaan yang tersedia
                    $data = [
                        [
                            'key' => 'kelembagaan',
                            'label' => 'Kelembagaan Desa'
                        ],
                        [
                            'key' => 'pkk_desas',
                            'label' => 'PKK Desa'
                        ]
                        // Uncomment if you want to add BUMDes
                        // ,[
                        //     'key' => 'bumdes',
                        //     'label' => 'BUMDes'
                        // ]
                    ];

                    // Log untuk debugging - cek apakah ada data untuk masing-masing
                    $kelembagaanCount = KelembagaanDesa::whereYear('created_at', $year)
                        ->where('status', 'Approved')
                        ->count();
                    Log::info('Kelembagaan count for year ' . $year . ':', ['count' => $kelembagaanCount]);

                    $pkkDesaCount = PkkDesa::whereYear('created_at', $year)
                        ->where('status', 'Approved')
                        ->count();
                    Log::info('PKK Desa count for year ' . $year . ':', ['count' => $pkkDesaCount]);
                    break;

                case 'sosial':
                    // Tampilkan semua opsi sosial yang tersedia
                    $data = [
                        [
                            'key' => 'kerawanan_sosial_desas',
                            'label' => 'Kerawanan Sosial Desa'
                        ]
                    ];

                    // Log untuk debugging
                    $sosialCount = KerawananSosialDesa::whereYear('created_at', $year)
                        ->where('status', 'Approved')
                        ->count();
                    Log::info('Kerawanan Sosial count for year ' . $year . ':', ['count' => $sosialCount]);
                    break;

                case 'infrastruktur':
                    // Tampilkan semua opsi infrastruktur yang tersedia
                    $data = [
                        [
                            'key' => 'jalan_desa',
                            'label' => 'Jalan Desa'
                        ],
                        [
                            'key' => 'jalan_kabupaten',
                            'label' => 'Jalan Kabupaten'
                        ],
                        [
                            'key' => 'jembatan',
                            'label' => 'Jembatan Desa'
                        ]
                    ];

                    // Log untuk debugging - cek apakah ada data untuk masing-masing
                    $jalanDesaCount = JalanDesa::whereYear('created_at', $year)
                        ->where('status', 'Approved')
                        ->count();
                    Log::info('Jalan Desa count for year ' . $year . ':', ['count' => $jalanDesaCount]);

                    $jalanKabCount = JalanKabupatenDesa::whereYear('created_at', $year)
                        ->where('status', 'Approved')
                        ->count();
                    Log::info('Jalan Kabupaten count for year ' . $year . ':', ['count' => $jalanKabCount]);

                    $jembatanCount = JembatanDesa::whereYear('created_at', $year)
                        ->where('status', 'Approved')
                        ->count();
                    Log::info('Jembatan count for year ' . $year . ':', ['count' => $jembatanCount]);
                    break;

                default:
                    $data = [];
            }

            Log::info('Final data result:', ['data' => $data]);
            return response()->json($data);
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

    /**
     * Get final result based on all filters
     */
    public function getResult(Request $request)
    {
        try {
            // Validate required parameters
            $request->validate([
                'year' => 'required',
                'category' => 'required',
                'data_type' => 'required',
                'kecamatan_id' => 'required',
                'desa_id' => 'required'
            ]);

            $year = $request->year;
            $category = $request->category;
            $data_type = $request->data_type;
            $kecamatan_id = $request->kecamatan_id;
            $desa_id = $request->desa_id;

            $result = [];

            // Log untuk debugging
            Log::info('GetResult Parameters:', [
                'year' => $year,
                'category' => $category,
                'data_type' => $data_type,
                'kecamatan_id' => $kecamatan_id,
                'desa_id' => $desa_id
            ]);

            // Determine which table to query based on data_type
            switch ($data_type) {
                case 'kelembagaan':
                    // Query berdasarkan desa_id saja dengan status approved
                    if (Schema::hasColumn('kelembagaan_desas', 'tahun')) {
                        $result = KelembagaanDesa::whereYear('tahun', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    } else {
                        $result = KelembagaanDesa::whereYear('created_at', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    }
                    break;

                case 'jalan_desa':
                    // Cek apakah tabel memiliki kecamatan_id
                    if (Schema::hasColumn('jalan_desas', 'kecamatan_id')) {
                        $result = JalanDesa::whereYear('created_at', $year)
                            ->where('kecamatan_id', $kecamatan_id)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    } else {
                        $result = JalanDesa::whereYear('created_at', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    }
                    break;

                case 'jalan_kabupaten':
                    // Cek apakah tabel memiliki kecamatan_id
                    if (Schema::hasColumn('jalan_kabupaten_desas', 'kecamatan_id')) {
                        $result = JalanKabupatenDesa::whereYear('created_at', $year)
                            ->where('kecamatan_id', $kecamatan_id)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    } else {
                        $result = JalanKabupatenDesa::whereYear('created_at', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    }
                    break;

                case 'jembatan':
                    // Cek apakah tabel memiliki kecamatan_id
                    if (Schema::hasColumn('jembatan_desas', 'kecamatan_id')) {
                        $result = JembatanDesa::whereYear('created_at', $year)
                            ->where('kecamatan_id', $kecamatan_id)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    } else {
                        $result = JembatanDesa::whereYear('created_at', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    }
                    break;

                case 'kerawanan_sosial_desas':
                    // Cek apakah tabel memiliki kecamatan_id
                    if (Schema::hasColumn('kerawanan_sosial_desas', 'kecamatan_id')) {
                        $result = KerawananSosialDesa::whereYear('created_at', $year)
                            ->where('kecamatan_id', $kecamatan_id)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    } else {
                        $result = KerawananSosialDesa::whereYear('created_at', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    }
                    break;

                case 'pkk_desas':
                    // Cek apakah tabel memiliki kecamatan_id
                    if (Schema::hasColumn('pkk_desas', 'kecamatan_id')) {
                        $result = PkkDesa::whereYear('created_at', $year)
                            ->where('kecamatan_id', $kecamatan_id)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    } else {
                        $result = PkkDesa::whereYear('created_at', $year)
                            ->where('desa_id', $desa_id)
                            ->where('status', 'Approved')
                            ->get();
                    }
                    break;


                // case 'bumdes':
                //     if (Schema::hasColumn('bumdes', 'kecamatan_id')) {
                //         $result = Bumde::whereYear('created_at', $year)
                //             ->where('kecamatan_id', $kecamatan_id)
                //             ->where('desa_id', $desa_id)
                //             ->where('status', 'Approved')
                //             ->get();
                //     } else {
                //         $result = Bumde::whereYear('created_at', $year)
                //             ->where('desa_id', $desa_id)
                //             ->where('status', 'Approved')
                //             ->get();
                //     }
                //     break;

                default:
                    throw new Exception("Unknown data type: {$data_type}");
            }

            Log::info('Query Result Count:', ['count' => $result->count()]);

            return response()->json($result);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (Exception $e) {
            Log::error('Error in getResult:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['error' => 'Error loading result: ' . $e->getMessage()], 500);
        }
    }
}
