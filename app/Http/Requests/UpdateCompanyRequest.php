<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name_company' => 'required|unique:companies,name,'. request()->route('id'),
            'logo'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'address'      => 'required',
            'workplace'      => 'required',
            'sale_size'      => 'required|numeric',
            'company_size'      => 'nullable|numeric',
            'email' =>['required','regex:/^(([^<>()\[\]\\\\.,;:\s@"]+(\.[^<>()\[\]\\\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'hotline' =>['required'],
            'website' =>['required','regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/m'],
            'about_us'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_company.required'     => 'Trường này là trường bắt buộc phải nhập',
            'name_company.unique'       => 'Đã tồn tại trong hệ thống ',
            'logo.required'             => 'Trường này là trường bắt buộc phải nhập',
            'logo.image'                => 'Không đúng định dạng',
            'sale_size.numeric'         => 'Không đúng định dạng',
            'address.required'          => 'Trường này là trường bắt buộc phải nhập',
            'workplace.required'        => 'Trường này là trường bắt buộc phải nhập',
            'sale_size.required'        => 'Trường này là trường bắt buộc phải nhập',
            'email.required'            => 'Trường này là trường bắt buộc phải nhập',
            'email.regex'               => 'Nhập sai định dạng email',
            'email.unique'              => 'Đã tồn tại trong hệ thống',
            'hotline.required'          => 'Trường này là trường bắt buộc phải nhập',
            'hotline.unique'            => 'Đã tồn tại trong hệ thống',
            'website.required'          => 'Trường này là trường bắt buộc phải nhập',
            'website.regex'             => 'Nhập sai định dạng',
            'about_us.required'         => 'Trường này là trường bắt buộc phải nhập',
            'company_size.required'     => 'Trường này là trường bắt buộc phải nhập',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if (!empty(request()->hotline)) {
                $tel = request()->hotline;
                if (mb_detect_encoding(request()->hotline) != 'ASCII') {
                    $tel = iconv(mb_detect_encoding(request()->hotline), 'ASCII//IGNORE//TRANSLIT', request()->hotline);
                }
                $re = '/^(0|084|\+84)(\s|\.)?(2[1-9]{2}|(3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/';

                preg_match($re, $tel, $matches, PREG_OFFSET_CAPTURE, 0);

                if (count($matches)==0) {
                    $validator->errors()->add('hotline', 'Nhập sai định dạng');
                }
            }
        });
    }
}
