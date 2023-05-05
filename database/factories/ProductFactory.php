<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'sku' => fake()->word(),
            'description' => fake()->word(20),
            'image_path' => fake()->imageUrl(),
            'image_uniq' => fake()->word(),
            'status' => 1,
            'created_by' => 1,
        ];
    }
}
