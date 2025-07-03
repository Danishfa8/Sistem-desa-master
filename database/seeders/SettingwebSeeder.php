<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingwebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settingwebsites')->insert([
            [
                'title' => 'Desa Cantik',
                'description' => 'Desa Cantik',
                'favicon' => 'storage/dsV7Cdty8s9ConWgcTWSUabL4X96AmqrOBIhRvQd.png',
                'logo' => 'dsV7Cdty8s9ConWgcTWSUabL4X96AmqrOBIhRvQd.png',
            ],
        ]);
    }
}
