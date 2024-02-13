<?php

namespace Database\Factories;

use Illuminate\Support\Str;


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
    public function definition(): array
    {
        $name = fake()->unique()->word;

        return [
            'name' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'user_id' => function () {
                return \App\Models\User::inRandomOrder()->first()->id;
            },
        ];
    }
}
