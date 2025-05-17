<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Curriculum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryTime>
 */
class DeliveryTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        return [
            'delivery_from' => $this->faker->dateTimeBetween('-1 month', 'now')->format('YmdHis'),
            'delivery_to' => $this->faker->dateTimeBetween('now', '+1 month')->format('YmdHis'),
        ];
    }
}
