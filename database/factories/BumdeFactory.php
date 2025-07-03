<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\RtRwDesa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bumdes>
 */
class BumdeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desa_id' => Desa::inRandomOrder()->first()->id ?? Desa::factory(),
            'rt_rw_desa_id' => RtRwDesa::inRandomOrder()->first()->id ?? RtRwDesa::factory(),
            'nama_bumdes' => 'BUMDes ' . $this->faker->unique()->company,
            'deskripsi' => $this->faker->paragraph(3),
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => null,
            'status' => 'Arsip',
            'reject_reason' => null,
            'approved_by' => null,
            'approved_at' => null,
        ];
    }
}
