<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSlideRequest extends FormRequest
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
            'desc_text'=>'required|max:40',
            'detail_text'=>'required|max:300'
        ];
    }

    public function messages()
    {
        return [
            'desc_text.required'=>'Error: Nhập mô tả',
            'desc_text.max'=>'Error: Nhập mô tả quá dài',
            'detail_text.required'=>'Error: Nhập chi tiết',
            'detail_text.max'=>'Error: Nhập chi tiết quá dài',
        ];
    }
}
