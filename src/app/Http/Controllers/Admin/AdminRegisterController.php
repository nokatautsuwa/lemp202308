<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;    

class AdminRegisterController extends Controller
{
    // 新規登録ページ
    public function create(Admin $admin)
    {
        // Admin.phpからログイン情報及び配属先/エリアの選択肢を設定
        $admin = $admin->authAdmin();
        $place = $admin->place();
        $area = $admin->area();

        return view('admin.register', compact('admin', 'place', 'area'));
    }

    // 登録
    public function store(RegisterRequest $request): RedirectResponse 
    {
        // バリデーションが成功したらRegisterRequestのadminRegisterクラスを$adminを渡して実行
        $request->adminRegister();

        // どのアカウントが作成されたかを取得するための情報を設定する
        $created_account = $request->input('name');

        // リダイレクト
        return redirect(RouteServiceProvider::ADMIN_HOME)->with('success', '* 管理者名: '.$created_account.'を作成しました');
    }
}
