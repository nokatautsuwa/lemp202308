<?php

namespace App\Http\Controllers\Auth; // 認証Controller

use App\Http\Controllers\Controller; // extend
use App\Models\User; // usersテーブル
use App\Models\Profile; // profilesテーブル
use App\Models\Admin; // adminsテーブル
use App\Http\Requests\RegisterRequest; // リクエストフォーム
use Illuminate\Support\Facades\Auth; // 認証
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // user/admin両方に干渉するのでコメントアウトして下記で設定
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */




    // ログインしている場合は'/'または'admin/home'へリダイレクトさせる

    // user : 'app/Http/Middleware/RedirectIfAuthenticated.php'にguard('user')の処理を追加
    // admin : 'app/Http/Middleware/にRedirectIfAdminAuthenticated.php'を作成してguard('admin')の処理を追加
    //         -> 'app/Http/Kernel.php'に作成したmiddlewareを追加

    // web.phpの対象Routeにmiddleware('auth:admin')を追加する





   // User
    // -----------------------------------------------------------

    // Registerページ
    public function register()
    {
        return view('user.auth.register');
    }

    // 登録
    public function registerAdd(
        RegisterRequest $request,
        User $user,
        Profile $profile
    ) {

        // バリデーションが成功したらRegisterRequestのuserRegisterクラスを$userを渡して実行
        $request->userRegister($user);

        // 登録したアカウントでログイン認証: Authを取得するための認証なので失敗時の条件分岐はしない
        // config/auth.phpでguardsとprovidersに設定を追加する
        // --------------------------------------------
        // account_id/passwordの値を取得
        $account_id = $request->input('account_id');
        $password = $request->input('password');

        // $credentialsに配列で格納
        $credentials = ['account_id' => $account_id, 'password' => $password];

        // $credentialsの組み合わせで認証
        if (Auth::guard('user')->attempt($credentials)) {
            // profilesテーブルにレコードを追加する
            $profile->create([
                'user_id' => Auth::guard('user')->user()->id,
            ]);
            // '/home'へリダイレクト
            return redirect()->route('home');
        }
        // --------------------------------------------
    }

    // -----------------------------------------------------------



    // Admin
    // -----------------------------------------------------------

    // Registerページ
    public function adminRegister()
    {
        return view('admin.auth.register');
    }

    // 登録
    public function adminRegisterAdd(
        RegisterRequest $request,
        Admin $admin
    ) {

        // バリデーションが成功したらRegisterRequestのadminRegisterクラスを$adminを渡して実行
        $request->adminRegister($admin);

        // 登録したアカウントでログイン認証: Authを取得するための認証なので失敗時の条件分岐はしない
        // config/auth.phpでguardsとprovidersに設定を追加する
        // --------------------------------------------
        // email/passwordの値を取得
        $email = $request->input('email');
        $password = $request->input('password');

        // $credentialsに配列で格納
        $credentials = ['email' => $email, 'password' => $password];

        // $credentialsの組み合わせで認証
        if (Auth::guard('admin')->attempt($credentials)) {
            //'admin/home'へリダイレクト
            return redirect()->route('admin.home');
        }
        // --------------------------------------------
    }

    // -----------------------------------------------------------
}