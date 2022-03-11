<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'sammary' => $this->faker->sentences(3,true),
            'photo' => $this->faker->imageUrl('100','100'),
            'is_parent' => $this->faker->randomElement([true,false]),
            'status' => $this->faker->randomElement(['active','inactive']),
            'parent_id' => $this->faker->randomElement(\App\Models\Category::pluck('id')->toArray()),
        ];
    }
}
