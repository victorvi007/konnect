<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? Str::ulid(),
            'title' => fake()->word(), // Generates a random word
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 5000), // Generates price with 2 decimal places
            'location' => fake()->address(),
            'category' => fake()->word(),
            'rating' => fake()->randomFloat(1, 0, 5), // Generates a decimal rating between 0.0 and 5.0
            'offers' => json_encode([fake()->sentence(), fake()->sentence(), fake()->sentence()]), // Convert array to JSON
        ];
    }
}
