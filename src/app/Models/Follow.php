<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    protected $fillable = [
        'follow_id',
        'follower_id',
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    // Userモデルに属していることを定義
    public function usersFollowId()
    {
        return $this->belongsTo(User::class, 'follow_id');
    }

    // Userモデルに属していることを定義
    public function usersFollowerId()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}