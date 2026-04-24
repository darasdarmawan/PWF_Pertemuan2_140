<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * generate data dummy untuk tabel categories
     */
    public function definition(): array
    {
        return [
            // user_id diisi dari seeder
            'user_id' => 1,
            // nama category random
            'title' => 'Category ' . $this->faker->randomLetter(),
        ];
    }
}