<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PendapatanDesa>
 */
class PendapatanDesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desa_id' => Desa::inRandomOrder()->value('id'),
            'sumber_pendapatan' => $this->faker->randomElement([
                'Dana Desa',
                'Alokasi Dana Desa',
                'Pendapatan Asli Desa',
                'Bantuan Provinsi',
                'Lain-lain'
            ]),
            'jumlah_pendapatan' => $this->faker->randomFloat(2, 1000000, 100000000),
        ];
    }
}
