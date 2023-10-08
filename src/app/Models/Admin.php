<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\Pics; // picsテーブル
use App\Models\Place; // placesテーブル
use App\Models\Area; // areasテーブル

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
        'place',
        'area',
        'user_permission',
        'admin_permission',
        'system_permission',
        'status',
        'updated_at',
    ];
    // JSONに含まれなくなる
    protected $hidden = [
        'password',
    ];
    protected $guarded = [
        'created_at',
        'deleted_at',
    ];

    // 日付のフォーマットを変えるformat関数を使えるようにする
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // AdminモデルからPicsモデル(admin_id)に関連付けられたデータを取得(1:多)
    public function picsAdminId()
    {
        return $this->hasMany(Pics::class, 'admin_id');
    }


    // システム管理者: AdminモデルからPicsモデル(admin_id)に関連付けられたデータを取得(1:多)
    public function systemAdmin()
    {
        return Admin::where('system_permission', 1)->get();
    }

    // システム管理者以外の全ユーザー情報を取得
    public static function exceptSysytemAdmin()
    {
        return Admin::where('system_permission','<>' , 1)
            ->orderBy('place', 'asc')
            ->orderBy('admin_permission', 'desc')
            ->get();
    }

    // ログインユーザー情報を取得
    public static function authAdmin()
    {
        return Admin::where('id', Auth::guard('admin')->user()->id)->first();
    }

    // 管理者: Controllerから引数を受け取って対象のidのレコード情報を取得
    public static function idAdmin(Int $id)
    {
        return Admin::where('id', $id)->first();
    }

    // 同じ所属会社の管理者: Controllerから引数を受け取って対象のplaceのレコード情報を取得
    // 同じ所属会社のレコードを取得するため
    // 更新の降順&管理者編集権限あり(上長)→なし(メンバー)の並び順
    // システム管理者は除く
    public static function idAdminPlace(String $place)
    {
        return Admin::where('place', '=', $place)
            ->where('system_permission', '<>', 1)
            ->orderBy('admin_permission', 'desc')
            ->get();
    }
}