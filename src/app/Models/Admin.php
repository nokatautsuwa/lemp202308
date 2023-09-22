<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'user_authority',
        'admin_authority',
        'updated_at',
    ];
    // JSONに含まれなくなる
    protected $hidden = [
        'name',
        'email',
        'password',
    ];
    protected $guarded = [
        'created_at',
    ];

    // 日付のフォーマットを変えるformat関数を使えるようにする
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}