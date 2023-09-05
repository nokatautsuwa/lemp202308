<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    protected $fillable = [
        'user_id',
        'name',
        'birth',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'user_id',
        'created_at',
        'updated_at',
    ];

    // JSONに含まれなくなる
    protected $hidden = [
        'name',
        'gender',
        'birth',
        'postcode',
        'address',
        'tel',
    ];

    // 日付のフォーマットを変えるformat関数を使えるようにする
    protected $dates = [
        'birth',
    ];

    // Userモデルに属していることを定義
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}