<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PurchaseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method' => 'required|string|max:255',
            'post_code' => ['required', 'string', 'regex:/^\d{3}-\d{4}$/'],
            'recipient' => 'required|string|max:255'
        ];
    }
    public function messages()
    {
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex' => '郵便番号は「123-4567」の形式で入力してください',
            'recipient.required' => '配送先を入力してください',
            'recipient.string' => '配送先を文字列で入力してください',
        ];
    }
}
