<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;    

class RegisteredAdminController extends Controller
{
    // 新規登録ページ
    public function create()
    {
        return view('admin.auth.register');
    }

    // 登録
    public function store(RegisterRequest $request): RedirectResponse 
    {
        // バリデーションが成功したらRegisterRequestのadminRegisterクラスを$adminを渡して実行
        $request->adminRegister();
        // リダイレクト
        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}
