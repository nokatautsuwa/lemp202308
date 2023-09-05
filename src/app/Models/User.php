<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth; // 認証

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    protected $fillable = [
        'name',
        'account_id',
        'email',
        'password',
        'bio',
        'image',
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    // 日付のフォーマットを変えるformat関数を使えるようにする
    protected $dates = [
        'created_at',
    ];

    // 全ユーザーの情報を取得
    public static function allUser()
    {
        return User::all();
    }

    // ログインユーザー情報を取得
    public static function authUser()
    {
        return User::where('id', Auth::guard('user')->user()->id)->first();
    }

    // Controllerから引数を受け取って対象のaccount_idユーザー情報を取得
    public static function eachUserAccountId($account_id)
    {
        return User::where('account_id', $account_id)->first();
    }

    // UserモデルからProfileモデルに関連付けられたデータを取得(1:1)
    public function profiles()
    {
        return $this->hasOne(Profile::class);
    }

    // UserモデルからFollowモデル(follow_id)に関連付けられたデータを取得(1:多)
    public function followsFollowId()
    {
        return $this->hasMany(Follow::class, 'follow_id');
    }

    // UserモデルからFollowモデル(follower_id)に関連付けられたデータを取得(1:多)
    public function followsFollowerId()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }
}
