<?php


namespace App\Http\Requests\Company;

use Illuminate\Http\Request;

class NameCompanyRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'name_company' => 'email',
//            'name_company' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_company.unique'     => 'Tên công ty đã tồn tại',

        ];
    }
}
