<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Seed the kecamatans table with all kecamatans in Kabupaten Brebes.
     */
    public function run(): void
    {
        $kecamatans = [
            'Banjarharjo',
            'Bantarkawung',
            'Brebes',
            'Bumiayu',
            'Bulakamba',
            'Jatibarang',
            'Kersana',
            'Ketanggungan',
            'Larangan',
            'Losari',
            'Paguyangan',
            'Salem',
            'Sirampog',
            'Songgom',
            'Tanjung',
            'Tonjong',
            'Wanasari'
        ];

        $this->command->info('Seeding kecamatans in Kabupaten Brebes...');

        foreach ($kecamatans as $kecamatan) {
            DB::table('kecamatans')->insert([
                'nama_kecamatan' => $kecamatan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Successfully seeded ' . count($kecamatans) . ' kecamatans in Kabupaten Brebes.');
    }
}
