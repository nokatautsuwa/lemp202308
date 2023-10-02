<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 初期値を2として1ずつカウントアップする
        static $name_count = 2;
        static $mail_count = 2;
        return [
            'name' => 'admin_test' . $name_count++,
            'email' => 'admin_test' . $mail_count++ . '@test.test',
            // 'email_verified_at' => now(),
            'password' => bcrypt('test0000'), // password
            // 'remember_token' => Str::random(10),
            'place' => fake()->randomElement(['A部署', 'B部署', 'C部署', 'D部署', 'E部署']),
            'area' => fake()->randomElement(['北海道', '東北', '関東', '東海中部', '近畿', '中国四国', '九州沖縄']),
            'user_permission' => fake()->randomElement([0, 1]),
            'admin_permission' => fake()->randomElement([0, 1]),
        ];
    }
}