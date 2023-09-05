<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; //users


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テスト用
        User::create([
            'name' => 'test1',
            'account_id' => 'test1',
            'email' => 'test@test.test',
            // 'email_verified_at' => now(),
            'password' => bcrypt('test0000'),
            // 'remember_token' => Str::random(10),
        ]);

        User::factory()->count(9)->create(); // Faker(Factoryから)でダミーデータ9件作成
    }
}