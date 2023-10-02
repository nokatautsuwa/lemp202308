<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminHistory extends Model
{
    use HasFactory;

    // 複数代入の危険性を避けるために$fillableか$guardedのどちらか一方を予め設定しておく必要がある
    // $fillable: レコード編集を許可してよいカラム(ホワイトリスト)
    // $guarded: レコード編集を許可しないカラム(ブラックリスト)
    // 履歴のため全てブラックリスト
    
    // JSONに含まれなくなる
    protected $hidden = [
        'admin_name',
    ];
    protected $guarded = [
        'admin_id',
        'admin_name',
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
    public static function adminHistoryId(Int $id)
    {
        return AdminHistory::where('admin_id', $id)->orderBy('created_at', 'desc')->get();
    }

    // typeカラムの値をキーとした各種メッセージの連想配列モデルを作成
    // (typeはString型)
    public static function adminHistoryTypeMessage()
    {
        $data = [
            '1' => 'アカウント登録',
            '2' => 'プロフィールを編集',
            '3' => '所属/エリアの変更',
            '4' => '権限を設定',
            '5' => 'ユーザーの担当を変更',
            '9' => 'アカウント削除',
        ];
        return $data;
    }

    // typeカラムの値をキーとした各種メッセージアイコンパスの連想配列モデルを作成
    // (typeはString型)
    public static function adminHistoryTypeIcon()
    {
        $data = [
            '1' => 'admin_icon_default(sample).svg',
            '2' => 'admin_icon_default(sample).svg',
            '3' => 'admin_icon_default(sample).svg',
            '4' => 'admin_icon_default(sample).svg',
            '5' => 'admin_icon_default(sample).svg',
            '9' => 'admin_icon_default(sample).svg',
        ];
        return $data;
    }
}
