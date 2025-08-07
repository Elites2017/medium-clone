<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // create a user for the user table in case the table is empty
        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'jane@medium.com'
        ]);

        // define some categories for the database
        $categories = [
            'Tehnology',
            'Health',
            'Science',
            'Sports',
            'Politics',
            'Entertainment'
        ];

        // loop over the categories array to create each one
        foreach ($categories as $key => $category) {
            # code...
            Category::create(['name' => $category]);
        }

        // create 100 posts
        Post::factory(100)->create();
    }
}
