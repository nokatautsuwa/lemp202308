<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // usersテーブル

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follow>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ランダムなuserレコードを取得
        $follow = User::inRandomOrder()->first();
        // ランダムなuserレコードを取得
        $follower = User::inRandomOrder()->first();

        return [
            'follow_id' => $follow->id,
            'follower_id' => $follower->id,
        ];
    }
}