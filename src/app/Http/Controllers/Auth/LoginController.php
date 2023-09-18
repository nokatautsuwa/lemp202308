<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Controller
use App\Providers\RouteServiceProvider; // Redirect先を設定
use Illuminate\Foundation\Auth\AuthenticatesUsers; // 認証
use Illuminate\Http\Request; // inputフォーム
use App\Http\Requests\LoginRequest; // リクエストフォーム
use Illuminate\Http\RedirectResponse; // リクエストフォーム
use Illuminate\Support\Facades\Auth; // 認証
use Illuminate\Support\Facades\Validator; // バリデーション

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        // $this->middleware('guest')->except('logout');
    }





    // ログインしている場合は'/'または'admin/home'へリダイレクトさせる

    // user : 'app/Http/Middleware/RedirectIfAuthenticated.php'にguard('user')の処理を追加
    // admin : 'app/Http/Middleware/にRedirectIfAdminAuthenticated.php'を作成してguard('admin')の処理を追加
    //         -> 'app/Http/Kernel.php'に作成したmiddlewareを追加

    // web.phpの対象Routeにmiddleware('auth:admin')を追加する





    // User
    // -----------------------------------------------------------

    // Loginページ
    public function login()
    {
        return view("user.auth.login");
    }

    // ログイン
    public function loginAttempt(LoginRequest $request)
    {

        // LoginRequestでバリデーション

        // ログイン認証
        // --------------------------------------------
        // 入力欄それぞれの値を取得
        $account = $request->input('account');
        $password = $request->input('password');

        // preg_match(): 正規表現を使った判別方法でaccount欄の値がメールアドレスかどうか判定
        // $credentialsに配列で格納
        // usersテーブルを参照する(/config/auth.php)
        if (preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $account)) {
            // true: mailカラムとパスワードカラム
            $credentials = ['email' => $account, 'password' => $password];
        } else {
            // false: account_idカラムとパスワードカラム
            $credentials = ['account_id' => $account, 'password' => $password];
        }

        // $credentialsの組み合わせで認証->成功したら'/home'へリダイレクト
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect()->route('home');
        } else {
            // LoginRequestはクリアしたが$credentialsの組み合わせに該当するレコードがないケース
            return redirect()->route('login')->with('error', '* ログイン情報が正しくありません');
        }
        // --------------------------------------------
    }

    // -----------------------------------------------------------


    
    // Admin
    // -----------------------------------------------------------

    // Loginページ
    public function adminLogin()
    {
        return view("admin.auth.login");
    }

    public function adminLoginAttempt(LoginRequest $request)
    {

        // LoginRequestでバリデーション

        // ログイン認証
        // --------------------------------------------
        // 入力欄それぞれの値を取得
        $account = $request->input('account');
        $password = $request->input('password');

        // preg_match(): 正規表現を使った判別方法でaccount欄の値がメールアドレスかどうか判定
        // $credentialsに配列で格納
        // adminsテーブルを参照する(/config/auth.php)
        if (preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $account)) {
            // true: mailカラムとpasswordカラム
            $credentials = ['email' => $account, 'password' => $password];
        } else {
            // false: nameカラムとpasswordカラム
            $credentials = ['name' => $account, 'password' => $password];
        }

        // $credentialsの組み合わせで認証->成功したらadmin/homeへリダイレクト
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        } else {
            // LoginRequestはクリアしたが$credentialsの組み合わせに該当するレコードがないケース
            return redirect()->route('admin.login')->with('error', '* ログイン情報が正しくありません');
        }
        // --------------------------------------------
    }

    // -----------------------------------------------------------
}
