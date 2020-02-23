<?php


namespace App\Http\Requests\RecruitmentEmployee;



use Illuminate\Foundation\Http\FormRequest;

class RecruitmentEmployeeRequests extends FormRequest
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
            'name'  => 'required|',
            'phone' => [
                'required','regex:/(084|\+84|09|03|07|08|05)+([0-9]{8})\b/iuU', 'unique:referal_users'
            ],
            'email' => 'required|email|unique:referal_users'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Trường này là trường bắt buộc phải nhập',
            'phone.required'    => 'Trường này là trường bắt buộc phải nhập',
            'phone.unique'      => 'Số điện thoại đã đăng ký',
            'phone.regex'       => 'Không đúng định dạng số điện thoại',
            'email.required'    => 'Trường này là trường bắt buộc phải nhậ',
            'email.email'       => 'Email không đúng định dạng',
            'email.unique'      => 'Email đã đăng ký',
        ];
    }

}
