<?php

namespace Database\Factories;

use App\Models\Desa;
use App\Models\RtRwDesa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PkkDesa>
 */
class PkkDesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desa_id' => Desa::inRandomOrder()->first()->id,
            'rt_rw_desa_id' => RtRwDesa::inRandomOrder()->first()->id,
            'jumlah_pengurus' => $this->faker->numberBetween(1, 50),
            'jumlah_anggota' => $this->faker->numberBetween(1, 50),
            'jumlah_kegiatan' => $this->faker->numberBetween(1, 50),
            'jumlah_buku_administrasi' => $this->faker->numberBetween(1, 20),
            'jumlah_dana' => $this->faker->randomFloat(2, 500000, 10000000),
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => null,
            'status' => 'Arsip',
            'reject_reason' => null,
            'approved_by' => null,
            'approved_at' => null,
        ];
    }
}
