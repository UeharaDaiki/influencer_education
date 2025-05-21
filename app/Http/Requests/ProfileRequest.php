<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'kana' => 'required|regex:/\A[ァ-ヴー]+\z/u',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'kana.required'      => 'カナは必須です。',
            'kana.regex'     => 'カナはカタカナで入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email'    => 'メールアドレスの形式が正しくありません。',
        ];
    }
}
