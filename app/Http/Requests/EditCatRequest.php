<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCatRequest extends FormRequest
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
        $nameOld = $this->nameOld;
        return [
            'name'=>[
                'required',
                'max:50',
                Rule::unique('cat', 'name')->ignore($nameOld, 'name'), 
            ],
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
