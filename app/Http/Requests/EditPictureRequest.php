<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPictureRequest extends FormRequest
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
            'hinhanh'=>'required',
            'hinhanh'=>'mimes:jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
            'hinhanh.required'=>'Vui lòng chọn ảnh',
            'hinhanh.mimes'=>'File chọn không đúng định dạng hình ảnh',
        ];
    }
}
