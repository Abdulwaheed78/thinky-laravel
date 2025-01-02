<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Nature;
use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Author::updateOrCreate(
            [
                'name' => 'Author 1',
                'email' => 'author1@gmail.com',
                'phone' => '9080706050',
            ]
        );

        Nature::updateOrCreate(
            [
                'name' => 'Nature 1',
            ]
        );


        // Generate 50 random blog entries
        for ($i = 0; $i < 50; $i++) {
            Blog::create([
                'title' => 'Blog Title ' . ($i + 1),
                'detail' => Str::random(200), // Random string of 200 characters for blog details
                'is_deleted' => 'no', // Default value
                'nature_id' => 1,
                'author_id' => 1,
            ]);
        }
    }
}
