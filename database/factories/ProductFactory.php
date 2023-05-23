<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'title' => $this->faker->word,
            'description' => $this->faker->sentence(5),
            'price' => $this->faker->numberBetween($min = 1500, $max = 6000),
            'status' => $this->faker->boolean,
            'category_id' => Category::get()->random()->id,
            'user_id' => User::get()->random()->id,
        ];
    }
}
