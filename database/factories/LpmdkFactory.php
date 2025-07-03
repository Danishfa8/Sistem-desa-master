<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\RtRwDesa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lpmdk>
 */
class LpmdkFactory extends Factory
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
            'jumlah_pengurus' => $this->faker->numberBetween(3, 10),
            'jumlah_anggota' => $this->faker->numberBetween(10, 50),
            'jumlah_kegiatan' => $this->faker->numberBetween(0, 20),
            'jumlah_buku_administrasi' => $this->faker->numberBetween(1, 10),
            'jumlah_dana' => $this->faker->randomFloat(2, 1000000, 10000000),
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => null,
            'status' => 'Arsip',
            'reject_reason' => null,
            'approved_by' => null,
            'approved_at' => null,
        ];
    }
}
