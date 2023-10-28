<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;



// guestでadminとuserそれぞれのリダイレクト先を設定している



// user
// ------------------------------------------------

// ログインしていない場合
Route::middleware('guest')->group(function () {

    // getにnameメソッドを追加して同じrouteのget/post両方にnameメソッドを適用している

    // 新規登録
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    // ログイン
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    // パスワード再設定
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

});


// ログインしている場合
Route::middleware('auth')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // ログアウト
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

// ------------------------------------------------



// admin
// prefix('admin'): グループ内全ルートのURLに"admin/"を追加
// name('admin.'): 名前付きルートのプレフィックス(ルート名の先頭に"admin."が追加される)
// ------------------------------------------------

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

    // ログインしていない場合
    Route::middleware('guest')
        ->group(function () {

        // ログイン
        Route::get('login', [AdminLoginController::class, 'adminCreate'])->name('login');
        Route::post('login', [AdminLoginController::class, 'adminStore'])->name('login');

        // パスワード登録
        Route::get('password/register', [AdminLoginController::class, 'adminPasswordCreate'])->name('password');
        Route::post('password/register', [AdminLoginController::class, 'adminPasswordStore'])->name('password.add');

    });


    // ログインしている場合
    Route::middleware('auth:admin')
        ->group(function () {
            
        // ログアウト
        Route::post('logout', [AdminLoginController::class, 'adminDestroy'])->name('logout');

        });

});

// --------------------------------------------------