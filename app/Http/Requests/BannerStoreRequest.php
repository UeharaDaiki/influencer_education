<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerStoreRequest extends FormRequest
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
            'banners.*' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'banners.*.required' => 'バナー画像を選択してください。',
            'banners.*.mimes' => 'jpeg, png, jpg, gif のいずれかの形式でアップロードしてください。',
            'banners.*.max' => '画像は2MB以下でアップロードしてください。',
        ];
    }
}
