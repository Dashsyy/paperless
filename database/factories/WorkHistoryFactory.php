<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkHistory>
 */
class WorkHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'start_date' => $this->faker->dateTimeBetween('-5 years', '-3 years')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'description' => $this->faker->paragraph(),
        ];
    }
}
