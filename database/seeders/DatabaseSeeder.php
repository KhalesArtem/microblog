<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $faker = Faker::create();

        $categories = Category::factory()->count(10)->create();

        $blogs = Blog::factory()->count(100)->make()->each(function ($blog) use ($categories, $faker) {
            $blog->created_at = $faker->dateTimeBetween('-1 year', 'now');
            $blog->save();
            $blog->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
        });
    }
}
