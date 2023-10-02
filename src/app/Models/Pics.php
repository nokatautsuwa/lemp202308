<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // usersテーブル
use App\Models\Admin; // adminsテーブル

class Pics extends Model
{
    use HasFactory;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    protected $fillable = [
        'user_id',
        'admin_id',
    ];
    protected $guarded = [
        'created_at',
    ];

    // 日付のフォーマットを変えるformat関数を使えるようにする
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Userモデルに属していることを定義
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // Adminモデルに属していることを定義
    public function admins()
    {
        return $this->belongsTo(Admin::class);
    }
    

    // Controllerから引数を受け取って対象のadmin_idのレコード情報を取得
    // 担当ユーザーを取得するため
    public static function adminIdPic(Int $id)
    {
        return Pics::where('admin_id', $id)->get();
    }
    
    // Controllerから引数を受け取って対象のuser_idのレコード情報を取得
    // 各ユーザーの担当者を取得するため
    public static function userIdPic(Int $id)
    {
        return Pics::where('user_id', $id)->get();
    }
}
