<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RtRwDesa>
 */
class RtRwDesaFactory extends Factory
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
            'rt' => $this->faker->numberBetween(1, 50),
            'rw' => $this->faker->numberBetween(1, 50),
        ];
    }
}
