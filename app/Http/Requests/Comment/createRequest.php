<?php

namespace App\Http\Requests\Comment;

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
            'description' => 'required|string|max:200'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => '評論不能是空白的。',
            'description.string' => '評論必須是字串。',
            'description.max' => '評論最多只能 :max 個字',
        ];
    }
}
