<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 権限
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
            'title'        => 'required',
            'description'  => 'required',
            'video_url'    => 'required',
            'grade_id'     => 'required',
            'always_delivery_flg' => 'required'
        ];
    }

    public function messages() {
        return [
            'title.required' => '授業名は入力必須項目です。',
            'description.required' => '授業概要は入力必須項目です。',
            'video_url.required' => '動画URLは入力必須項目です。',
            'grade_id' => '学年は入力必須項目です。',
        ];
    }
}
