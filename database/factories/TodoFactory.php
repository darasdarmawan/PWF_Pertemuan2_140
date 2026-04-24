<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * generate data dummy untuk tabel todos
     */
    public function definition(): array
    {
        return [
            // user_id dan category_id diisi dari seeder
            'user_id'     => 1,
            'category_id' => null,
            'title'       => $this->faker->sentence(4),
            'is_done'     => false,
        ];
    }
}