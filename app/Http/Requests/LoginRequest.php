<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
                'username'=>'required|email|regex:/^[a-z A-Z 0-9 @ .]{3,50}$/',
                'password'=>'required|regex:/^[a-z A-Z 0-9]{4,50}$/',
            ];
        }else{
            $this->request->add(['typeUsername' => 'phone']); //add request
            return [
                'username'=>'required|regex:/^[0-9]{3,50}$/',
                'password'=>'required|regex:/^[a-z A-Z 0-9]{4,50}$/',
            ];
        }
    }

    public function messages()
    {
        return [
            'username.required'=>'Error: Nhập số điện thoại hoặc email',
            'username.email'=>'Error: Định dạng email chưa đúng',
            'username.regex'=>'Error: Số điện thoại hoặc email chứa kí tự không hợp lệ hoặc độ dài không đúng(3-50)',
            'password.required'=>'Error: Nhập mật khẩu',
            'password.regex'=>'Error: Mật khẩu chứa kí tự không hợp lệ hoặc độ dài không đúng(4-50)',
        ];
    }
}
