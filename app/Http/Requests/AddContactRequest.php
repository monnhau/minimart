<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddContactRequest extends FormRequest
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
        $username = $this->username;
        if (strpos($username, '@') !== false) {
            return [
                'username'=>'required|email|regex:/^[a-z A-Z 0-9 @ .]{3,50}$/',
                'fullname'=>'required|max:30',
                'content'=>'required',
            ];
        }else{
            return [
                'username'=>'required|regex:/^[0-9]{3,50}$/',
                'fullname'=>'required|max:30',
                'content'=>'required',
            ];
        }

        
    }

    public function messages()
    {
        return [
            'username.required'=>'Error: Nhập số điện thoại hoặc email',
            'username.regex'=>'Error: Số điện thoại hoặc email chứa kí tự không hợp lệ hoặc độ dài không đúng(3-50)',
            'fullname.required'=>'Error: Nhập họ tên',    
            'fullname.max'=>'Error: Fullname qúa dài',   
            'content.required'=>'Error: Nhập nội dung muốn gửi!'
        ];
    }
}
