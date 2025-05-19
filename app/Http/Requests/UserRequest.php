<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'name_kana' => ['required', 'string', 'regex:/^[ァ-ヶー ]+$/u', 'min:1', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前が入力されていません。',
            'name.min' => '1文字以上で入力してください。',
            'name.max' => '255文字以内で入力してください。',

            'name_kana.required' => 'カナが入力されていません。',
            'name_kana.regex' => 'カナ文字入力してください。',
            'name_kana.max' => '255文字以内で入力してください。',

            'email.required' => 'メールアドレスが入力されていません。',
            'email.email' => 'メール形式で入力してください。',
            'email.max' => '255文字以内で入力してください。',
            'email.unique' => 'すでに使用されているメールアドレスです。',

            'password.required' => 'パスワードが入力されていません。',
            'password.min' => '8文字以上で入力してください。',
            'password.confirmed' => 'パスワード確認が一致しません。',
        ];
    }
}
