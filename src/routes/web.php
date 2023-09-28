<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminHomeController;
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

    // ホーム画面
    Route::get('home', [AdminHomeController::class, 'index'])->name('home');

    // プロフィール: bladeから連想配列パラメータ(key: account_idに対応するvalue値(adminsテーブルのid))を受け取る
    // -------------------------------
    // アカウントページ
    Route::get('profile/{id}', [AdminProfileController::class, 'profile'])->name('profile');
    // 各種設定: ユーザー編集権限/管理者権限で条件を出す
    // 0/0: 無/自分のプロフィール編集のみ
    // 1/0: 有/自分のプロフィール編集のみ
    // 0/1: 無/所属部署の管理者の編集可
    // 1/1: 有/所属部署の管理者の編集可
    // システム管理者: 全部署全権限あり(未実装)
    Route::put('profile/{id}/edit', [AdminProfileController::class, 'update'])->name('settings');
    // アカウント削除: bladeから連想配列パラメータ(key: idに対応するvalue値(adminsテーブルのid))を受け取る
    Route::delete('profile/{id}/destroy', [AdminProfileController::class, 'destroy'])->name('delete');
    // -------------------------------
    // 申請
    Route::get('request', [AdminRequestController::class, 'request'])->name('request');

});
// ------------------------------------------------