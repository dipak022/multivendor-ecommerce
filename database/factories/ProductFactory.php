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
            'title' => $this->faker->sentences(1,true),
            'slug' => $this->faker->unique()->slug(),
            'sammary' => $this->faker->text,
            'description' => $this->faker->text,
            'strock' => $this->faker->numberBetween(2,10),
            'brand_id' => $this->faker->randomElement(\App\Models\Brand::pluck('id')->toArray()),
            'vandor_id' => $this->faker->randomElement(\App\Models\User::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(\App\Models\Category::where('is_parent',1)->pluck('id')->toArray()),
            'clild_cat_id' => $this->faker->randomElement(\App\Models\Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo' => $this->faker->imageUrl('400','200'),
            'price' => $this->faker->numberBetween(100,1000),
            'offer_price' => $this->faker->numberBetween(100,1000),
            'discount' => $this->faker->numberBetween(100,1000),
            'size' => $this->faker->randomElement(['S','M','L']),
            'conditions' => $this->faker->randomElement(['new','popular','winter']),
            'status' => $this->faker->randomElement(['active','inactive']),
          

        ];
    }
}
