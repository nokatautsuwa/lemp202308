<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    // 履歴のため全てブラックリスト
    
    // JSONに含まれなくなる
    protected $hidden = [
        'user_name',
    ];
    protected $guarded = [
        'user_id',
        'user_name',
        'type',
        'note',
        'created_at',
        'updated_at',
    ];

    // 日付のフォーマットを変えるformat関数を使えるようにする
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Controllerから引数を受け取って対象のidのレコード情報を取得
    public static function userHistoryId(Int $id)
    {
        return UserHistory::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    // typeカラムの値をキーとした各種メッセージの連想配列モデルを作成
    // (typeはString型)
    public static function userHistoryTypeMessage()
    {
        $data = [
            '1' => 'アカウント登録',
            '2' => 'プロフィールを編集',
            '3' => 'チャンネルを作成',
            '4' => 'チャンネルを編集',
            '5' => 'チャンネル参加を承認',
            '6' => 'チャンネルから追放',
            '7' => 'チャンネルへ参加',
            '8' => 'チャンネルを退会',
            '9' => 'アカウント削除',
        ];
        return $data;
    }

    // typeカラムの値をキーとした各種メッセージアイコンパスの連想配列モデルを作成
    // (typeはString型)
    public static function userHistoryTypeIcon()
    {
        $data = [
            '1' => 'user_icon_default(sample).svg',
            '2' => 'user_icon_default(sample).svg',
            '3' => 'user_icon_default(sample).svg',
            '4' => 'user_icon_default(sample).svg',
            '5' => 'user_icon_default(sample).svg',
            '6' => 'user_icon_default(sample).svg',
            '7' => 'user_icon_default(sample).svg',
            '8' => 'user_icon_default(sample).svg',
            '9' => 'user_icon_default(sample).svg',
        ];
        return $data;
    }
}
