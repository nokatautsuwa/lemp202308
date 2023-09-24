<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // usersテーブル
use App\Models\Follow; // followsテーブル
use Illuminate\Support\Facades\Auth; // 認証
use Illuminate\Support\Facades\Hash; // ハッシュ化(デフォルトはBcrypt: config/hashing.phpで設定されている)

use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    protected function json(array $users_api)
    {
        // header()"関数"はセキュリティ脆弱性があるので使わない(header"メソッド"はOK)
        return response()->json(
            $users_api,
            200,
            ['Content-Type', 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }



    public function login(Request $request)
    {
        $result = false;
        $status = 401;
        $message = 'ユーザが見つかりません。';
        $user = null;

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // Success
            $result = true;
            $status = 200;
            $message = 'OK';
            $user = Auth::user();
            
        }

        return response()->json(['result' => $result, 'status' => $status, 'message' => $message, 'user' => $user]);
    }



    public function auth()
    {
        // SPA認証したユーザーを取得
        return $request->user(); 
    }



    // ログアウト
    public function logout(Request $request)
    {
        Auth::logout();
        // クッキーにあるトークンを削除
        $request->session()->invalidate();
        // セッションIDを再生成(セッションハイジャック対策)
        $request->session()->regenerateToken();
        // * ログアウト時にはこれらの処理を行うことが推奨されている

        return response()->json(['message' => 'ログアウトしました']);
    }
}
