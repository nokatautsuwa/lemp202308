<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // adminログイン画面
    public function adminCreate()
    {
        return view("admin.auth.login");
    }



    // adminログイン認証
    public function adminStore(LoginRequest $request, Admin $admins): RedirectResponse
    {
        // ログイン認証前の確認
        // ------------------------------------
        // preg_match(): 正規表現を使った判別方法でaccount欄の値がメールアドレスかどうか判定してそのレコードを取得
        if (preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $request->input('account'))) {
            $admins = $admins->where('email', $request->input('account'))->first();
        } else {
            $admins = $admins->where('name', $request->input('account'))->first();
        }

        // アカウントの確認
        if(!$admins) {
            // ログインしようとしているアカウントが存在しない場合は戻す
            return redirect()->back()->withInput()->with('success', '* このアカウントは存在しません');
        } elseif($admins->password === null) {
            // ログインしようとしているアカウントにパスワードが設定されていない場合はパスワード登録画面にリダイレクトさせる
            return redirect()->route('admin.password')->with('success', '* パスワードが登録されていません。登録をお願いいたします。');
        } elseif ($admins->deleted_at !== null) {
            // ログインしようとしているアカウントが論理削除状態の場合は戻す
            return redirect()->back()->withInput()->with('success', '* このアカウントは削除されています');
        }
        // ------------------------------------

        // 認証(メソッドはRequest/Auth/LoginRequest.phpにある)
        // ------------------------------------
        $request->adminAuthenticate();
        // ------------------------------------
        
        // XSRFトークンを再生成
        $request->session()->regenerateToken();
        // ログイン後の画面へリダイレクト
        // セッションタイムアウト時にユーザーの直前のリクエストが存在しない場合はRouteServiceProvider::ADMIN_HOMEへリダイレクトさせる
        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }



    // adminパスワード登録画面
    public function adminPasswordCreate()
    {
        // 認証(メソッドはRequest\LoginRequest.phpにある)
        return view("admin.auth.passwords.register");
    }



    // adminログアウト
    public function adminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        // adminセッション情報を削除
        $request->session()->invalidate();
        // XSRFトークンを再生成
        $request->session()->regenerateToken();
        // '/admin/login'へリダイレクト
        return redirect()->route('admin.login')->with('success', '* ログアウトしました');
    }

}
