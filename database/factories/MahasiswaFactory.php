<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'npm' => $this->faker->unique()->numerify('##########'),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nohp' => $this->faker->unique()->numerify('##########'),
            // 'foto' => $this->faker->imageUrl(),
            'isKomisaris' => false,
            'id_kelas' => 1,
        ];
    }
}
