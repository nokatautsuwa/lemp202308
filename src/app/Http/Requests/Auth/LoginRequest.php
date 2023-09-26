<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */



    // config/app.phpのtimezoneとlocaleを日本に設定
    // resources/lang/jpフォルダを作成してauth.php/validation.phpを作成
    // 各種エラーメッセージを日本語化してオーバーライド

    public function rules(): array
    {
        // バリデーションルール
        return [
            'account' => ['required'],
            'password' => ['required'],
        ];
    }



    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // user
    public function authenticate(): void
    {
        // ensureIsNotRateLimitedメソッド実行
        $this->ensureIsNotRateLimited();

        // preg_match(): 正規表現を使った判別方法でaccount欄の値がメールアドレスかどうか判定
        // $credentialsに配列で格納
        // adminsテーブルを参照する(/config/auth.php)
        if (preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $this->input('account'))) {
            // true: mailカラムとpasswordカラム
            $credentials = [
                'email' => $this->input('account'),
                'password' => $this->input('password')
            ];
        } else {
            // false: account_idカラムとpasswordカラム
            $credentials = [
                'account_id' => $this->input('account'),
                'password' => $this->input('password')
            ];
        }

        // 認証: ログインに失敗したとき
        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            // throttleKeyに指定されたユーザーのログイン試行回数を追加
            RateLimiter::hit($this->throttleKey());
            // デフォルトの設定はvendor/laravel/framework/src/Illuminate/Translation/lang/en/auth.phpの連想配列
            throw ValidationException::withMessages([
                'account' => trans('auth.failed'),
            ]);
        }
        // throttleKeyに指定されたユーザーのログイン試行回数をリセット
        RateLimiter::clear($this->throttleKey());
    }


    
    // admin
    public function adminAuthenticate(): void
    {

    }



    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        // throttleKeyに指定されたユーザーが5回連続でログインに失敗するとLockoutイベントを実行する
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }
        event(new Lockout($this));
        
        // ロックアウトが解除されるまでの秒数を取得
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // ロックアウト時のメッセージを表示
        throw ValidationException::withMessages([
            'account' => trans('auth.throttle', [
                'seconds' => $seconds, // 秒単位で表示する場合
                'minutes' => ceil($seconds / 60), // 分単位で表示する場合
            ]),
        ]);
    }



    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        // メールアドレスとIPアドレスをパイプで連結した文字列を返してメールアドレスは小文字で統一される
        // (transliterate: ASCII文字のみを返している)
        // 入力されたメールアドレスorアカウントIDとアクセス元のIPでユーザーを認識している
        return Str::transliterate(Str::lower($this->input('account')).'|'.$this->ip());
    }
}
