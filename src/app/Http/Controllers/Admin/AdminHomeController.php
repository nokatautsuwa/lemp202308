<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; //extend
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider; // Redirect先を設定
use App\Models\User; // usersテーブル
use Illuminate\Support\Facades\Auth; // 認証

class AdminHomeController extends Controller
{
    public function index(User $user)
    {
        // ホーム画面
        $users = $user->allUser();
        return view('admin.home', compact('users'));
    }





    // ログアウト
    // $request->session()->invalidate()を使用するとuserもログアウトされるので使用しない
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        // adminセッション情報を削除
        $request->session()->forget('admin');
        // セッションIDを再生成(セッションハイジャック対策)
        $request->session()->regenerateToken();
        // * ログアウト時にはこれらの処理を行うことが推奨されている
        return redirect()->route('admin.login')->with('success', '* ログアウトしました');
    }
}
