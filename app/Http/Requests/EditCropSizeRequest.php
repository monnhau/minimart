<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCropSizeRequest extends FormRequest
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
            'width'=>'required|numeric',
            'height'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'width.required'=>'Error: Nhập chiều rộng',
            'height.required'=>'Error: Nhập chiều cao',
            'width.numeric'=>'Error: Chiều rộng là một số',
            'height.numeric'=>'Error: Chiều cao là một số',
        ];
    }
}
