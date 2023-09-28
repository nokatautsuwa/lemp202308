<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth; // 認証

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
        'user_permission',
        'admin_permission',
        'system_permission',
        'updated_at',
    ];
    // JSONに含まれなくなる
    protected $hidden = [
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

    // ログインユーザー情報を取得
    public static function authUser()
    {
        return Admin::where('id', Auth::guard('admin')->user()->id)->first();
    }

    // Controllerから引数を受け取って対象のidユーザー情報を取得
    public static function idUser($id)
    {
        return Admin::where('id', $id)->first();
    }
}