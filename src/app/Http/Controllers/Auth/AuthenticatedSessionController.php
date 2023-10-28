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
}
