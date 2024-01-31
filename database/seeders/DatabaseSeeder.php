<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // Seeder untuk Users
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        \App\Models\User::create([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'author',
        ]);

        // Seeder untuk Categories
        \App\Models\Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'user_id' => 1, // Sesuaikan dengan user_id yang sudah dibuat
        ]);

        // Seeder untuk Posts
        \App\Models\Post::create([
            'title' => 'Introduction to Laravel',
            'slug' => 'introduction-to-laravel',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non purus nec ligula efficitur dapibus.',
            'user_id' => 1, // Sesuaikan dengan user_id yang sudah dibuat
            'category_id' => 1, // Sesuaikan dengan category_id yang sudah dibuat
        ]);
        \App\Models\Post::create([
            'title' => 'Introduction to ',
            'slug' => 'introduction-to',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non purus nec ligula efficitur dapibus.',
            'user_id' => 2, // Sesuaikan dengan user_id yang sudah dibuat
            'category_id' => 1, // Sesuaikan dengan category_id yang sudah dibuat
        ]);

        // Seeder untuk Comments
        \App\Models\Comment::create([
            'post_id' => 1, // Sesuaikan dengan post_id yang sudah dibuat
            'user_id' => 1, // Sesuaikan dengan user_id yang sudah dibuat
            'comment' => 'Great post!',
            'slug' => 'great-post',
        ]);
    }
}
