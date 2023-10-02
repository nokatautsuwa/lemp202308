<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // usersテーブル
use App\Models\Admin; // adminsテーブル

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pics>
 */
class PicsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ランダムなuserレコードを取得
        $user = User::inRandomOrder()->first();
        // ランダムなadminレコードを取得
        $admin = Admin::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'admin_id' => $admin->id,
        ];
    }
}
