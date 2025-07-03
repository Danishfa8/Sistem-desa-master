<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PerangkatDesaFactory extends Factory
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
            'nama' => $this->faker->name(),
            'jabatan' => $this->faker->randomElement([
                'Kepala Desa',
                'Sekretaris Desa',
                'Bendahara',
                'Kasi Pemerintahan',
                'Kasi Pelayanan',
                'Kaur Umum'
            ]),
            'foto' => 'storage/app/public/default_seeder.jpg',
        ];
    }
}
