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
            'name' => ['required'],
            'password' => ['required', 'regex:/\A(?=.?[a-z])(?=.*?\d)[a-zA-Z\d]{8,}+\z/'],
            'password_confirmation' => ['same:password'],
        ];

        if (Str::contains($this->url(), 'admin/')) {
            // adminsの場合に追加するルールを定義
            $rules['email'] = ['email', 'required', 'unique:admins'];
        } else {
            // admins以外の場合(users)に追加するルールを定義
            $rules['account_id'] = ['required', 'regex:/\A([a-zA-Z0-9])+\z/u', 'unique:users'];   
            $rules['email'] = ['email', 'required', 'unique:users'];
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

    }

















}
