<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataDalamPetaController extends Controller
{
    public function index()
    {
        // Ambil semua nama tabel dari database
        $tables = DB::select('SHOW TABLES');

        // Ambil nama kolom dari objek hasil query
        $tableNames = collect($tables)->map(function ($table) {
            return array_values((array) $table)[0];
        });

        // Tentukan tabel yang ingin dikecualikan
        $excludedTables = [
            'users',
            'password_resets',
            'migrations',
            'failed_jobs',
            'personal_access_tokens',
            'activity_log',
            'kecamatans',
            'desas',
            'cache',
            'cache_locks',
            'jobs',
            'job_batches',
            'sessions'
        ];
        // Filter tabel yang tidak termasuk dalam pengecualian
        $filteredTables = $tableNames->filter(function ($table) use ($excludedTables) {
            return !in_array($table, $excludedTables);
        });

        // Validasi tabel yang memiliki kolom yang diperlukan untuk peta
        $validTables = $this->validateTablesForMapping($filteredTables);

        // Ambil data kecamatan untuk dropdown
        $kecamatans = $this->getKecamatans();

        return view('web.data-peta', [
            'tableNames' => $validTables,
            'kecamatans' => $kecamatans
        ]);
    }

    private function validateTablesForMapping($tables)
    {
        $validTables = [];

        foreach ($tables as $tableName) {
            try {
                // Cek apakah tabel memiliki kolom yang diperlukan
                $columns = Schema::getColumnListing($tableName);

                // Kolom minimal yang harus ada untuk mapping
                $requiredColumns = ['latitude', 'longitude'];
                $optionalColumns = ['nama', 'name', 'title', 'judul'];

                $hasRequiredColumns = collect($requiredColumns)->every(function ($column) use ($columns) {
                    return in_array($column, $columns);
                });

                $hasNameColumn = collect($optionalColumns)->some(function ($column) use ($columns) {
                    return in_array($column, $columns);
                });

                if ($hasRequiredColumns && $hasNameColumn) {
                    $validTables[] = [
                        'table' => $tableName,
                        'display_name' => $this->formatTableName($tableName),
                        'columns' => $columns
                    ];
                }
            } catch (\Exception $e) {
                // Skip tabel yang tidak bisa diakses
                continue;
            }
        }

        return $validTables;
    }

    private function formatTableName($tableName)
    {
        // Convert snake_case ke Title Case
        return ucwords(str_replace('_', ' ', $tableName));
    }

    private function getKecamatans()
    {
        try {
            return DB::table('kecamatans')->select('id', 'nama_kecamatan')->get();
        } catch (\Exception $e) {
            return collect();
        }
    }

    public function getDesaByKecamatan($kecamatanId)
    {
        try {
            $desas = DB::table('desas')
                ->where('kecamatan_id', $kecamatanId)
                ->select('id', 'nama_desa')
                ->get();

            return response()->json($desas);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }

    public function getLokasi(Request $request)
    {
        $tableName = $request->input('table_name');
        $kecamatanId = $request->input('kecamatan_id');
        $desaId = $request->input('desa_id');

        if (!$tableName) {
            return response()->json([]);
        }

        try {
            if (!$this->isValidTable($tableName) || !Schema::hasTable($tableName)) {
                return response()->json(['error' => 'Invalid table'], 400);
            }

            $columns = Schema::getColumnListing($tableName);
            $query = DB::table($tableName);

            $nameColumn = $this->getNameColumn($tableName);

            $selects = ['id', 'latitude', 'longitude'];
            if (in_array($nameColumn, $columns)) $selects[] = "$nameColumn as nama";
            if (in_array('deskripsi', $columns)) $selects[] = 'deskripsi';
            if (in_array('alamat', $columns)) $selects[] = 'alamat';
            if (in_array('kecamatan_id', $columns)) $selects[] = 'kecamatan_id';
            if (in_array('desa_id', $columns)) $selects[] = 'desa_id';

            $query->select($selects);

            if ($kecamatanId && in_array('kecamatan_id', $columns)) {
                $query->where('kecamatan_id', $kecamatanId);
            }

            if ($desaId && in_array('desa_id', $columns)) {
                $query->where('desa_id', $desaId);
            }

            $data = $query->get();

            // Ambil semua kecamatan & desa
            $kecamatans = DB::table('kecamatans')->pluck('nama_kecamatan', 'id');
            $desas = DB::table('desas')->pluck('nama_desa', 'id');

            $enrichedData = $data->map(function ($item) use ($columns, $tableName, $kecamatans, $desas) {
                $result = (array) $item;
                $result['table_name'] = $tableName;
                $result['kategori'] = $this->formatTableName($tableName);

                if (in_array('kecamatan_id', $columns) && isset($item->kecamatan_id)) {
                    $result['kecamatan_nama'] = $kecamatans[$item->kecamatan_id] ?? '';
                }

                if (in_array('desa_id', $columns) && isset($item->desa_id)) {
                    $result['desa_nama'] = $desas[$item->desa_id] ?? '';
                }

                return $result;
            });

            return response()->json($enrichedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching data: ' . $e->getMessage()], 500);
        }
    }

    private function isValidTable($tableName)
    {
        // Validasi keamanan: pastikan nama tabel aman
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            return false;
        }

        // Cek apakah tabel exists
        return Schema::hasTable($tableName);
    }

    private function getNameColumn($tableName)
    {
        $columns = Schema::getColumnListing($tableName);

        // Prioritas kolom nama
        $nameColumns = ['nama', 'name', 'title', 'judul'];

        foreach ($nameColumns as $col) {
            if (in_array($col, $columns)) {
                return $col;
            }
        }

        return 'id'; // fallback
    }

    public function getAllData(Request $request)
    {
        $kecamatanId = $request->kecamatan_id;
        $desaId = $request->desa_id;

        $tables = DB::select('SHOW TABLES');
        $tableNames = collect($tables)->map(fn($table) => array_values((array) $table)[0]);

        $excludedTables = [
            'users',
            'password_resets',
            'migrations',
            'failed_jobs',
            'personal_access_tokens',
            'activity_log',
            'kecamatans',
            'desas',
            'cache',
            'cache_locks',
            'jobs',
            'job_batches',
            'sessions'
        ];

        $filteredTables = $tableNames->filter(fn($table) => !in_array($table, $excludedTables));

        $allData = [];

        foreach ($filteredTables as $tableName) {
            $allData = array_merge($allData, $this->_getDataFromTable($tableName, $kecamatanId, $desaId));
        }

        return response()->json($allData);
    }

    private function _getDataFromTable($tableName, $kecamatanId = null, $desaId = null)
    {
        try {
            if (!$this->isValidTable($tableName) || !Schema::hasTable($tableName)) return [];

            $columns = Schema::getColumnListing($tableName);
            if (!in_array('latitude', $columns) || !in_array('longitude', $columns)) return [];

            $query = DB::table($tableName);
            $nameColumn = $this->getNameColumn($tableName);

            $selects = ['id', 'latitude', 'longitude'];
            if (in_array($nameColumn, $columns)) $selects[] = "$nameColumn as nama";
            if (in_array('deskripsi', $columns)) $selects[] = 'deskripsi';
            if (in_array('alamat', $columns)) $selects[] = 'alamat';
            if (in_array('kecamatan_id', $columns)) $selects[] = 'kecamatan_id';
            if (in_array('desa_id', $columns)) $selects[] = 'desa_id';

            $query->select($selects);

            if ($kecamatanId && in_array('kecamatan_id', $columns)) $query->where('kecamatan_id', $kecamatanId);
            if ($desaId && in_array('desa_id', $columns)) $query->where('desa_id', $desaId);

            $data = $query->get();

            $kecamatans = DB::table('kecamatans')->pluck('nama_kecamatan', 'id');
            $desas = DB::table('desas')->pluck('nama_desa', 'id');

            return $data->map(function ($item) use ($columns, $tableName, $kecamatans, $desas) {
                $result = (array) $item;
                $result['table_name'] = $tableName;
                $result['kategori'] = $this->formatTableName($tableName);

                if (in_array('kecamatan_id', $columns) && isset($item->kecamatan_id)) {
                    $result['kecamatan_nama'] = $kecamatans[$item->kecamatan_id] ?? '';
                }

                if (in_array('desa_id', $columns) && isset($item->desa_id)) {
                    $result['desa_nama'] = $desas[$item->desa_id] ?? '';
                }

                return $result;
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}
