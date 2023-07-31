<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text($maxNbChars = 15),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2,0,1000),
            'category_id' => Category::pluck('id')->random(),
        ];
    }
}
