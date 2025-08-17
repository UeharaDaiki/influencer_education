<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'thumbnail' => 'https://placehold.jp/150x150.png',
            'description' => $this->faker->paragraph(),
            'video_url' => $this->faker->url(),
            'always_delivery_flg' => $this->faker->boolean(),
            'grade_id' => $this->faker->numberBetween(1, 12),
        ];
    }
}
