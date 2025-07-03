<?php

namespace Database\Seeders;

use App\Models\Bumde;
use App\Models\Lpmdk;
use App\Models\PendapatanDesa;
use App\Models\PerangkatDesa;
use App\Models\PkkDesa;
use App\Models\RtRwDesa;
use App\Models\User;
use Database\Factories\LpmdkFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // PerangkatDesa::factory()->count(10)->create();
        // PendapatanDesa::factory()->count(50)->create();
        // RtRwDesa::factory()->count(100)->create();
        Lpmdk::factory()->count(100)->create();
        PkkDesa::factory()->count(100)->create();
        Bumde::factory()->count(100)->create();
    }
}
