<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\User; // usersテーブル
use App\Models\Profile; // profilesテーブル
use Illuminate\Support\Facades\Validator; //バリデーション
use Illuminate\Support\Facades\Storage; //ファイルアクセス
// use Intervention\Image\ImageManagerStatic as Image; // ファイルサイズ軽量化パッケージ: composer require intervention/imageでインストール

// 画像のリサイズやエンコードはReactでやる

class UserProfileController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各ユーザーのプロフィール
    public function profile(User $user, String $account_id)
    {
        // 受け取った引数$account_idをUser.phpのeachUserAccountId functionに渡して
        // 対象のusersテーブル情報を取得
        $user = $user->eachUserAccountId($account_id);

        // ページ要素の取得はReactで行う
        // 1. api.phpでAPI URLを指示
        // 2. ApiXXXXControllerで取得したDBをJSONに変換して指定したAPI URLページで表示する
        // 3. ReactからAPI URLを取得
        return view('user.profile', compact('user'));
    }



































}
