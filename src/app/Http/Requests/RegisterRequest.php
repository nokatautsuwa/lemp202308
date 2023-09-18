<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User; // usersテーブル
use App\Models\Admin; // adminsテーブル
use Illuminate\Support\Facades\Hash; // ハッシュ化(デフォルトはBcrypt: config/hashing.phpで設定されている)

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // RegisterRequestの使用を許可
        return true;
    }





    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'max:20'],
            'password' => ['regex:/\A(?=.?[a-z])(?=.*?\d)[a-zA-Z\d]{8,}+\z/'],
            'password-confirm' => ['same:password'],
        ];

        if ($this->route()->getName() === 'register.add') {
            // usersのみ追加のルールを定義
            $rules['account_id'] = ['regex:/\A([a-zA-Z0-9])+\z/u', 'unique:users'];
            $rules['email'] = ['email', 'unique:users'];
        } elseif ($this->route()->getName() === 'admin.register.add') {
            // adminsのみ追加のルールを定義
            $rules['email'] = ['email', 'unique:admins'];
        }

        return $rules;
    }





    // エラーメッセージ
    public function messages()
    {
        return [
            'name.required' => '* 入力してください',
            'name.max' => '* 20文字以内で入力してください',
            'account_id.regex' => '* 半角英数字で入力してください',
            'account_id.unique' => '* このアカウントIDは既に使用されています',
            'email.email' => '* メールアドレスを入力してください',
            'email.unique' => '* このメールアドレスは既に使用されています',
            'password.regex' => '* 半角英数字それそれ含む8文字以上で入力してください',
            'password-confirm.same' => '* パスワード欄の入力内容と一致していません',
        ];
    }




    
    // バリデーションクリア後レコードを作成

    // User
    // ----------------------------------------------------------
    public function userRegister($user)
    {
        // usersテーブルにレコードを作成
        return $user->create([
            'name' => $this->input('name'),
            'account_id' => $this->input('account_id'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
        ]);
    }
    // ----------------------------------------------------------

    // Admin
    // ----------------------------------------------------------
    public function adminRegister($admin)
    {
        // checkboxの状態を取得する
        $user_authority = $this->input('user-authority') ?? 0;
        $admin_authority = $this->input('admin-authority') ?? 0;

        // adminsテーブルにレコードを作成
        return $admin->create([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
            'user_authority' => $user_authority,
            'admin_authority' => $admin_authority,
        ]);
    }
    // ----------------------------------------------------------
}
