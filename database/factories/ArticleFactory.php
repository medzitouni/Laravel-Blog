<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'article' => fake()->paragraph(4),
            'slug' => Str::slug($title),
            'image' => fake()->image('public/uploads/images',400,300, null, false),
            'category_id' => Category::all()->random()->id,
            'user_id' => 1,
        ];
    }
}
