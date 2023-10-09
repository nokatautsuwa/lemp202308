<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRequestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Auth: auth.phpをインポート
require __DIR__.'/auth.php';



// user
// ------------------------------------------------

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ログインしている場合
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ------------------------------------------------



// admin: 基本全ページ未ログイン状態では閲覧不可
// prefix('admin'): グループ内全ルートのURLに"admin/"を追加
// name('admin.'): 名前付きルートのプレフィックス(ルート名の先頭に"admin."が追加される)
// ------------------------------------------------

Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // 新規登録
    // * 管理者側はシステム管理者権限または管理者編集権限を持っているアカウントのみ新規登録ができるようにする
    Route::get('register', [AdminRegisterController::class, 'create'])->name('register');
    Route::post('register', [AdminRegisterController::class, 'store'])->name('register');

    // ホーム画面
    Route::get('home', [AdminHomeController::class, 'index'])->name('home');

    // 管理者/システム管理者ページ: bladeから連想配列パラメータ(key: idに対応するvalue値(adminsテーブルのid))を受け取る
    // -------------------------------
    Route::get('profile/{id}', [AdminProfileController::class, 'profile'])->name('profile');
    // 管理者のプロフィール更新
    Route::patch('profile/{id}/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    // キャンセル
    Route::get('profile/{id}/cancel', [AdminProfileController::class, 'cancel'])->name('profile.cancel');
    // アカウント論理削除
    Route::delete('profile/{id}/softdelete', [AdminProfileController::class, 'softDelete'])->name('profile.softdelete');
    // アカウントレコード削除
    Route::delete('profile/{id}/destroy', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
    // -------------------------------

    // ユーザー管理ページ: bladeから連想配列パラメータ(key: account_idに対応するvalue値(usersテーブルのaccount_id))を受け取る
    // -------------------------------
    Route::get('user/{account_id}', [AdminUserController::class, 'user'])->name('user');
    // ユーザー情報更新
    Route::patch('user/{account_id}/edit', [AdminUserController::class, 'edit'])->name('user.edit');
    // アカウント論理削除
    Route::delete('user/{account_id}/softdelete', [AdminUserController::class, 'softDelete'])->name('user.softdelete');
    // アカウントレコード削除
    Route::delete('user/{account_id}/destroy', [AdminUserController::class, 'destroy'])->name('user.destroy');
    // キャンセル
    Route::get('user/{account_id}/cancel', [AdminUserController::class, 'cancel'])->name('user.cancel');
    // -------------------------------

    // 申請
    Route::get('request', [AdminRequestController::class, 'request'])->name('request');

});
// ------------------------------------------------