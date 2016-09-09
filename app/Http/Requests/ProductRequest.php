<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'launched_at' => 'required',
            'site' => 'url'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '產品名稱 必填',
            'description.required' => '產品描述 必填',
            'category_id.required' => '類別 必填',
            'launched_at.required' => '釋出時間 必填',
            'site.url' => 'URL 必須是正確格式'
        ];
    }
}
