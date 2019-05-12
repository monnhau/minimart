<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCatRequest extends FormRequest
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
            'name'=>'required|unique:cat|max:50',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Lỗi: Vui long điền tên danh mục!',
            'name.unique'=>'Lỗi: Trùng tên danh mục có sẵn!',
            'name.max'=>'Lỗi: Tên danh mục quá dài!',
        ];
    }
}
