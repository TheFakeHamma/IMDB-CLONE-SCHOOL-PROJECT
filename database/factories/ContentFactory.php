<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'release_date' => fake()->date(),
            'synopsis' => fake()->paragraph(),
            'type' => fake()->randomElement(['movie', 'tv_show']),
            'photo_url' => fake()->imageUrl(640, 480, 'entertainment', true),
            'trailer_url' => fake()->url(),
        ];
    }
}
