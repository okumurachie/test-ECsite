<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '品名を入力してください',
            'name.string' => '品名を文字列で入力してください',
            'price.required' => '価格を入力してください',
            'price.numeric' => '価格を半角数字で入力してください',
            'stock.numeric' => '在庫数を半角数字で入力してください',
            'image.required' => '画像を選択してください'
        ];
    }
}
