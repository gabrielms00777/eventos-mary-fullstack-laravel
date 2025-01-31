<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph,
            'start_date' => fake()->dateTimeBetween('now', '+1 month'),
            'end_date' => fake()->dateTimeBetween('+1 month', '+2 months'),
            'location' => fake()->address,
            'max_participants' => fake()->randomDigit(10, 1000),
            'status' => fake()->randomElement(['pending', 'ongoing', 'completed']),
        ];
    }
}
