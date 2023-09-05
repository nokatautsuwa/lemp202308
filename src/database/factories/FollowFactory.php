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
        // ランダムなfollowユーザーを取得
        $follow = User::inRandomOrder()->first();
        // follow_idにusersテーブルのidを入れる
        $follow_id = $follow->id;
        // ランダムなfollowerユーザーを取得
        $follower = User::inRandomOrder()->first();
        // follower_idにusersテーブルのidを入れる
        $follower_id = $follower->id;

        return [
            'follow_id' => $follow_id,
            'follower_id' => $follower_id,
        ];
    }
}