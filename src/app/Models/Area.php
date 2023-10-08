<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    protected $fillable = [
        'area',
    ];

    // areaの選択肢を作成
    public static function area()
    {
        return Place::distinct()->pluck('area');
    }
}
