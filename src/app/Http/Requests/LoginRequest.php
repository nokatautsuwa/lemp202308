<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // LoginRequestの使用を許可
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'account' => 'required',
            'password' => 'required',
        ];
    }

    // エラーメッセージ
    public function messages()
    {
        return [
            'account.required' => '* 入力してください',
            'password.required' => '* 入力してください',
        ];
    }
}
