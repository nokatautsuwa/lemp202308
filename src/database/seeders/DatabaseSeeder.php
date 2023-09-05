<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 外部キー制約の観点から親テーブルのSeederから実行されるようにする
        $this->call(UsersTableSeeder::class); //usersテーブルのSeederを実行
        $this->call(ProfilesTableSeeder::class); //profilesテーブルのSeederを実行
        $this->call(FollowsTableSeeder::class); //followsテーブルのSeederを実行
        $this->call(AdminsTableSeeder::class); //adminsテーブルのSeederを実行

        // php artisan db:seedで
        // 'Target class [DatabaseSeeder(もしくはSeederファイル名)] does not exist.'
        // のエラーが発生する場合
        // 1. 'composer dump-autoload'でComposerが管理するClassマップを再生成(composer.jsonに記載されている)
        // 2. 'php artisan migrate:reset'でtableを削除
        // 3. 'php artisan migrate'でtableを再生成
        // 4. 再度'php artisan db:seed'を実行
    }
}
