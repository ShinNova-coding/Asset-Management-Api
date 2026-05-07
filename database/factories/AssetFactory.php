<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_id'=>'AST-'.strtolower($this->faker->unique()->bothify('???-###')),
            'name'=>$this->faker->title(),
            'category_id'=>Category::factory(),
            'serial_number'=>$this->faker->unique()->bothify('??#####??'),
            'purchased_date'=>$this->faker->date(),
            'warranty_expiry'=>$this->faker->date(),
            'status'=>$this->faker->randomElement(['available','assigned','maintenance']),
            'condition'=>'fair'
            
        ];
    }
}
