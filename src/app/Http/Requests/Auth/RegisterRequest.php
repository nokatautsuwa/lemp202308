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
        if (request()->is('admin/*')) {

            $rules = [
                'name' => ['required', 'unique:admins'],
                'email' => ['required', 'email', 'unique:admins'],
            ];

        } else {

            // admins以外
            $rules = [
                'name' => ['required'],
                'account_id' => ['required', 'regex:/\A([a-zA-Z0-9])+\z/u', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'regex:/\A(?=.?[a-z])(?=.*?\d)[a-zA-Z\d]{8,}+\z/'],
                'password_confirmation' => ['same:password'],
            ];

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
        // システム管理者のcheckboxの状態を取得する
        $system_permission = $this->input('system-permission') ?? 0;

        // システム管理者にチェックが入っている場合
        // ユーザー管理権限/admin管理権限は強制的に0にする
        if($system_permission !== 0) {

            $user_permission = 0;
            $admin_permission = 0;

        } else {
            $user_permission = $this->input('user-permission') ?? 0;
            $admin_permission = $this->input('admin-permission') ?? 0;

        }

        // adminsテーブルへ登録
        // * passwordは自身で設定させるようにするためここでは追加しない
        $admin = Admin::create([
            'name' => $this->input('name'),
            'account_id' => $this->input('account_id'),
            'email' => $this->input('email'),
            'place' => $this->input('place'),
            'area' => $this->input('area'),
            'user_permission' => $user_permission,
            'admin_permission' => $admin_permission,
            'system_permission' => $system_permission,
        ]);
        event(new Registered($admin));
    }

















}
