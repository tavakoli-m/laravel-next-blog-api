<?php

namespace Database\Factories\Content;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'body' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'category_id' => fake()->numberBetween(1,10),
            'user_id' => fake()->numberBetween(1,20)
        ];
    }
}
