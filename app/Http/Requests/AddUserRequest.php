<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            $this->request->add(['typeUsername' => 'email']); //add request
            return [
                'username'=>'required|unique:users|email|regex:/^[a-z A-Z 0-9 @ .]{3,50}$/',
                'password'=>'required|regex:/^[a-z A-Z 0-9]{4,50}$/',
                'repassword'=>'same:password',
                'fullname'=>'nullable|max:30',
            ];
        }else{
            $this->request->add(['typeUsername' => 'phone']); //add request
            return [
                'username'=>'required|unique:users|regex:/^[0-9]{3,50}$/',
                'password'=>'required|regex:/^[a-z A-Z 0-9]{4,50}$/',
                'repassword'=>'same:password',
                'fullname'=>'nullable|max:30',
            ];
        }

        
    }

    public function messages()
    {
        return [
            'username.required'=>'Error: Nhập số điện thoại hoặc email',
            'username.email'=>'Error: Định dạng email chưa đúng',
            'username.unique'=>'Error: Số điện thoại hoặc email đã tồn tại',
            'username.regex'=>'Error: Số điện thoại hoặc email chứa kí tự không hợp lệ hoặc độ dài không đúng(3-50)',
            'password.required'=>'Error: Nhập mật khẩu',
            'password.regex'=>'Error: Password chứa kí tự không hợp lệ hoặc độ dài không đúng(4-50)',
            'repassword.same'=>'Error: Mật khẩu nhập lại không khớp',
            'fullname.max'=>'Error: Fullname qúa dài',     
        ];
    }
}
