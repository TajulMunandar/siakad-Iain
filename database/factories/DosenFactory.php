<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nip' => $this->faker->unique()->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'nohp' => $this->faker->unique()->numerify('##########'),
            'foto' => $this->faker->imageUrl(),
            'id_user' => $this->faker->randomElement(\App\Models\User::where('id', '!=', 1)->pluck('id')),
        ];
    }
}
