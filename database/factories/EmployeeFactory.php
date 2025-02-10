<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(['role' => UserTypeEnum::EMPLOYEE])->id,
            'company_id' => Company::factory(),
            'position' => fake()->jobTitle,
            'phone' => fake()->phoneNumber,
        ];
    }
}
