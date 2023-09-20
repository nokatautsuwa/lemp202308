<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ここまでプリイン




// JSON Apiとして取得(Controller)
// namespace('App\Http\Controllers\Api'): 'App\Http\Controllers\Api'以下のControllerを指定
// -----------------------------
Route::namespace('App\Http\Controllers\Api')
    ->middleware('api')
    ->group(
        function () {

            // users
            // prefix('user'): グループ内全ルートのURLに"users/"を追加
            // -------------------------------------------------------
            Route::prefix('users')
                ->group(function () {
                    // ログインユーザーのデータを取得
                    Route::middleware('auth:api')
                        ->group(function () {
                            Route::get('auth', 'ApiProfileController@auth');
                        });
                    // 対象のaccount_idデータを引数に格納して取得
                    Route::get('{account_id}', 'ApiProfileController@accountId');
                });
            // -------------------------------------------------------

            // apiの設定はapp\Http\Kernel.phpの$middlewareGroups = api => []に書いてある
        }
    );
// -----------------------------