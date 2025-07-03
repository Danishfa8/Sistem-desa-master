<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KategorisSeeder extends Seeder
{
    public function run()
    {
        // Cari semua tabel yang memiliki kolom latitude dan longitude
        $tablesWithLocation = $this->findTablesWithLatLong();

        if (empty($tablesWithLocation)) {
            $this->command->error('Tidak ada tabel dengan kolom latitude/longitude ditemukan');
            return;
        }

        // Hapus data lama
        DB::table('kategoris')->truncate();

        $categories = [];

        foreach ($tablesWithLocation as $table) {
            $categoryName = $this->formatTableName($table);
            $sampleLatLng = $this->getSampleLatLng();

            $categories[] = [
                'nama' => $categoryName,
                'tipe' => $this->getTableType($table),
                'asal_id' => $this->getAsalId($table),
                'latitude' => $sampleLatLng['lat'],
                'longitude' => $sampleLatLng['lng'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('kategoris')->insert($categories);

        $this->command->info('Berhasil membuat ' . count($categories) . ' kategori dari tabel: ' . implode(', ', $tablesWithLocation));
    }

    private function findTablesWithLatLong()
    {
        $tables = [];
        $allTables = $this->getAllTables();

        foreach ($allTables as $tableName) {
            if ($this->hasLatLongColumns($tableName)) {
                $tables[] = $tableName;
            }
        }

        return $tables;
    }

    private function getAllTables()
    {
        $tables = [];

        // Untuk MySQL
        if (config('database.default') === 'mysql') {
            $results = DB::select('SHOW TABLES');
            $tableProperty = 'Tables_in_' . config('database.connections.mysql.database');

            foreach ($results as $result) {
                if (property_exists($result, $tableProperty)) {
                    $tables[] = $result->$tableProperty;
                }
            }
        }
        return $tables;
    }

    private function hasLatLongColumns($tableName)
    {
        try {
            $columns = Schema::getColumnListing($tableName);

            $hasLatitude = collect($columns)->contains(function ($column) {
                $lowerColumn = strtolower($column);
                return in_array($lowerColumn, ['latitude', 'lat', 'lintang']) ||
                    Str::contains($lowerColumn, ['lat', 'latitude']);
            });

            $hasLongitude = collect($columns)->contains(function ($column) {
                $lowerColumn = strtolower($column);
                return in_array($lowerColumn, ['longitude', 'lng', 'long', 'bujur']) ||
                    Str::contains($lowerColumn, ['lng', 'long', 'longitude']);
            });

            return $hasLatitude && $hasLongitude;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function formatTableName($tableName)
    {
        // Hilangkan prefix umum
        $name = preg_replace('/^(tbl_|tb_|table_)/', '', $tableName);

        // Ganti underscore dengan spasi dan title case
        $name = str_replace('_', ' ', $name);
        $name = Str::title($name);

        // Singularize jika plural
        if (Str::plural(Str::singular($name)) === $name) {
            $name = Str::singular($name);
        }

        return $name;
    }

    private function getTableType($tableName)
    {
        $tableLower = strtolower($tableName);

        $typeMap = [
            'user' => 'pengguna',
            'member' => 'member',
            'customer' => 'pelanggan',
            'store' => 'toko',
            'shop' => 'toko',
            'toko' => 'toko',
            'restaurant' => 'restoran',
            'resto' => 'restoran',
            'hotel' => 'penginapan',
            'penginapan' => 'penginapan',
            'location' => 'lokasi',
            'place' => 'tempat',
            'tempat' => 'tempat',
            'lokasi' => 'lokasi',
            'event' => 'acara',
            'acara' => 'acara',
            'property' => 'properti',
            'properti' => 'properti',
            'vehicle' => 'kendaraan',
            'kendaraan' => 'kendaraan',
            'school' => 'pendidikan',
            'sekolah' => 'pendidikan',
            'hospital' => 'kesehatan',
            'rumah_sakit' => 'kesehatan',
            'office' => 'perkantoran',
            'kantor' => 'perkantoran',
        ];

        foreach ($typeMap as $keyword => $type) {
            if (Str::contains($tableLower, $keyword)) {
                return $type;
            }
        }

        return 'umum'; // Default type
    }

    private function getAsalId($tableName)
    {
        // Generate asal_id berdasarkan hash dari nama tabel
        // Anda bisa customize ini sesuai kebutuhan
        return abs(crc32($tableName)) % 1000 + 1;
    }

    private function getSampleLatLng()
    {
        // Sample koordinat area Jakarta
        $jakartaCoords = [
            ['lat' => '-6.2088', 'lng' => '106.8456'], // Monas
            ['lat' => '-6.1751', 'lng' => '106.8650'], // Bundaran HI
            ['lat' => '-6.2297', 'lng' => '106.8467'], // Blok M
            ['lat' => '-6.1754', 'lng' => '106.7842'], // Senayan
            ['lat' => '-6.1944', 'lng' => '106.8229'], // Menteng
        ];

        return $jakartaCoords[array_rand($jakartaCoords)];
    }
}
