<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Faker\Generator as Faker;
use App\Models\Store;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->productName;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentences(15),
            'image' => $this->faker->imageUrl(600,600),
            'price' => $this->faker->randomFloat(1,1,499),
            'compare_price' => $this->faker->randomFloat(1,500,999),
            'category_id' => 1,
            'store_id' => 1,
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
