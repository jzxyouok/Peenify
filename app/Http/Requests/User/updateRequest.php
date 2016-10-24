<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'name' => 'required|min:3',
            'description' => 'max:300',
            'avatar' => 'sometimes|required|image|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名稱是必填',
            'name.min' => '名稱最小長度是 :min 個字',
            'description.max' => '簡介最大長度是 :max 個字',
            'avatar.max' => '頭像最大尺寸為 :max kb',
            'avatar.image' => '頭像必須是 jpeg、png、bmp、gif、 或 svg 格式'
        ];
    }
}
