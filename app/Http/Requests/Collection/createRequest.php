<?php

namespace App\Http\Requests\Collection;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:200'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名稱不能是空白的。',
            'name.string' => '名稱必須是字串。',
            'name.max' => '評論最多只能 :max 個字',

            'description.required' => '描述不能是空白的。',
            'description.string' => '描述必須是字串。',
            'description.max' => '描述最多只能 :max 個字',
        ];
    }
}
