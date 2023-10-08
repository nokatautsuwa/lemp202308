<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin; //admins

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'system',
            'email' => 'system@test.test',
            // 'email_verified_at' => now(),
            'password' => bcrypt('test0000'),
            // 'remember_token' => Str::random(10),
            'place' => fake()->randomElement(['A部署', 'B部署', 'C部署', 'D部署', 'E部署']),
            'area' => fake()->randomElement(['北海道', '東北', '関東', '東海中部', '近畿', '中国四国', '九州沖縄']),
            'system_permission' => 1,
        ]);

        Admin::factory()->count(19)->create(); // Faker(Factoryから)でダミーデータ4件作成
    }
}
