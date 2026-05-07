<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            //   Category names instead of IT Assets 
            'name' => $this->faker->unique()->randomElement(['Laptop', 'Desktop', 'Mobile', 'Tablet', 'Networking', 'Peripheral']),
        ];
    }
}