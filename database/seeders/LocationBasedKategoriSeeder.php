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
        DB::table('kategoris')->truncate();
        
        // Data kategori berdasarkan tabel yang memiliki latitude/longitude
        $categories = [
            [
                'nama' => 'Desas',
                'tipe' => 'umum',
                'asal_id' => 609,
                'latitude' => '-6.1944',
                'longitude' => '106.8229',
            ],
            [
                'nama' => 'Irigasi Desas',
                'tipe' => 'umum',
                'asal_id' => 991,
                'latitude' => '-6.1754',
                'longitude' => '106.7842',
            ],
            [
                'nama' => 'Jalan Desas',
                'tipe' => 'umum',
                'asal_id' => 445,
                'latitude' => '-6.1944',
                'longitude' => '106.8229',
            ],
            [
                'nama' => 'Jalan Kabupaten Desas',
                'tipe' => 'umum',
                'asal_id' => 946,
                'latitude' => '-6.2088',
                'longitude' => '106.8456',
            ],
            [
                'nama' => 'Jembatan Desas',
                'tipe' => 'umum',
                'asal_id' => 675,
                'latitude' => '-6.1944',
                'longitude' => '106.8229',
            ],
            [
                'nama' => 'Kategoris',
                'tipe' => 'umum',
                'asal_id' => 398,
                'latitude' => '-6.1751',
                'longitude' => '106.8650',
            ],
            [
                'nama' => 'Pasar Desas',
                'tipe' => 'umum',
                'asal_id' => 714,
                'latitude' => '-6.2088',
                'longitude' => '106.8456',
            ],
            [
                'nama' => 'Pembuangan Sampah Desas',
                'tipe' => 'umum',
                'asal_id' => 400,
                'latitude' => '-6.1751',
                'longitude' => '106.8650',
            ],
            [
                'nama' => 'Pendidikan Desas',
                'tipe' => 'umum',
                'asal_id' => 232,
                'latitude' => '-6.2088',
                'longitude' => '106.8456',
            ],
            [
                'nama' => 'Pusat Perdagangan Desas',
                'tipe' => 'umum',
                'asal_id' => 386,
                'latitude' => '-6.1944',
                'longitude' => '106.8229',
            ],
            [
                'nama' => 'Rumah Potong Hewan Desas',
                'tipe' => 'umum',
                'asal_id' => 145,
                'latitude' => '-6.2088',
                'longitude' => '106.8456',
            ],
            [
                'nama' => 'Sarana Ibadah Desas',
                'tipe' => 'umum',
                'asal_id' => 865,
                'latitude' => '-6.1944',
                'longitude' => '106.8229',
            ]
        ];

        // Insert data ke tabel kategoris
        foreach ($categories as $category) {
            DB::table('kategoris')->insert([
                'nama' => $category['nama'],
                'tipe' => $category['tipe'],
                'asal_id' => $category['asal_id'],
                'latitude' => $category['latitude'],
                'longitude' => $category['longitude'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        $this->command->info('LocationBasedKategoriSeeder completed successfully!');
    }
}