<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\Admin; // adminsテーブル

class AdminProfileController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各ユーザーのプロフィール
    public function profile(Admin $admin, String $id)
    {
        // 受け取った引数$idをAdmin.phpのidUserメソッドに渡して
        // 対象のレコードを取得
        $admin = $admin->idUser($id);

        return view('admin.profile.profile', compact('admin'));
    }



}
