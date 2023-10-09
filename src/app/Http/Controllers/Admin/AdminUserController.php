<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\User; // usersテーブル
use App\Models\Pics; // picsテーブル
use App\Models\Admin; // adminsテーブル
use App\Models\UserHistory; // user_historiesテーブル
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各管理者のプロフィール
    public function user(
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



    // キャンセル
    public function cancel(String $account_id)
    {
        return redirect()->back()->with('success', '* キャンセルしました');
    }



    // ユーザー情報の変更
    public function edit(Request $request, User $users, String $account_id): RedirectResponse 
    {
        // パスワードが一致しない場合は中止
        // -------------------------------------
        if (!Hash::check($request->input('password'), Auth::guard('admin')->user()->password)) {
            if ($request->input('password') === null) {
                return redirect()->back()->withInput()->with('success', '* 更新にはログインパスワードが必要です');
            } else {
                return redirect()->back()->withInput()->with('success', '* パスワードが違います');
            }
        }
        // -------------------------------------

        // 該当ユーザーのレコードを取得する
        $users = $users->eachUserAccountId($account_id);

        // 復旧のチェックにチェックが入っている場合のみ実行する
        if ($request->input('recover') !== null) {
            $users->deleted_at = null;
            $users->update();
            $users->save();
            $user_message = '* ' . $users->name . 'を復旧しました';
        } else {
            $user_message = '* 復旧にチェックを入れてください';
        }
        // リダイレクト
        return redirect()->back()->with('success', $user_message);
    }



    // アカウント論理削除
    public function softDelete(Request $request, User $users, String $account_id): RedirectResponse 
    {
        // パスワードが一致しない場合は中止
        // -------------------------------------
        if (!Hash::check($request->input('password'), Auth::guard('admin')->user()->password)) {
            if ($request->input('password') === null) {
                return redirect()->back()->withInput()->with('success', '* 削除にはログインパスワードが必要です');
            } else {
                return redirect()->back()->withInput()->with('success', '* パスワードが違います');
            }
        }
        // -------------------------------------

        // 該当ユーザーのレコードを取得する
        $users = $users->eachUserAccountId($account_id);

        // どのアカウントが削除されたかを取得するための情報を設定する
        $user_message = '* ' . $users->name . 'を削除しました';

        // 該当ユーザーのdeleted_atに現在時刻を入れて保存
        // save()でupdated_atが現在時刻に更新される
        $users->deleted_at = now();
        $users->save();

        // ホーム画面へ
        return redirect()->back()->with('success', $user_message);

    }



    // アカウントレコード削除
    public function destroy(Request $request, User $users, String $account_id): RedirectResponse 
    {
        // パスワードが一致しない場合は中止
        // -------------------------------------
        if (!Hash::check($request->input('password'), Auth::guard('admin')->user()->password)) {
            if ($request->input('password') === null) {
                return redirect()->back()->withInput()->with('success', '* 削除にはログインパスワードが必要です');
            } else {
                return redirect()->back()->withInput()->with('success', '* パスワードが違います');
            }
        }
        // -------------------------------------
        // 該当ユーザーのレコードを取得する
        $users = $users->eachUserAccountId($account_id);

        // 削除するアカウントのid名のフォルダごと削除する
        // * config/filesystems.phpの'disks'にあるメソッドを要確認
        Storage::deleteDirectory('public/images/user/' . $users->id, true);

        // どのアカウントが削除されたかを取得するための情報を設定する
        $user_message = '* ' . $users->name . 'を削除しました';

        // 削除処理
        $users->delete();
        // ホーム画面へ
        return redirect()->route('admin.home')->with('success', $user_message);

    }























}
