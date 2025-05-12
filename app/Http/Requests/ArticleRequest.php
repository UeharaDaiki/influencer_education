<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'postedDate' => 'required',
            'title' => 'required',
            'contents' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'postedDate.required' => '投稿日時は必須です。',
            'title.required'      => 'タイトルは必須です。',
            'contents.required'   => '本文は必須です。',
        ];
    }
}
