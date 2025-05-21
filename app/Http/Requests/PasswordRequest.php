<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => '旧パスワードは必須です。',
            'new_password.required' => '新パスワードは必須です。',
            'new_password.min' => '新パスワードは8文字以上で入力してください。',
            'new_password.confirmed' => '新しいパスワードが確認用と一致しません。',
            'new_password_confirmation.required' => '新パスワード確認は必須です。',
        ];
    }
}
