<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Kecamatan;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatanData = [
            ['nama' => 'Salem', 'lat' => -6.8567, 'lng' => 109.1234],
            ['nama' => 'Bantarkawung', 'lat' => -6.8789, 'lng' => 109.0456],
            ['nama' => 'Bumiayu', 'lat' => -6.8345, 'lng' => 109.0678],
            ['nama' => 'Paguyangan', 'lat' => -6.9012, 'lng' => 109.1567],
            ['nama' => 'Sirampog', 'lat' => -6.9234, 'lng' => 109.2345],
            ['nama' => 'Tonjong', 'lat' => -6.8890, 'lng' => 109.1890],
            ['nama' => 'Larangan', 'lat' => -6.7890, 'lng' => 108.9876],
            ['nama' => 'Ketanggungan', 'lat' => -6.8123, 'lng' => 109.0123],
            ['nama' => 'Banjarharjo', 'lat' => -6.8567, 'lng' => 108.9567],
            ['nama' => 'Losari', 'lat' => -6.7234, 'lng' => 108.8901],
            ['nama' => 'Tanjung', 'lat' => -6.7567, 'lng' => 108.9234],
            ['nama' => 'Kersana', 'lat' => -6.8012, 'lng' => 108.9567],
            ['nama' => 'Wanasari', 'lat' => -6.7789, 'lng' => 108.8567],
            ['nama' => 'Songgom', 'lat' => -6.8456, 'lng' => 108.8234],
            ['nama' => 'Jatibarang', 'lat' => -6.8901, 'lng' => 108.7890],
            ['nama' => 'Brebes', 'lat' => -6.8734, 'lng' => 108.8456],
            ['nama' => 'Bulakamba', 'lat' => -6.8567, 'lng' => 108.7567],
            ['nama' => 'Kersana', 'lat' => -6.8234, 'lng' => 108.8901]
        ];

        $kecamatanIds = [];
        foreach ($kecamatanData as $kec) {
            $kecamatan = DB::table('kecamatans')->where('nama_kecamatan', $kec['nama'])->first();
            if (!$kecamatan) {
                $id = DB::table('kecamatans')->insertGetId([
                    'nama_kecamatan' => $kec['nama'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $kecamatanIds[$kec['nama']] = $id;
            } else {
                $kecamatanIds[$kec['nama']] = $kecamatan->id;
            }
        }

        // Data desa-desa di Kabupaten Brebes
        $desas = [
            // Kecamatan Salem
            ['nama_desa' => 'Salem', 'kecamatan' => 'Salem', 'klas' => 1, 'lat' => -6.8567, 'lng' => 109.1234],
            ['nama_desa' => 'Pebatan', 'kecamatan' => 'Salem', 'klas' => 2, 'lat' => -6.8545, 'lng' => 109.1289],
            ['nama_desa' => 'Serang', 'kecamatan' => 'Salem', 'klas' => 2, 'lat' => -6.8598, 'lng' => 109.1178],

            // Kecamatan Bantarkawung
            ['nama_desa' => 'Bantarkawung', 'kecamatan' => 'Bantarkawung', 'klas' => 1, 'lat' => -6.8789, 'lng' => 109.0456],
            ['nama_desa' => 'Kaligangsa', 'kecamatan' => 'Bantarkawung', 'klas' => 2, 'lat' => -6.8823, 'lng' => 109.0423],
            ['nama_desa' => 'Dukuhjati', 'kecamatan' => 'Bantarkawung', 'klas' => 3, 'lat' => -6.8756, 'lng' => 109.0489],

            // Kecamatan Bumiayu
            ['nama_desa' => 'Bumiayu', 'kecamatan' => 'Bumiayu', 'klas' => 1, 'lat' => -6.8345, 'lng' => 109.0678],
            ['nama_desa' => 'Tegalglagah', 'kecamatan' => 'Bumiayu', 'klas' => 2, 'lat' => -6.8378, 'lng' => 109.0645],
            ['nama_desa' => 'Bojongsari', 'kecamatan' => 'Bumiayu', 'klas' => 2, 'lat' => -6.8312, 'lng' => 109.0711],

            // Kecamatan Paguyangan
            ['nama_desa' => 'Paguyangan', 'kecamatan' => 'Paguyangan', 'klas' => 2, 'lat' => -6.9012, 'lng' => 109.1567],
            ['nama_desa' => 'Kalibening', 'kecamatan' => 'Paguyangan', 'klas' => 3, 'lat' => -6.9045, 'lng' => 109.1534],
            ['nama_desa' => 'Karangmalang', 'kecamatan' => 'Paguyangan', 'klas' => 3, 'lat' => -6.8979, 'lng' => 109.1600],

            // Kecamatan Sirampog
            ['nama_desa' => 'Sirampog', 'kecamatan' => 'Sirampog', 'klas' => 2, 'lat' => -6.9234, 'lng' => 109.2345],
            ['nama_desa' => 'Gumawang', 'kecamatan' => 'Sirampog', 'klas' => 3, 'lat' => -6.9267, 'lng' => 109.2312],
            ['nama_desa' => 'Cikakak', 'kecamatan' => 'Sirampog', 'klas' => 3, 'lat' => -6.9201, 'lng' => 109.2378],

            // Kecamatan Tonjong
            ['nama_desa' => 'Tonjong', 'kecamatan' => 'Tonjong', 'klas' => 2, 'lat' => -6.8890, 'lng' => 109.1890],
            ['nama_desa' => 'Randusanga', 'kecamatan' => 'Tonjong', 'klas' => 3, 'lat' => -6.8923, 'lng' => 109.1857],
            ['nama_desa' => 'Prupuk', 'kecamatan' => 'Tonjong', 'klas' => 3, 'lat' => -6.8857, 'lng' => 109.1923],

            // Kecamatan Larangan
            ['nama_desa' => 'Larangan', 'kecamatan' => 'Larangan', 'klas' => 1, 'lat' => -6.7890, 'lng' => 108.9876],
            ['nama_desa' => 'Penggarutan', 'kecamatan' => 'Larangan', 'klas' => 2, 'lat' => -6.7923, 'lng' => 108.9843],
            ['nama_desa' => 'Karangjambu', 'kecamatan' => 'Larangan', 'klas' => 2, 'lat' => -6.7857, 'lng' => 108.9909],

            // Kecamatan Ketanggungan
            ['nama_desa' => 'Ketanggungan', 'kecamatan' => 'Ketanggungan', 'klas' => 1, 'lat' => -6.8123, 'lng' => 109.0123],
            ['nama_desa' => 'Tanjungsari', 'kecamatan' => 'Ketanggungan', 'klas' => 2, 'lat' => -6.8156, 'lng' => 109.0090],
            ['nama_desa' => 'Pasarbatang', 'kecamatan' => 'Ketanggungan', 'klas' => 2, 'lat' => -6.8090, 'lng' => 109.0156],

            // Kecamatan Banjarharjo
            ['nama_desa' => 'Banjarharjo', 'kecamatan' => 'Banjarharjo', 'klas' => 1, 'lat' => -6.8567, 'lng' => 108.9567],
            ['nama_desa' => 'Dawuhan', 'kecamatan' => 'Banjarharjo', 'klas' => 2, 'lat' => -6.8600, 'lng' => 108.9534],
            ['nama_desa' => 'Karangbandung', 'kecamatan' => 'Banjarharjo', 'klas' => 3, 'lat' => -6.8534, 'lng' => 108.9600],

            // Kecamatan Losari
            ['nama_desa' => 'Losari', 'kecamatan' => 'Losari', 'klas' => 1, 'lat' => -6.7234, 'lng' => 108.8901],
            ['nama_desa' => 'Babakan', 'kecamatan' => 'Losari', 'klas' => 2, 'lat' => -6.7267, 'lng' => 108.8868],
            ['nama_desa' => 'Sumberjaya', 'kecamatan' => 'Losari', 'klas' => 2, 'lat' => -6.7201, 'lng' => 108.8934],

            // Kecamatan Tanjung
            ['nama_desa' => 'Tanjung', 'kecamatan' => 'Tanjung', 'klas' => 1, 'lat' => -6.7567, 'lng' => 108.9234],
            ['nama_desa' => 'Kemutug Lor', 'kecamatan' => 'Tanjung', 'klas' => 2, 'lat' => -6.7600, 'lng' => 108.9201],
            ['nama_desa' => 'Kemutug Kidul', 'kecamatan' => 'Tanjung', 'klas' => 2, 'lat' => -6.7534, 'lng' => 108.9267],

            // Kecamatan Kersana
            ['nama_desa' => 'Kersana', 'kecamatan' => 'Kersana', 'klas' => 1, 'lat' => -6.8012, 'lng' => 108.9567],
            ['nama_desa' => 'Pamedilan', 'kecamatan' => 'Kersana', 'klas' => 2, 'lat' => -6.8045, 'lng' => 108.9534],
            ['nama_desa' => 'Cidempel', 'kecamatan' => 'Kersana', 'klas' => 3, 'lat' => -6.7979, 'lng' => 108.9600],

            // Kecamatan Wanasari
            ['nama_desa' => 'Wanasari', 'kecamatan' => 'Wanasari', 'klas' => 1, 'lat' => -6.7789, 'lng' => 108.8567],
            ['nama_desa' => 'Luwungragi', 'kecamatan' => 'Wanasari', 'klas' => 2, 'lat' => -6.7822, 'lng' => 108.8534],
            ['nama_desa' => 'Cikeusal', 'kecamatan' => 'Wanasari', 'klas' => 2, 'lat' => -6.7756, 'lng' => 108.8600],

            // Kecamatan Songgom
            ['nama_desa' => 'Songgom', 'kecamatan' => 'Songgom', 'klas' => 1, 'lat' => -6.8456, 'lng' => 108.8234],
            ['nama_desa' => 'Grinting', 'kecamatan' => 'Songgom', 'klas' => 2, 'lat' => -6.8489, 'lng' => 108.8201],
            ['nama_desa' => 'Karangbale', 'kecamatan' => 'Songgom', 'klas' => 3, 'lat' => -6.8423, 'lng' => 108.8267],

            // Kecamatan Jatibarang
            ['nama_desa' => 'Jatibarang', 'kecamatan' => 'Jatibarang', 'klas' => 1, 'lat' => -6.8901, 'lng' => 108.7890],
            ['nama_desa' => 'Kaliwlingi', 'kecamatan' => 'Jatibarang', 'klas' => 2, 'lat' => -6.8934, 'lng' => 108.7857],
            ['nama_desa' => 'Windurejo', 'kecamatan' => 'Jatibarang', 'klas' => 2, 'lat' => -6.8868, 'lng' => 108.7923],

            // Kecamatan Brebes (Kota)
            ['nama_desa' => 'Brebes', 'kecamatan' => 'Brebes', 'klas' => 1, 'lat' => -6.8734, 'lng' => 108.8456],
            ['nama_desa' => 'Limbangan', 'kecamatan' => 'Brebes', 'klas' => 1, 'lat' => -6.8767, 'lng' => 108.8423],
            ['nama_desa' => 'Gandasuli', 'kecamatan' => 'Brebes', 'klas' => 2, 'lat' => -6.8701, 'lng' => 108.8489],

            // Kecamatan Bulakamba
            ['nama_desa' => 'Bulakamba', 'kecamatan' => 'Bulakamba', 'klas' => 1, 'lat' => -6.8567, 'lng' => 108.7567],
            ['nama_desa' => 'Rancawuluh', 'kecamatan' => 'Bulakamba', 'klas' => 2, 'lat' => -6.8600, 'lng' => 108.7534],
            ['nama_desa' => 'Klampis', 'kecamatan' => 'Bulakamba', 'klas' => 2, 'lat' => -6.8534, 'lng' => 108.7600],
        ];

        foreach ($desas as $desa) {
            DB::table('desas')->insert([
                'kecamatan_id' => $kecamatanIds[$desa['kecamatan']],
                'nama_desa' => $desa['nama_desa'],
                'klas' => $desa['klas'],
                'stat_pem' => 'Aktif',
                'latitude' => (string) $desa['lat'],
                'longitude' => (string) $desa['lng'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Desa seeder for Kabupaten Brebes completed successfully!');
    }
}
