<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 認証
use App\Models\Admin; // adminsテーブル
use App\Models\Place; // placesテーブル
use App\Models\Area; // areasテーブル
use App\Models\Pics; // picsテーブル
use App\Models\User; // usersテーブル
use App\Models\AdminHistory; // admin_historiesテーブル
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AdminProfileController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    // 各管理者のプロフィール
    public function profile(
        Admin $admins,
        Place $places,
        Area $areas,
        Pics $pics, 
        User $users, 
        AdminHistory $admin_histories, 
        Int $id)
    {
        // 管理者情報
        // --------------------------
        // 受け取った引数$idをAdmin.phpのidAdminメソッドに渡して
        // 対象のレコードを取得/及び配属先/エリアの選択肢を設定
        $admins = $admins->idAdmin($id);
        $place_list = $places->place();
        $area_list = $areas->area();
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
                'place_list', 
                'area_list',
                'users', 
                'admin_place', 
                'admin_system', 
                'admin_except_system', 
                'admin_histories', 
                'admin_histories_type_message',
                'admin_histories_type_icon',
            ));
    }



    // 各管理者のプロフィール変更
    public function edit(Request $request, Admin $admins, Int $id): RedirectResponse 
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
        $admins = $admins->idAdmin($id);


        // アイコン画像のアップロード
        // 事前にシンボリックリンクを作成する
        // -------------------------------------
        if ($request->hasFile('images')) {

            // アップロードされている場合

            // ファイル名を指定して作成
            $file_name = '/icon_' . $admins->id  . '.webp';

            // ディレクトリを取得
            $directory = 'public/images/admin/' . $admins->id;
            // ディレクトリが存在しない場合に作成する
            if (!Storage::exists($directory)) {
                // 0777: 読み取り/書き込み/実行の権限を全てのユーザーに許可する
                // 第3引数をtrueにすることで再帰的にディレクトリを作成する
                Storage::makeDirectory($directory, 0777, true);
            }

            // "storage/app/public/images/admin/$admins->id/"配下にアップロードした画像を保存
            // 'storage/app/'をルートにして格納するフォルダを指定する
            // storeAs('保存するディレクトリ', 'ファイル名')
            // シンボリックリンクで'storage/app/public/'と'storage/'が対応している
            // config/filesystems.phpのdisks/local/rootで設定されている
            $request->images->storeAs($directory, $file_name);

            // adminsテーブルimageカラムに格納するパスを作成
            // '/storage/images/admin/'までは共通でbladeに記述しているので以降のパスを$file_path変数に格納
            // 最終的なパスはid: 1のアカウントの場合'storage/admin/1/icon_1.webp'となる
            $file_path = $admins->id . '/icon_' . $admins->id  . '.webp';

        } else {

            // imageにデータがない(アップロードされていない)場合

            // adminsテーブルimageカラムの値をそのまま取得
            $file_path = $admins->image;

        }
        // -------------------------------------
        

        // バリデーション(* Requestでは$idをrules()メソッドに渡す方法が難しい)
        // メールアドレス欄が空欄かどうかで$validatorの条件を分ける
        // -------------------------------------
        if ($request->input('email') === null) {

            // 自分のレコードのみuniqueから削除
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:admins,name,' . $id,
            ]);
            // バリデーションエラー処理
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('success', '* 無効な入力値があったため中止しました');
            }

            // 更新処理: emailカラムの更新はなし
            // 特定のレコードに対して操作を行う場合はモデルインスタンスを取得して操作することが一般的
            $admins->name = $request->input('name');
            $admins->place = $request->input('place');
            $admins->area = $request->input('area');
            $admins->image = $file_path;

        } else {

            // 自分のレコードのみuniqueから削除
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:admins,name,' . $id,
                'email' => 'email|unique:admins,email,' . $id,
            ]);
            // バリデーションエラー処理
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('success', '* 無効な入力値があったため中止しました');
            }

            // 更新処理
            // 特定のレコードに対して操作を行う場合はモデルインスタンスを取得して操作することが一般的
            $admins->name = $request->input('name');
            $admins->email = $request->input('email');
            $admins->place = $request->input('place');
            $admins->area = $request->input('area');
            $admins->image = $file_path;

        }
        // -------------------------------------
        $admins->update();
        $admins->save();

        // リダイレクト
        return redirect()->back()->with('success', '* 編集しました');
    }



    // キャンセル
    public function cancel(Int $id)
    {
        return redirect()->back()->with('success', '* キャンセルしました');
    }



    // アカウント論理削除
    public function softDelete(Request $request, Admin $admins, Int $id): RedirectResponse
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
        $admins = $admins->idAdmin($id);

        // どのアカウントが削除されたかを取得するための情報を設定する
        $admin_name = $admins->name;
        $admin_message = '* 管理者レコードNo.' . $id . ': ' . $admin_name . 'を削除しました';

        // 該当ユーザーのdeleted_atに現在時刻を入れて保存
        // save()でupdated_atが現在時刻に更新される
        $admins->deleted_at = now();
        $admins->update();
        $admins->save();

        // 削除するアカウントがログインユーザー自身かどうかで処理を分ける
        if ($id === Auth::guard('admin')->user()->id) {

            // ログアウト処理
            Auth::guard('admin')->logout();
            // adminセッション情報を削除
            $request->session()->invalidate();
            // XSRFトークンを再生成
            $request->session()->regenerateToken();
            // ログイン画面へ
            return redirect()->route('admin.login')->with('success', $admin_message);

        } else {

            // ホーム画面へ
            return redirect()->route('admin.home')->with('success', $admin_message);

        }

    }



    // アカウントレコード削除
    public function destroy(Request $request, Admin $admins, Int $id): RedirectResponse 
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
        $admins = $admins->idAdmin($id);

        // 削除するアカウントのid名のフォルダごと削除する
        // * config/filesystems.phpの'disks'にあるメソッドを要確認
        Storage::deleteDirectory('public/images/admin/' . $admins->id, true);

        // どのアカウントが削除されたかを取得するための情報を設定する
        $admin_name = $admins->name;
        $admin_message = '* 管理者レコードNo.' . $id . ': ' . $admin_name . 'を削除しました';

        // 削除するアカウントがログインユーザー自身かどうかで処理を分ける
        if ($id === Auth::guard('admin')->user()->id) {

            // ログアウト処理
            Auth::guard('admin')->logout();
            // adminセッション情報を削除
            $request->session()->invalidate();
            // XSRFトークンを再生成
            $request->session()->regenerateToken();
            // 削除処理
            $admins->delete();
            // ログイン画面へ
            return redirect()->route('admin.login')->with('success', $admin_message);

        } else {

            // 削除処理
            $admins->delete();
            // ホーム画面へ
            return redirect()->route('admin.home')->with('success', $admin_message);

        }

    }


























    



}
