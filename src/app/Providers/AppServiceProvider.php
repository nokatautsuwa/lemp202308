<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // ページが表示されたときに実行する
    public function boot(): void
    {
        // URLに'admin'がある場合、cookie_adminセッションを利用する
        // config/session.php
        if (request()->is('admin/*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
    }
}
