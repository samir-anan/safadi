<?php

namespace Database\Factories;

use App\Models\Category;
use Faker\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $name =  $this->faker->department;
        return [
             'name' => $name,
             'slug' => Str::slug($name),
             'description' => $this->faker->sentences(15),
             'image' => $this->faker->imageUrl(),
        ];
    }
}
