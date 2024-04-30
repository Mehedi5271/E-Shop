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
    public function definition(): array
    {
        $categories = [1,2,3];
        return [
            'title'=> fake()->realText(10),
            'price' => rand(1000,100000),
            'description' => fake()->paragraph(),
            'is_active' => true,
            'category_id' => $categories[array_rand($categories,1)]
        ];
    }
}
