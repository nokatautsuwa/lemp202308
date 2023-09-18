<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // 追加


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// エントランス
// Route::get('/', [HomeController::class, 'index'])->name('home');


// ここまでプリイン





// Auth
// * ControllersのAuthフォルダはLaravelの認証機能が正常に動作するために必要なフォルダ
// * 移動すると動作しなくなる可能性がある
// * マルチ認証機能を実装する場合でもAuthフォルダはそのままにしておいた方がいい
// * 基本ログインしていない時のみアクセスできるようにする
// --------------------------------------------------

// namespace('App\Http\Controllers\Auth'): 'App\Http\Controllers\Auth'以下のControllerを指定
Route::namespace('App\Http\Controllers\Auth')
    ->group(function () {

        // userでログインしていない場合のみ
        Route::middleware('guest')
            ->group(function () {

                Route::get('register', 'RegisterController@register')->name('register');
                Route::post('register', 'RegisterController@registerAdd')->name('register.add');
                Route::get('login', 'LoginController@login')->name('login');
                Route::post('login', 'LoginController@loginAttempt')->name('login.attempt');

            });

        // adminでログインしていない場合のみ
        // prefix('admin'): グループ内全ルートのURLに"admin/"を追加
        // name('admin.'): 名前付きルートのプレフィックス(ルート名の先頭に"admin."が追加される)
        Route::middleware('guest.admin')
            ->prefix('admin')
            ->name('admin.')
            ->group(function () {

                Route::get('register', 'RegisterController@adminRegister')->name('register');
                Route::post('register', 'RegisterController@adminRegisterAdd')->name('register.add');
                Route::get('login', 'LoginController@adminLogin')->name('login');
                Route::post('login', 'LoginController@adminLoginAttempt')->name('login.attempt');

            });

    });

// --------------------------------------------------





// User
// --------------------------------------------------

// namespace('App\Http\Controllers\User'): 'App\Http\Controllers\User'以下のControllerを指定
Route::namespace('App\Http\Controllers\User')
    ->group(function () {

        // ゲストでもアクセスできるページ
        // -----------------------------
        // ホーム画面(あとで''を'/home'にリダイレクトさせるようにする)
        Route::get('home', 'UserHomeController@index')->name('home');

        // 各ユーザープロフィール: bladeから連想配列パラメータ(key: account_idに対応するvalue値(usersテーブルのaccount_id))を受け取る
        // * getリクエストが実在するページなので'home''login''register''settings'は無効にする
        //   (アカウントIDは半角英数/数字/記号は'-''_'のみの許可なので'/'のバリデーションはここでは実装していない)
        Route::get('{account_id}', 'UserProfileController@profile')->name('profile');
        // -----------------------------

        // userでログインしている場合にのみアクセスできるページ/メソッド
        // auth;userでuserのguardを判定する
        // -----------------------------
        Route::middleware('auth:user')
            ->group(function () {

                // アカウント設定
                // -------------------------------
                Route::name('profile.')
                    ->group(function () {

                        // 各種設定画面
                        Route::get('settings', 'UserProfileController@settings')->name('settings');
                        // 更新(Reactに移行予定)
                        Route::put('update', 'UserProfileController@updateProfile')->name('update');
                        // アカウント削除
                        Route::delete('delete', 'UserProfileController@delete')->name('delete');

                    });
                // -------------------------------

                // ログアウト
                Route::post('logout', 'UserHomeController@logout')->name('logout');

            });
        // -----------------------------

    });
// --------------------------------------------------





// Administer
// --------------------------------------------------

// namespace('App\Http\Controllers\Admin'): 'App\Http\Controllers\Admin'以下のControllerを指定
// prefix('admin'): グループ内全ルートのURLに"admin/"を追加
// name('admin.'): 名前付きルートのプレフィックス(ルート名の先頭に"admin."が追加される)
// middleware('auth:admin'): ログイン/新規登録以外のadminエリアは全ページログインしている場合のみ
// auth;userでuserのguardを判定する
Route::namespace('App\Http\Controllers\Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {

        // ホーム画面
        Route::get('home', 'AdminHomeController@index')->name('home');

        // プロフィール: bladeから連想配列パラメータ(key: account_idに対応するvalue値(adminsテーブルのid))を受け取る
        Route::get('{id}', 'AdminProfileController@profile')->name('profile');

        // アカウント設定: Adminエリアは他のAdminユーザーを更新するケースもあるためUserと違い{id}の引数を入れている
        // name('profile.'): 名前付きルートのプレフィックス(ルート名の先頭に"profile."が追加される)
        // -------------------------------
        Route::name('profile.')
            ->group(function () {

                // 各種設定
                Route::put('{id}/settings', 'AdminProfileController@updateProfile')->name('settings');
                // 更新
                Route::put('{id}/update', 'AdminProfileController@updateProfile')->name('update');
                // アカウント削除: bladeから連想配列パラメータ(key: idに対応するvalue値(adminsテーブルのid))を受け取る
                Route::delete('{id}/delete', 'AdminProfileController@delete')->name('delete');

            });
        // -------------------------------

        // ログアウト
        Route::post('logout', 'AdminHomeController@logout')->name('logout');

    });

// --------------------------------------------------