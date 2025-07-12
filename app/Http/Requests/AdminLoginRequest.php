<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.regex:/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/' => '半角英数8文字以上で入力してください',
        ];
    }
}
