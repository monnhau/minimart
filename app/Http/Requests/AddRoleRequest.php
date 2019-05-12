<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
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
            'name'=>'required|unique:role|max:30',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Error: Vui lòng điền tên',
            'name.unique'=>'Error: Tên đã tồn tại',
            'name.max'=>'Error: Tên quá dài',
        ];
    }
}
