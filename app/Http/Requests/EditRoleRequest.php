<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class EditRoleRequest extends FormRequest
{
    /**
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
            'name' =>'required|unique:roles',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     =>'Tên vai trò không được để trống',
            'name.unique'       =>'Vai trò đã tồn tại',
        ];
    }
}
