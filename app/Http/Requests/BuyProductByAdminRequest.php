<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyProductByAdminRequest extends FormRequest
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
            'employer_id'=>'required',
            'package_type'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'employer_id.required' => 'Không để trống trường này',
            'package_type.required' => 'Không để trống trường này'
           ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (request()->package_type == 1 ) {
                if(empty(request()->package)){
                    $validator->errors()->add('package', 'Không để trống trường này');
                }
                if(empty(request()->count)){
                    $validator->errors()->add('count', 'Không để trống trường này');
                }

                if (!is_numeric(request()->count) && !empty(request()->count))
                {
                    $validator->errors()->add('count', 'Sai định dạng');
                }
                if (is_numeric(request()->count) && !empty(request()->count) && (int)request()->count<1)
                {
                    $validator->errors()->add('count', 'Số lượng gói không được nhỏ hơn 1');
                }
            }
            if (request()->package_type == 2) {

                if (!is_numeric(request()->count_view) && !empty(request()->count_view))
                {
                    $validator->errors()->add('count_view', 'Sai định dạng');
                }
                if (is_numeric(request()->count_view) && !empty(request()->count_view) && (int)request()->count_view<1)
                {
                    $validator->errors()->add('count_view', 'Số lượng  không được nhỏ hơn 1');
                }
                if (!is_numeric(request()->count_day_view) && !empty(request()->count_day_view))
                {
                    $validator->errors()->add('count_day_view', 'Sai định dạng');
                }
                if (is_numeric(request()->count_day_view) && !empty(request()->count_day_view) && (int)request()->count_day_view<1)
                {
                    $validator->errors()->add('count_day_view', 'Số lượng  không được nhỏ hơn 1');
                }
                if (!is_numeric(request()->count_employment_post) && !empty(request()->count_employment_post))
                {
                    $validator->errors()->add('count_employment_post', 'Sai định dạng');
                }
                if (is_numeric(request()->count_employment_post) && !empty(request()->count_employment_post) && (int)request()->count_employment_post<1)
                {
                    $validator->errors()->add('count_employment_post', 'Số lượng  không được nhỏ hơn 1');
                }
                if (!is_numeric(request()->count_day_employment_post) && !empty(request()->count_day_employment_post))
                {
                    $validator->errors()->add('count_day_employment_post', 'Sai định dạng');
                }
                if (is_numeric(request()->count_day_employment_post) && !empty(request()->count_day_employment_post) && (int)request()->count_day_employment_post<1)
                {
                    $validator->errors()->add('count_day_employment_post', 'Số lượng  không được nhỏ hơn 1');
                }
            }
        });
    }
}
