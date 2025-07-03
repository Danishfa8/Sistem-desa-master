<?php

namespace Database\Seeders;

use App\Models\ProfileDesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileDesa::factory()->count(10)->create();
    }
}
