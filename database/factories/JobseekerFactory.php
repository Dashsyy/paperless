<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobseeker>
 */
class JobseekerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'seeker_id' => fake()->numberBetween(1, 20),
            'role' => fake()->jobTitle(),
            'description' => fake()->paragraph(3)
        ];
    }
}
