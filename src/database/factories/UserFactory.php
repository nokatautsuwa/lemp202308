<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
        static $account_id_count = 2;
        // config/app.phpでfaker_localeをja_JPに変える
        return [
            'name' => 'test' . $name_count++,
            'account_id' => 'test' . $account_id_count++,
            'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            'password' => bcrypt('test0000'), // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}