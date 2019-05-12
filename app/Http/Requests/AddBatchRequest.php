<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBatchRequest extends FormRequest
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
            'nsx_d'=>'required',
            'nsx_m'=>'required',
            'nsx_y'=>'required',
            'hsd_d'=>'required',
            'hsd_m'=>'required',
            'hsd_y'=>'required',
            'qty'=>'required|numeric|min:0|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'qty.required'=>'Error: Vui lòng nhập số lượng',
            'qty.numeric'=>'Error: Số lượng là một số!',
            'qty.min'=>'Error: Số lượng cần lớn hơn 0',
            'qty.not_in'=>'Error: Số lượng cần lớn hơn 0',
        ];
    }
}
