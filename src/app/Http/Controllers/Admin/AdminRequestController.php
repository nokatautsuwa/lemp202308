<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\Admin; // adminsテーブル

class AdminRequestController extends Controller
{
    // 申請
    // Admin権限を持っている同じ配属先の上長への各種申請
    public function request(Admin $admin)
    {
        // Admin.phpのauthAdminメソッドからログインレコードを取得
        $admin = $admin->authAdmin();

        return view('admin.profile.request', compact('admin'));
    }
}
