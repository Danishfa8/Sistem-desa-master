<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class GenerateLocationSeeder extends Command
{
    protected $signature = 'generate:location-seeder {--table-name=kategoris}';
    protected $description = 'Generate seeder for tables that have latitude and longitude columns';

    public function handle()
    {
        $targetTable = $this->option('table-name');
        $tablesWithLocation = $this->findTablesWithLatLong();

        if (empty($tablesWithLocation)) {
            $this->error('Tidak ada tabel yang ditemukan dengan kolom latitude dan longitude');
            return 1;
        }

        $this->info('Tabel yang ditemukan dengan kolom latitude/longitude:');
        foreach ($tablesWithLocation as $table) {
            $this->line("- {$table}");
        }

        $this->generateSeeder($tablesWithLocation, $targetTable);

        return 0;
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
        $results = DB::select('SHOW TABLES');

        foreach ($results as $result) {
            $tableName = array_values((array) $result)[0];
            if ($tableName) {
                $tables[] = $tableName;
            }
        }

        return $tables;
    }

    private function hasLatLongColumns($tableName)
    {
        try {
            $columns = Schema::getColumnListing($tableName);

            $hasLatitude = collect($columns)->contains(function ($column) {
                return Str::contains(strtolower($column), ['lat', 'latitude']);
            });

            $hasLongitude = collect($columns)->contains(function ($column) {
                return Str::contains(strtolower($column), ['lng', 'long', 'longitude']);
            });

            return $hasLatitude && $hasLongitude;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function generateSeeder($tables, $targetTable)
    {
        $seederContent = $this->buildSeederContent($tables, $targetTable);
        $seederPath = database_path('seeders/LocationBasedKategoriSeeder.php');

        file_put_contents($seederPath, $seederContent);

        $this->info("Seeder berhasil dibuat di: {$seederPath}");
        $this->info("Jalankan: php artisan db:seed --class=LocationBasedKategoriSeeder");
    }

    private function buildSeederContent($tables, $targetTable)
    {
        $categories = $this->generateCategoriesFromTables($tables);
        $insertStatements = $this->buildInsertStatements($categories, $targetTable);

        return <<<PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationBasedKategoriSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama jika ada
        DB::table('{$targetTable}')->truncate();
        
        // Data kategori berdasarkan tabel yang memiliki latitude/longitude
        \$categories = [
{$categories}
        ];

        // Insert data ke tabel {$targetTable}
        foreach (\$categories as \$category) {
            DB::table('{$targetTable}')->insert([
                'nama' => \$category['nama'],
                'tipe' => \$category['tipe'],
                'asal_id' => \$category['asal_id'],
                'latitude' => \$category['latitude'],
                'longitude' => \$category['longitude'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        \$this->command->info('LocationBasedKategoriSeeder completed successfully!');
    }
}
PHP;
    }

    private function generateCategoriesFromTables($tables)
    {
        $categories = [];

        foreach ($tables as $table) {
            $categoryName = $this->formatTableName($table);

            // Sample data untuk latitude dan longitude (Jakarta area)
            $sampleLatLng = $this->getSampleLatLng();

            $categories[] = [
                'nama' => $categoryName,
                'tipe' => $this->getTableType($table),
                'asal_id' => $this->getAsalId($table),
                'latitude' => $sampleLatLng['lat'],
                'longitude' => $sampleLatLng['lng']
            ];
        }

        return $this->formatCategoriesArray($categories);
    }

    private function formatTableName($tableName)
    {
        // Hilangkan prefix umum dan format nama
        $name = str_replace(['tbl_', 'tb_', 'table_'], '', $tableName);
        $name = str_replace('_', ' ', $name);
        return Str::title($name);
    }

    private function getTableType($tableName)
    {
        $tableLower = strtolower($tableName);

        $typeMap = [
            'desas' => 'Desa',
            'irigrasi_desas' => 'Irigasi Desa',
            'jalan_desas' => 'Jalan Desa',
            'jalan_kabupaten_desas' => 'Jalan Kabupaten Desa',
            'jembatan_desas' => 'Jembatan Desa',
            'pasar_desas' => 'Pasar Desa',
            'pembuangan_sampah_desas' => 'Pembuangan Sampah Desa',
            'pusat_perdagangan_desas' => 'Pusat Perdagangan Desa',
            'rumah_potong_hewan_desas' => 'Rumah Potong Hewan Desa',
            'sarana_ibadah_desas' => 'Sarana Ibadah Desa',
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

    private function formatCategoriesArray($categories)
    {
        $formatted = '';
        foreach ($categories as $category) {
            $formatted .= "            [\n";
            $formatted .= "                'nama' => '{$category['nama']}',\n";
            $formatted .= "                'tipe' => '{$category['tipe']}',\n";
            $formatted .= "                'asal_id' => {$category['asal_id']},\n";
            $formatted .= "                'latitude' => '{$category['latitude']}',\n";
            $formatted .= "                'longitude' => '{$category['longitude']}',\n";
            $formatted .= "            ],\n";
        }
        return rtrim($formatted, ",\n");
    }

    private function buildInsertStatements($categories, $targetTable)
    {
        // Method ini bisa digunakan untuk customisasi lebih lanjut
        return $categories;
    }
}
