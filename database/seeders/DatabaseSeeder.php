<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * isi database dengan data dummy yang konsisten per user
     */
    public function run(): void
    {
        // ambil SEMUA user yang ada
        $users = User::all();

        foreach ($users as $user) {
            // buat 3 category untuk masing-masing user
            $categories = Category::factory(3)->create([
                'user_id' => $user->id,
            ]);

            // buat 1 todo tanpa category untuk user 
            Todo::factory()->create([
                'user_id'     => $user->id,
                'category_id' => null,
            ]);

            // buat 1 todo per category untuk user 
            foreach ($categories as $category) {
                Todo::factory()->create([
                    'user_id'     => $user->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}