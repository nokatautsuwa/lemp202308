<?php

namespace Database\Seeders;
use App\Models\Place; // places

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 作成するレコードの配列データ
        $records = [
            ['place' => 'A社', 'area' => '北海道'],
            ['place' => 'B社', 'area' => '東北'],
            ['place' => 'C社', 'area' => '関東'],
            ['place' => 'D社', 'area' => '東海中部'],
            ['place' => 'E社', 'area' => '近畿'],
            ['place' => 'F社', 'area' => '中国四国'],
            ['place' => 'G社', 'area' => '九州沖縄'],
        ];

        // 配列をループしてレコードを作成
        foreach ($records as $recordData) {
            Place::create($recordData);
        }








        
    }
}
