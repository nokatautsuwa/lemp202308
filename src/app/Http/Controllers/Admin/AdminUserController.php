<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // usersテーブル
use App\Models\Pics; // picsテーブル
use App\Models\Admin; // adminsテーブル
use App\Models\UserHistory; // user_historiesテーブル

class AdminUserController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各管理者のプロフィール
    public function profile(
        User $users, 
        Pics $pics, 
        Admin $admins, 
        UserHistory $user_histories, 
        String $account_id)
    {
        // 管理者情報
        // --------------------------
        // 受け取った引数$account_idをUser.phpのeachUserAccountIdメソッドに渡して
        // 対象のレコードを取得
        $users = $users->eachUserAccountId($account_id);
        // 受け取った引数$account_idからusersテーブルのidを取得して$idに格納する
        $id = $users->id;
        // --------------------------

        // 担当者情報
        // --------------------------
        // $idをPics.phpのuserIdPicメソッドに渡して対象のレコードを取得
        $pics = $pics->userIdPic($id);
        // adminsを取得するための配列を作成
        $pics_array = []; // 初期化
        foreach ($pics as $pic) {
            // 配列に値が存在しない場合のみ追加
            if (!in_array($pic->admin_id, $pics_array)) {
                $pics_array[] = $pic->admin_id;
            }
        }
        // 取得したpicsレコードから該当のadminsレコードを取得する
        // システム管理者は除く
        $admins = $admins->whereIn('id', $pics_array)->where('system_permission', '<>', 1)->orderBy('updated_at', 'desc')->get();
        // --------------------------

        // 更新履歴
        // --------------------------
        // $idをUserHistory.phpのuserHistoryIdメソッドに渡して
        // 対象のレコードを取得
        $user_histories = $user_histories->userHistoryId($id);
        // UserHistory.phpから連想配列モデルを取得
        $user_histories_type_message = UserHistory::userHistoryTypeMessage();
        $user_histories_type_icon = UserHistory::userHistoryTypeIcon();
        // --------------------------
        
        return view('admin.profile.user', 
            compact(
                'users', 
                'admins', 
                'user_histories', 
                'user_histories_type_message',
                'user_histories_type_icon',
            ));
    }

























}
