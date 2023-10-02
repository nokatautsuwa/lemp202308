<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\Admin; // adminsテーブル
use App\Models\Pics; // picsテーブル
use App\Models\User; // usersテーブル
use App\Models\AdminHistory; // admin_historiesテーブル

class AdminProfileController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各管理者のプロフィール
    public function profile(
        Admin $admins, 
        Pics $pics, 
        User $users, 
        AdminHistory $admin_histories, 
        Int $id)
    {
        // 管理者情報
        // --------------------------
        // 受け取った引数$idをAdmin.phpのidAdminメソッドに渡して
        // 対象のレコードを取得
        $admins = $admins->idAdmin($id);
        // --------------------------

        // 担当ユーザー情報
        // --------------------------
        // 受け取った引数$idをAdmin.phpのadminIdPicメソッドに渡して
        // 対象のレコードを取得
        $pics = $pics->adminIdPic($id);
        // usersを取得するための配列を作成
        $pics_array = []; // 初期化
        foreach ($pics as $pic) {
            // 配列に値が存在しない場合のみ追加
            if (!in_array($pic->user_id, $pics_array)) {
                $pics_array[] = $pic->user_id;
            }
        }
        // 取得したpicsレコードから該当のusersレコードを取得する
        $users = $users->whereIn('id', $pics_array)->orderBy('updated_at', 'desc')->get();
        // --------------------------

        // 同じ所属会社の管理者情報
        // --------------------------
        // 受け取った引数$idをAdmin.phpのidAdminPlaceメソッドに渡して
        // 対象のレコードを取得
        $place = $admins->place;
        $admin_place = $admins->idAdminPlace($place);
        // --------------------------

        // システム管理者情報
        // --------------------------
        // Admin.phpのsystemAdminメソッドから対象のレコードを取得
        $admin_system = $admins->systemAdmin();
        // --------------------------

        // システム管理者以外の情報
        // --------------------------
        // Admin.phpのsystemAdminメソッドから対象のレコードを取得
        $admin_except_system = $admins->exceptSysytemAdmin();
        // --------------------------

        // 更新履歴
        // --------------------------
        // 受け取った引数$idをAdminHistory.phpのadminHistoryIdメソッドに渡して
        // 対象のレコードを取得
        $admin_histories = $admin_histories->adminHistoryId($id);
        // AdminHistory.phpから連想配列モデルを取得
        $admin_histories_type_message = AdminHistory::adminHistoryTypeMessage();
        $admin_histories_type_icon = AdminHistory::adminHistoryTypeIcon();
        // --------------------------
        
        return view('admin.profile.profile', 
            compact(
                'admins', 
                'users', 
                'admin_place', 
                'admin_system', 
                'admin_except_system', 
                'admin_histories', 
                'admin_histories_type_message',
                'admin_histories_type_icon',
            ));
    }





























    



}
