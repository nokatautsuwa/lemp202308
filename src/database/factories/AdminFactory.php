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
        static $count = 2;
        return [
            'name' => 'admin_test' . $count++,
            'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => bcrypt('test0000'), // password
            // 'remember_token' => Str::random(10),
            'user_permission' => fake()->randomElement([0, 1]),
            'admin_permission' => fake()->randomElement([0, 1]),
        ];
    }
}