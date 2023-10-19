<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    // userログイン画面
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            // パスワードリセットのリンクが有効であるかどうかを示すブール値
            'canResetPassword' => Route::has('password.request'),
            // セッションから'status'というキーで保存されたデータを取得し、Inertiaコンポーネントに渡す
            'status' => session('status'),
        ]);
    }

    // adminログイン画面
    public function adminCreate()
    {
        return view("admin.auth.login");
    }



    /**
     * Handle an incoming authentication request.
     */
    // userログイン認証
    public function store(LoginRequest $request): RedirectResponse
    {
        // 認証(メソッドはRequest/Auth/LoginRequest.phpにある)
        $request->authenticate();
        // セッションを再生成
        $request->session()->regenerate();
        // ログイン後の画面へリダイレクト
        // セッションタイムアウト時にユーザーの直前のリクエストが存在しない場合はRouteServiceProvider::USER_HOMEへリダイレクトさせる
        return redirect()->intended(RouteServiceProvider::USER_HOME);
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



    /**
     * Destroy an authenticated session.
     */
    // userログアウト
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        // userセッション情報を削除
        $request->session()->invalidate();
        // XSRFトークンを再生成
        $request->session()->regenerateToken();
        // RouteServiceProvider::HOMEへリダイレクト
        return redirect(RouteServiceProvider::HOME);
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
