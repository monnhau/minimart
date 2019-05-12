<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name'=>'required|unique:product|',
            'desc_text'=>'max:200',
            'km_text'=>'max:500',
            'detail_text'=>'max:2000',
            'id_cat'=>'required',
            'unit_le_char'=>'required|max:30',
            'price_le'=>'required|min:1|integer|digits_between:1,8',
            'unit_si_int'=>'nullable|min:1|integer|digits_between:1,10',
            'price_si'=>'nullable|min:1|integer|digits_between:1,10',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Error: Nhập tên sản phẩm',
            'name.unique'=>'Error: Tên trùng với sản phẩm đã tồn tại',
            'desc_text.max'=>'Error: Mô tả quá dài',
            'detail_text.max'=>'Error: Chi tiết quá dài',
            'km_text.max'=>'Error: Thông tin khuyến mãi quá dài',
            'id_cat.required'=>'Error: Nhập danh mục thuộc về',
            'unit_le_char.required'=>'Error: Nhập đơn vị lẻ nhỏ nhất',
            'unit_le_char.max'=>'Error: ĐVLNN quá dài',
            'price_le.required'=>'Error: Nhập giá lẻ',
            'price_le.min'=>'Error: Giá bán lẻ là số lớn hơn 0',
            'unit_si_int.min'=>'Error: ĐVSNN là số lớn hơn 0',
            'price_si.min'=>'Error: Giá bán sỉ là số lớn hơn 0',
            'price_le.digits_between'=>'Error: Giá bán lẻ quá lớn',
            'unit_si_int.digits_between'=>'Error: ĐVSNN quá lớn',
            'price_si.digits_between'=>'Error: Giá bán sỉ quá lớn',
            'price_le.integer'=>'Error: Giá bán lẻ không hợp lệ',
            'unit_si_int.integer'=>'Error: ĐVSNN không hợp lệ',
            'price_si.integer'=>'Error: Giá bán sỉ không hợp lệ',
        ];
    }
}
