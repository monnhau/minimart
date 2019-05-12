<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
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
        $usernameOld = $this->usernameOld;
        $username = $this->username;
        if (strpos($username, '@') !== false) {
            return [
                'username'=>[
                    'required',
                    'email',
                    'regex:/^[a-z A-Z 0-9 @ .]{3,50}$/',
                    Rule::unique('users', 'username')->ignore($usernameOld, 'username'), 
                ],
                'oldpassword'=>'required|regex:/^[a-z A-Z 0-9]{4,50}$/',
                'password'=>'nullable|regex:/^[a-z A-Z 0-9]{4,50}$/',
                'repassword'=>'same:password',
                'fullname'=>'nullable|max:30',
            ];
        }else{
            return [
                'username'=>'required|unique:users|regex:/^[0-9]{3,50}$/',
                'oldpassword'=>'required|regex:/^[a-z A-Z 0-9]{4,50}$/',
                'password'=>'nullable|regex:/^[a-z A-Z 0-9]{4,50}$/',
                'repassword'=>'same:password',
                'fullname'=>'nullable|max:30',
            ];
        }

    }

    public function messages()
    {
        return [
            'username.required'=>'Error: Nhập username',
            'username.unique'=>'Error: Số điện thoại hoặc email đã tồn tại',
            'username.email'=>'Error: Định dạng email chưa đúng',
            'username.regex'=>'Eror: Số điện thoại hoặc email chứa kí tự không hợp lệ hoặc độ dài không đúng(3-50)',
            'oldpassword.regex'=>'Error: Mật khẩu cũ chứa kí tự không hợp lệ hoặc độ dài không đúng(4-50)',
            'oldpassword.required'=>'Error: Nhập mật khẩu cũ',
            'password.regex'=>'Error: Mật khẩu mới chứa kí tự không hợp lệ hoặc độ dài không đúng(4-50)',
            'repassword.same'=>'Error: Mật khẩu nhập lại không khớp',
            'fullname.max'=>'Error: Fullname qúa dài',           
        ];
    }
}
