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
        return [
            //'email'    =>'required|email',
            'email'    => 'required',
            //'password' =>'required|max:30|min:6',
            'password' =>'required|between:6,30',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    =>'Email hoặc sđt là trường bắt buộc',
            'password.required' =>'Mật khẩu là trường bắt buộc',
            'password.between'  =>'Mật khẩu phải từ :min đến :max ký tự',
        ];
    }
}
