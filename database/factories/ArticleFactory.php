<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, User::count()),
            'category_id' => rand(1, Category::count()),
            'title' => $this->faker->words(3,true),
            'content' => '<p>'.$this->faker->paragraphs(3,true).'</p>',
            'image' => 'https://source.unsplash.com/800x600/?food',
            'status' => $this->faker->randomElement(['Active', 'Not active']),
        ];
    }
}
