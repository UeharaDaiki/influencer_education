<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryTimesRequest extends FormRequest
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
            //配列の場合配列全体と要素とそれぞれチェックする
            // 配列全体
            'delivery_from' => 'required|array',
            'delivery_to' => 'required|array',
            // 各要素
            'delivery_from.*' => 'required|date',
            'delivery_to.*' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
        'delivery_from.required' => '開始日時は必須項目です',
        'delivery_to.required' => '終了日時は必須項目です',
        'delivery_from.*.required' => '開始日時は必須項目です',
        'delivery_to.*.required' => '終了日時は必須項目です'
        ];
    }
}
