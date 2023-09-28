<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // ログインしている状態で認証用ページへアクセスした時のリダイレクト先
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        
        if ($request->routeIs('admin.*')) {

            // admin
            if (Auth::guard('admin')->check()) {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }

        } else {

            // user
            if (Auth::check()) {
                return redirect(RouteServiceProvider::USER_HOME);
            }

        }

        return $next($request);
    }
}
