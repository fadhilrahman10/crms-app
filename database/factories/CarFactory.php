<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'brand' => $this->faker->word(),
            'model' => $this->faker->word(),
            'plate_number' => $this->faker->randomDigit(),
            'rental_rate_per_day' => $this->faker->randomNumber(6, false),
            'is_available' => true,
        ];
    }
}
