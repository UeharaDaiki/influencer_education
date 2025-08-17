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
            'banners.*' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'banners.*.mimes' => 'jpeg, png, jpg, gif のいずれかの形式でアップロードしてください。',
            'banners.*.max' => '画像は2MB以下でアップロードしてください。',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $newBanners = $this->file('banners', []);
            $existingBannersCount = \App\Models\Banner::count();

            if (count($newBanners) === 0 && $existingBannersCount === 0) {
                $validator->errors()->add('banners', 'バナー画像を1つ以上選択してください。');
            }
        });
    }

}
