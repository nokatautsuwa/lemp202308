<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; //extend
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider; // Redirect先を設定
use App\Models\User; // usersテーブル
use Illuminate\Support\Facades\Auth; // 認証

class AdminHomeController extends Controller
{
    public function index(User $users)
    {
        // ホーム画面
        $users = $users->allUser();
        return view('admin.home', compact('users'));
    }
}
