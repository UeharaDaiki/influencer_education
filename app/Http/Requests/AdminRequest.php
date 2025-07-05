<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        // 管理者の新規登録に必要なバリデーションルール
        return [
            'name' => 'required|max:255',
            'name_kana' => 'required|max:255|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        //　各バリデーションルールに対するエラーメッセージ
        return [
            'name.required' => 'ユーザーネームを入力してください',
            'name.max' => '255文字以内で入力してください',
            'name_kana.required' => 'ユーザーネームの読み仮名を入力してください',
            'name_kana.max' => '255文字以内で入力してください',
            'name_kana.regex' => 'カタカナで入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレス形式で入力してください',
            'email.max' => '255文字以内で入力してください',
            'email.unique' => 'このメールアドレスはすでに使用されています',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => '上記パスワードと一致しません',
            'password_confirmation.required' => '確認パスワードを入力してください',
        ];
    }
}
