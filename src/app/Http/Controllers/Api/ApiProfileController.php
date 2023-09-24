<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User; // usersテーブル
use App\Models\Follow; // followsテーブル
use Illuminate\Support\Facades\Auth; // 認証

class ApiProfileController extends Controller
{
    // Dependency Injectionを使用してModelのインスタンスを自動で取得/$変数名として使用できるようになる

    protected function json(array $users_api)
    {
        // header()"関数"はセキュリティ脆弱性があるので使わない(header"メソッド"はOK)
        return response()->json(
            $users_api,
            200,
            ['Content-Type', 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }



    public function accountId(User $user, Follow $follow, String $account_id)
    {
        // 受け取った引数$account_idをUser.phpのeachUserAccountId functionに渡して
        // 対象のusersテーブル情報を取得
        $user = $user->eachUserAccountId($account_id);

        // followsテーブルを利用して該当ユーザーのフォロー数/フォロワー数を取得して
        // usersテーブルのfollow_count, follower_countを更新する
        $follow_count = $follow->where('follow_id', $user->id)->count();
        $follower_count = $follow->where('follower_id', $user->id)->count();
        $user->update([
            'follow_count' => $follow_count,
            'follower_count' => $follower_count,
        ]);

        // users/profilesから受け取った引数$account_idに関わる情報のみ取得
        $users_api = $user->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'users.name',
                'users.account_id',
                'users.follow_count',
                'users.follower_count',
                'users.bio',
                'users.image',
                'users.created_at',
                'profiles.birth',
            )
            ->where('account_id', $account_id)
            ->first();
        // json形式でapiを表示
        // 単一のモデルインスタンスのため配列に変換する
        return $this->json($users_api->toArray());
    }

    public function auth(Request $request)
    {
        // 'user_snc'ガードで認証されたユーザーを取得
        $user_api = $request->user('user_snc'); 

        // json形式でapiを表示
        // 単一のモデルインスタンスのため配列に変換する
        return $this->json($users_api->toArray());
    }
}
