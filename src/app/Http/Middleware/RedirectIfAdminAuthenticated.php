<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAdminAuthenticated
{
    public function handle($request, Closure $next)
    {
        // RouteServiceProvider.php
        if (Auth::guard('admin')->check()) {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }

        return $next($request);
    }
}