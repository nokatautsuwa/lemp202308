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
            'name' => 'admin_test1',
            'email' => 'test@test.test',
            // 'email_verified_at' => now(),
            'password' => bcrypt('test0000'),
            // 'remember_token' => Str::random(10),
            'user_authority' => 1,
            'admin_authority' => 1,
        ]);

        Admin::factory()->count(4)->create(); // Faker(Factoryから)でダミーデータ4件作成
    }
}
