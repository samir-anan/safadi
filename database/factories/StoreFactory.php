<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Support\Str;
use Faker\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Store>
 */
class StoreFactory extends Factory
{
    protected $model = Store::class;
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
            'image_logo' => $this->faker->imageUrl(300,300),
            'cover_logo' => $this->faker->imageUrl(800,600),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
