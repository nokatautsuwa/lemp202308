<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;


class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */


    // config/app.phpのtimezoneとlocaleを日本に設定
    // resources/lang/jpフォルダを作成してauth.php/validation.phpを作成
    // 各種エラーメッセージを日本語化してオーバーライド

    public function rules(): array
    {
        // バリデーションルール
        $rules = [
            'password' => ['required', 'regex:/\A(?=.?[a-z])(?=.*?\d)[a-zA-Z\d]{8,}+\z/'],
            'password_confirmation' => ['same:password'],
        ];

        if (request()->is('admin/*')) {
            // adminsの場合に追加するルールを定義
            $rules['name'] = ['required', 'unique:admins'];
            $rules['email'] = ['required', 'email', 'unique:admins'];
        } else {
            // admins以外の場合(users)に追加するルールを定義
            $rules['name'] = ['required'];
            $rules['account_id'] = ['required', 'regex:/\A([a-zA-Z0-9])+\z/u', 'unique:users'];
            $rules['email'] = ['required', 'email', 'unique:users'];
        }

        return $rules;
    }



    // user
    public function register(): void
    {
        // usersテーブルへ登録
        $user = User::create([
            'name' => $this->input('name'),
            'account_id' => $this->input('account_id'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
        ]);
        event(new Registered($user));
        // 登録したユーザーでログイン
        Auth::login($user);
    }



    // admin
    public function adminRegister(): void
    {
        // checkboxの状態を取得する
        $user_permission = $this->input('user-permission') ?? 0;
        $admin_permission = $this->input('admin-permission') ?? 0;
        $system_permission = $this->input('system-permission') ?? 0;

        // adminsテーブルへ登録
        $admin = Admin::create([
            'name' => $this->input('name'),
            'account_id' => $this->input('account_id'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
            'user_permission' => $user_permission,
            'admin_permission' => $admin_permission,
            'system_permission' => $system_permission,
        ]);
        event(new Registered($admin));
        // 登録したユーザーでログイン
        Auth::guard('admin')->login($admin);
    }

















}
