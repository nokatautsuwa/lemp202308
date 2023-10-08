<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Place;
use App\Models\Area;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;    

class AdminRegisterController extends Controller
{
    // 新規登録ページ
    public function create(Admin $admins, Place $places, Area $areas)
    {
        // Admin.phpからログイン情報及び配属先/エリアの選択肢を設定
        $admins = $admins->authAdmin();
        $place_list = $places->place();
        $area_list = $areas->area();

        return view('admin.register', compact('admins', 'place_list', 'area_list'));
    }

    // 登録
    public function store(RegisterRequest $request): RedirectResponse 
    {
        // 登録処理(メソッドはRequest/Auth/LoginRequest.phpにある)
        $request->adminRegister();

        // どのアカウントが作成されたかを取得するための情報を設定する
        $admin_name = $request->input('name');

        // リダイレクト
        return redirect(RouteServiceProvider::ADMIN_HOME)->with('success', '* 管理者名: '.$admin_name.'を作成しました');
    }
}
