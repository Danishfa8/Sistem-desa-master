<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileDesa>
 */
class ProfileDesaFactory extends Factory
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
            'visi' => $this->faker->paragraph(2),
            'misi' => $this->faker->paragraph(3),
            'program_unggulan' => $this->faker->paragraph(2),
            'batas_wilayah' => $this->faker->sentence(10),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'foto' => 'assets/images/default_seeder.jpg',
        ];
    }
}
