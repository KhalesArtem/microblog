<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BlogFactory extends Factory
{
    use HasFactory;
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'content' => $this->faker->paragraphs(5, true),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
