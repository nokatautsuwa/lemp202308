<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\Admin; // adminsテーブル
use Illuminate\Support\Facades\Validator; //バリデーション

class AdminProfileController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各ユーザーのプロフィール
    public function profile(Admin $admin, String $id)
    {
        // 引数$idを受け取って該当ユーザー情報を取得
        $admin = $admin->where('id', $id)->first();

        return view('admin.profile', compact('admin'));
    }
}
