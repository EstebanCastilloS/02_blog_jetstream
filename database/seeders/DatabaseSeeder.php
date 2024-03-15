<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // crear 5 categorias
        Category::factory(5)->create();

        //crear 20 usuarios
        User::factory(20)->create();

        // User::factory()->create([
        //     'name' => 'Naun Castillo',
        //     'email' => 'naunestebancastillo@gmail.com',
        //     'password' => bcrypt('11111111'),
        // ]);

        //crear 100 posts
        Post::factory(100)->create();

    }
}
