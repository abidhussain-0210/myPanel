<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_name' => fake()->name,
            'category_id' => fake()->randomDigit,
            'tag_id' => fake()->randomDigit,
            'description' => fake()->text($maxNbChars = 400),
            'image' => 'No Image Found',
            'status' => fake()->randomElement([1 , 0])
        ];
    }
}
