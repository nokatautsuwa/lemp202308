<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; //extend
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証

class UserHomeController extends Controller
{
    // ホーム画面
    public function index()
    {
        return view('user.home');
    }





    // ログアウト
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        // userセッション情報を削除
        $request->session()->forget('user');
        // セッションIDを再生成(セッションハイジャック対策)
        $request->session()->regenerateToken();
        // * ログアウト時にはこれらの処理を行うことが推奨されている
        return redirect()->route('login')->with('success', '* ログアウトしました');
    }
}
