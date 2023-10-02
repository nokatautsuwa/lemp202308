<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area; // areas

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 作成するレコードの配列データ
        $records = [
            ['area' => '北海道', 'prefecture' => '北海道'],
            ['area' => '東北', 'prefecture' => '青森県'],
            ['area' => '東北', 'prefecture' => '岩手県'],
            ['area' => '東北', 'prefecture' => '宮城県'],
            ['area' => '東北', 'prefecture' => '秋田県'],
            ['area' => '東北', 'prefecture' => '山形県'],
            ['area' => '東北', 'prefecture' => '福島県'],
            ['area' => '関東', 'prefecture' => '茨城県'],
            ['area' => '関東', 'prefecture' => '栃木県'],
            ['area' => '関東', 'prefecture' => '群馬県'],
            ['area' => '関東', 'prefecture' => '埼玉県'],
            ['area' => '関東', 'prefecture' => '千葉県'],
            ['area' => '関東', 'prefecture' => '東京都'],
            ['area' => '関東', 'prefecture' => '神奈川県'],
            ['area' => '東海中部', 'prefecture' => '新潟県'],
            ['area' => '東海中部', 'prefecture' => '富山県'],
            ['area' => '東海中部', 'prefecture' => '石川県'],
            ['area' => '東海中部', 'prefecture' => '福井県'],
            ['area' => '東海中部', 'prefecture' => '山梨県'],
            ['area' => '東海中部', 'prefecture' => '長野県'],
            ['area' => '東海中部', 'prefecture' => '岐阜県'],
            ['area' => '東海中部', 'prefecture' => '静岡県'],
            ['area' => '東海中部', 'prefecture' => '愛知県'],
            ['area' => '近畿', 'prefecture' => '滋賀県'],
            ['area' => '近畿', 'prefecture' => '京都府'],
            ['area' => '近畿', 'prefecture' => '大阪府'],
            ['area' => '近畿', 'prefecture' => '兵庫県'],
            ['area' => '近畿', 'prefecture' => '奈良県'],
            ['area' => '近畿', 'prefecture' => '和歌山県'],
            ['area' => '近畿', 'prefecture' => '三重県'],
            ['area' => '中国四国', 'prefecture' => '鳥取県'],
            ['area' => '中国四国', 'prefecture' => '島根県'],
            ['area' => '中国四国', 'prefecture' => '岡山県'],
            ['area' => '中国四国', 'prefecture' => '広島県'],
            ['area' => '中国四国', 'prefecture' => '山口県'],
            ['area' => '中国四国', 'prefecture' => '徳島県'],
            ['area' => '中国四国', 'prefecture' => '香川県'],
            ['area' => '中国四国', 'prefecture' => '愛媛県'],
            ['area' => '中国四国', 'prefecture' => '高知県'],
            ['area' => '九州沖縄', 'prefecture' => '福岡県'],
            ['area' => '九州沖縄', 'prefecture' => '佐賀県'],
            ['area' => '九州沖縄', 'prefecture' => '長崎県'],
            ['area' => '九州沖縄', 'prefecture' => '熊本県'],
            ['area' => '九州沖縄', 'prefecture' => '大分県'],
            ['area' => '九州沖縄', 'prefecture' => '宮崎県'],
            ['area' => '九州沖縄', 'prefecture' => '鹿児島県'],
            ['area' => '九州沖縄', 'prefecture' => '沖縄県'],
        ];

        // 配列をループしてレコードを作成
        foreach ($records as $recordData) {
            Area::create($recordData);
        }
    }
}
