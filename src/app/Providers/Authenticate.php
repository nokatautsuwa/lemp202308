<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // ログインしていない状態で認証が必要なページへアクセスした時のリダイレクト先
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // $uri = $request->path();
            if ($request->routeIs('admin.*')) {
                // admin
                return route('admin.login');
            } else {
                // user
                return route('login');
            }
            return $request->expectsJson() ? null : route('login');
        }
    }
}
