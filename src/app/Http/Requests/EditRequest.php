<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'add_stock' => 'nullable|integer|min:0',
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
        ];
    }
}
