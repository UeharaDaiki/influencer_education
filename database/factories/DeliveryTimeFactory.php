<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery_time>
 */
class DeliveryTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 公開開始日を「今から1ヶ月以内のランダムな日付」にする
        $from = $this->faker->dateTimeBetween('-1 month', 'now');

        // 公開終了日は、開始日から最大2ヶ月後のランダムな日
        $to = $this->faker->dateTimeBetween($from, '+2 months');

        return [
            'curriculums_id' => $this->faker->numberBetween(1, 72), // 1〜72のID
            'delivery_from' => $from,
            'delivery_to' => $to,
        ];
    }
}
