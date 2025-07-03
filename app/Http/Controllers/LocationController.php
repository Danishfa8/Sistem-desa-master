<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    /**
     * Get all kecamatan data
     */
    public function getKecamatan()
    {
        try {
            // Cache for 1 hour since kecamatan data rarely changes
            $kecamatan = Cache::remember('kecamatan_list', 3600, function () {
                return Kecamatan::select('id', 'nama_kecamatan')
                    ->orderBy('nama_kecamatan')
                    ->get();
            });

            return response()->json($kecamatan);
        } catch (\Exception $e) {
            Log::error('Error getting kecamatan: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal mengambil data kecamatan',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get desa data by kecamatan ID
     */
    public function getDesa($kecamatanId)
    {
        try {
            // Validate kecamatan exists
            $kecamatan = Kecamatan::find($kecamatanId);
            if (!$kecamatan) {
                return response()->json(['error' => 'Kecamatan tidak ditemukan'], 404);
            }

            // Cache for 30 minutes
            $cacheKey = "desa_kecamatan_{$kecamatanId}";
            $desa = Cache::remember($cacheKey, 1800, function () use ($kecamatanId) {
                return Desa::where('kecamatan_id', $kecamatanId)
                    ->select('id', 'kecamatan_id', 'nama_desa', 'klas', 'stat_pem', 'latitude', 'longitude')
                    ->whereNotNull('latitude')
                    ->whereNotNull('longitude')
                    ->where('latitude', '!=', '')
                    ->where('longitude', '!=', '')
                    ->orderBy('nama_desa')
                    ->get();
            });

            return response()->json($desa);
        } catch (\Exception $e) {
            Log::error('Error getting desa: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal mengambil data desa',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get kategori data by desa ID with improved error handling
     */
    public function getKategoriDataByDesa($desa_id)
    {
        try {
            // Validasi desa exists
            $desa = Desa::find($desa_id);
            if (!$desa) {
                return response()->json(['error' => 'Desa tidak ditemukan'], 404);
            }

            // Cache key for this desa's kategori data
            $cacheKey = "kategori_desa_{$desa_id}";

            $kategoriData = Cache::remember($cacheKey, 900, function () use ($desa) {
                return $this->loadKategoriData($desa);
            });

            // Transform data untuk frontend
            $transformedData = $this->transformKategoriDataForFrontend($kategoriData);

            return response()->json([
                'success' => true,
                'data' => $transformedData,
                'raw_data' => $kategoriData, // For debugging
                'meta' => [
                    'desa_id' => $desa_id,
                    'desa_name' => $desa->nama_desa,
                    'total_categories' => count($kategoriData),
                    'total_items' => array_sum(array_map('count', $kategoriData))
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting kategori data for desa ' . $desa_id . ': ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'error' => 'Gagal mengambil data kategori',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Transform kategori data for frontend consumption
     */
    private function transformKategoriDataForFrontend($kategoriData)
    {
        $transformed = [];
        $globalId = 1;

        foreach ($kategoriData as $kategoriName => $items) {
            foreach ($items as $item) {
                // Determine the appropriate name field based on category
                $nama = $this->determineItemName($item, $kategoriName);
                $alamat = $this->determineItemAddress($item, $kategoriName);

                $transformed[] = [
                    'id' => $globalId++,
                    'nama' => $nama,
                    'tipe' => $kategoriName,
                    'alamat' => $alamat,
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                    'desa_id' => $item['desa_id'],
                    'original_id' => $item['id'],
                    'raw_data' => $item
                ];
            }
        }

        return $transformed;
    }

    /**
     * Determine item name based on category type
     */
    private function determineItemName($item, $kategoriName)
    {
        $nameFields = [
            'Jalan Desa' => 'nama_jalan',
            'Jalan Kabupaten' => 'nama_jalan',
            'Jembatan' => 'nama_jembatan',
            'Pendidikan' => 'jenis_pendidikan',
            'Sarana Ibadah' => 'jenis_sarana_ibadah',
            'Irigasi' => 'nama_irigasi',
            'Pasar' => 'nama_pasar',
            'Pembuangan Sampah' => 'nama_tps',
            'Pusat Perdagangan' => 'nama_pusat',
            'Rumah Potong Hewan' => 'nama_rph'
        ];

        $field = $nameFields[$kategoriName] ?? 'nama';
        return $item[$field] ?? $kategoriName;
    }

    /**
     * Determine item address based on category type
     */
    private function determineItemAddress($item, $kategoriName)
    {
        $addressFields = [
            'Jalan Desa' => 'lokasi',
            'Jalan Kabupaten' => 'lokasi',
            'Jembatan' => 'lokasi',
            'Pendidikan' => 'alamat',
            'Sarana Ibadah' => 'alamat',
            'Irigasi' => 'lokasi',
            'Pasar' => 'alamat',
            'Pembuangan Sampah' => 'lokasi',
            'Pusat Perdagangan' => 'alamat',
            'Rumah Potong Hewan' => 'alamat'
        ];

        $field = $addressFields[$kategoriName] ?? 'alamat';
        return $item[$field] ?? 'Tidak ada data alamat';
    }

    /**
     * Load all kategori data for a desa
     */
    private function loadKategoriData($desa)
    {
        $kategoriData = [];

        // Define kategori loaders with their configurations
        $kategoriLoaders = [
            'Jalan Desa' => [
                'relation' => 'jalanDesa',
                'fields' => ['id', 'desa_id', 'nama_jalan', 'latitude', 'longitude', 'lokasi']
            ],
            'Jalan Kabupaten' => [
                'relation' => 'jalanKab',
                'fields' => ['id', 'desa_id', 'nama_jalan', 'latitude', 'longitude', 'lokasi']
            ],
            'Jembatan' => [
                'relation' => 'jembatan',
                'fields' => ['id', 'desa_id', 'nama_jembatan', 'latitude', 'longitude', 'lokasi']
            ],
            'Pendidikan' => [
                'relation' => 'pendidikan',
                'fields' => ['id', 'desa_id', 'jenis_pendidikan', 'latitude', 'longitude', 'alamat']
            ],
            'Sarana Ibadah' => [
                'relation' => 'saranaIbadah',
                'fields' => ['id', 'desa_id', 'jenis_sarana_ibadah', 'latitude', 'longitude', 'alamat']
            ],
            'Irigasi' => [
                'relation' => 'irigasi',
                'fields' => ['id', 'desa_id', 'nama_irigasi', 'latitude', 'longitude', 'lokasi']
            ],
            'Pasar' => [
                'relation' => 'pasar',
                'fields' => ['id', 'desa_id', 'nama_pasar', 'latitude', 'longitude', 'alamat']
            ],
            'Pembuangan Sampah' => [
                'relation' => 'pembuanganSampah',
                'fields' => ['id', 'desa_id', 'nama_tps', 'latitude', 'longitude', 'lokasi']
            ],
            'Pusat Perdagangan' => [
                'relation' => 'pusatPerdagangan',
                'fields' => ['id', 'desa_id', 'nama_pusat', 'latitude', 'longitude', 'alamat']
            ],
            'Rumah Potong Hewan' => [
                'relation' => 'rumahPotongHewan',
                'fields' => ['id', 'desa_id', 'nama_rph', 'latitude', 'longitude', 'alamat']
            ]
        ];

        foreach ($kategoriLoaders as $kategoriName => $config) {
            try {
                if (method_exists($desa, $config['relation'])) {
                    $data = $desa->{$config['relation']}()
                        ->select($config['fields'])
                        ->whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->where('latitude', '!=', '')
                        ->where('longitude', '!=', '')
                        ->where('latitude', 'REGEXP', '^-?[0-9]+\.?[0-9]*')
                        ->where('longitude', 'REGEXP', '^-?[0-9]+\.?[0-9]*')
                        ->get();

                    if ($data->count() > 0) {
                        $kategoriData[$kategoriName] = $data->toArray();
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Error loading {$kategoriName} for desa {$desa->id}: " . $e->getMessage());
                // Continue loading other categories even if one fails
                continue;
            }
        }

        return $kategoriData;
    }

    /**
     * Get desa boundary data (placeholder for future implementation)
     */
    public function getDesaBoundary($desaId)
    {
        try {
            $desa = Desa::find($desaId);
            if (!$desa) {
                return response()->json(['error' => 'Desa tidak ditemukan'], 404);
            }

            // This would typically return GeoJSON boundary data
            // For now, return basic info
            return response()->json([
                'success' => true,
                'data' => [
                    'desa_id' => $desa->id,
                    'nama_desa' => $desa->nama_desa,
                    'center' => [
                        'latitude' => $desa->latitude,
                        'longitude' => $desa->longitude
                    ],
                    'boundary' => null // Would contain GeoJSON data
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting desa boundary: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal mengambil boundary desa',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get all data including kecamatan and their desas
     */
    public function getAllData()
    {
        try {
            $cacheKey = 'all_location_data';
            $data = Cache::remember($cacheKey, 1800, function () {
                return Kecamatan::with([
                    'desas' => function ($query) {
                        $query->select('id', 'kecamatan_id', 'nama_desa', 'klas', 'stat_pem', 'latitude', 'longitude')
                            ->whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->where('latitude', '!=', '')
                            ->where('longitude', '!=', '')
                            ->orderBy('nama_desa');
                    }
                ])->select('id', 'nama_kecamatan')
                    ->orderBy('nama_kecamatan')
                    ->get();
            });

            return response()->json([
                'success' => true,
                'data' => $data,
                'meta' => [
                    'total_kecamatan' => $data->count(),
                    'total_desa' => $data->sum(function ($kec) {
                        return $kec->desas->count();
                    })
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting all data: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal mengambil semua data',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get specific kategori data by type and desa
     */
    public function getKategoriByType(Request $request, $desa_id, $type)
    {
        try {
            $desa = Desa::find($desa_id);
            if (!$desa) {
                return response()->json(['error' => 'Desa tidak ditemukan'], 404);
            }

            $validTypes = [
                'jalan-desa',
                'jalan-kabupaten',
                'jembatan',
                'pendidikan',
                'sarana-ibadah',
                'irigasi',
                'pasar',
                'pembuangan-sampah',
                'pusat-perdagangan',
                'rumah-potong-hewan'
            ];

            if (!in_array($type, $validTypes)) {
                return response()->json(['error' => 'Tipe kategori tidak valid'], 400);
            }

            // Convert URL type to relation name
            $relationMap = [
                'jalan-desa' => 'jalanDesa',
                'jalan-kabupaten' => 'jalanKab',
                'jembatan' => 'jembatan',
                'pendidikan' => 'pendidikan',
                'sarana-ibadah' => 'saranaIbadah',
                'irigasi' => 'irigasi',
                'pasar' => 'pasar',
                'pembuangan-sampah' => 'pembuanganSampah',
                'pusat-perdagangan' => 'pusatPerdagangan',
                'rumah-potong-hewan' => 'rumahPotongHewan'
            ];

            $relation = $relationMap[$type];

            if (!method_exists($desa, $relation)) {
                return response()->json(['error' => 'Relasi tidak ditemukan'], 404);
            }

            $data = $desa->{$relation}()
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->where('latitude', '!=', '')
                ->where('longitude', '!=', '')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $data,
                'meta' => [
                    'type' => $type,
                    'desa_id' => $desa_id,
                    'count' => $data->count()
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("Error getting {$type} data for desa {$desa_id}: " . $e->getMessage());
            return response()->json([
                'error' => 'Gagal mengambil data kategori',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Clear cache for location data
     */
    public function clearCache()
    {
        try {
            // Clear all location-related caches
            Cache::forget('kecamatan_list');

            // Clear desa caches for all kecamatan
            $kecamatans = Kecamatan::pluck('id');
            foreach ($kecamatans as $kecId) {
                Cache::forget("desa_kecamatan_{$kecId}");
            }

            // Clear kategori caches for all desa
            $desas = Desa::pluck('id');
            foreach ($desas as $desaId) {
                Cache::forget("kategori_desa_{$desaId}");
            }

            Cache::forget('all_location_data');

            return response()->json([
                'success' => true,
                'message' => 'Cache berhasil dibersihkan'
            ]);
        } catch (\Exception $e) {
            Log::error('Error clearing cache: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal membersihkan cache',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get statistics for dashboard
     */
    public function getStatistics()
    {
        try {
            $cacheKey = 'location_statistics';
            $stats = Cache::remember($cacheKey, 3600, function () {
                $totalKecamatan = Kecamatan::count();
                $totalDesa = Desa::whereNotNull('latitude')
                    ->whereNotNull('longitude')
                    ->where('latitude', '!=', '')
                    ->where('longitude', '!=', '')
                    ->count();

                // Count kategori data (this would need to be implemented based on your models)
                $totalFasilitas = 0;
                $fasilitasPerType = [];

                return [
                    'total_kecamatan' => $totalKecamatan,
                    'total_desa' => $totalDesa,
                    'total_fasilitas' => $totalFasilitas,
                    'fasilitas_per_type' => $fasilitasPerType,
                    'last_updated' => now()->toISOString()
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting statistics: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal mengambil statistik',
                'message' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
