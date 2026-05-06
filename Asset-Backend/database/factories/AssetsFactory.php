<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\assets>
 */
class AssetsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assets_id'=>'AST-'.strtolower($this->faker->unique()->bothify('???-###')),
            'name'=>$this->faker->title(),
            'serial_number'=>$this->faker->unique()->bothify('??#####??'),
            'purchased_date'=>$this->faker->date(),
            'warranty_expiry'=>$this->faker->date(),
            'status'=>$this->faker->randomElement(['available','assigned','maintenance']),
            'condition'=>'fair'
            
        ];
    }
}
