<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 初期値を1として1ずつカウントアップする
        static $count = 1;
        // config/app.phpでfaker_localeをja_JPに変える
        return [
            'user_id' => $count++,
            'name' => fake()->name(),
            'birth' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'), // 1年以内のランダムな日付
        ];
    }
}