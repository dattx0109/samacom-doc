<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateJobRequest extends FormRequest
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
            'company_id' => 'required',
            'title' => 'required',
            'job_expire' =>'required|date_format:"d-m-Y"|after:today',
            'level_id' => 'required',
            'job_type' => 'required',
            'province_id' => 'required',
            'gender' => 'required',
            'field_work_id' => 'required',
            'income_min' =>['nullable','required_if:income_type,2','regex:/^[0-9]*$/m'],
            'income_max' =>['nullable','required_if:income_type,2','regex:/^[0-9]*$/m'],
            'base_salary_min' =>['nullable','required_if:salary_base_type,2','regex:/^[0-9]*$/m'],
            'base_salary_max' =>['nullable','required_if:salary_base_type,2','regex:/^[0-9]*$/m'],
            'description' =>['required'],
            'requirements' =>['required'],
            'benefit' =>['required'],
            'type' =>['required'],
            'tag' =>['required'],
        ];
    }

    public function messages()
    {
        return [
            'company_id.required' => 'Không để trống trường này.',
            'title.required' => 'Không để trống trường này.',
            'job_type.required' => 'Không để trống trường này.',
            'province_id.required' => 'Không để trống trường này.',
            'gender.required' => 'Không để trống trường này.',
            'income_min.required_if' => 'Không để trống trường này.',
            'income_max.required_if' => 'Không để trống trường này.',
            'base_salary_min.required_if' => 'Không để trống trường này.',
            'base_salary_max.required_if' => 'Không để trống trường này.',
            'description_name.required' => 'Không để trống trường này.',
            'requirements.required' => 'Không để trống trường này.',
            'benefit.required' => 'Không để trống trường này.',
            'income_min.regex' => 'Trường này không đúng định dạng.',
            'base_salary_min.regex' => 'Trường này không đúng định dạng.',
            'base_salary_max.regex' => 'Trường này không đúng định dạng.',
            'income_max.regex' => 'Trường này không đúng định dạng.',
            'field_work_id.required' => 'Không để trống trường này.',
            'level_id.required' => 'Không để trống trường này.',
            'job_expire.required'=>'Không để trống trường này.',
            'job_expire.date_format'=>'Trường này không đúng định dạng.',
            'job_expire.after'=>'Ngày không được nhỏ hơn ngày hôm ',
            'type.required'=>'Không để trống trường này.',
            'tag.required'=>'Không để trống trường này.'
        ];
    }
    public function withValidator($validator)
    {

        $validator->after(function ($validator) {
            $errors = $validator->errors()->messages();
            if (request()->income_type==2) {
                if (!array_key_exists('income_min', $errors) && !array_key_exists('income_max', $errors)) {
                    if (request()->income_min > request()->income_max) {
                        $errors['income_max']=['Thu nhập tối thiểu lớn hơn thu nhập tối đa'];
                    }
                }
            }
            if (request()->salary_base_type==2) {
                if (!array_key_exists('base_salary_max', $errors) && !array_key_exists('base_salary_min', $errors)) {
                    if (request()->base_salary_min > request()->base_salary_max) {
                        $errors['base_salary_max'] = ['Lương cứng tối thiểu lớn  hơn lương cứng tối đa'];
                    }
                }
            }
            if (request()->income_type==2) {
                if (!array_key_exists('income_min', $errors) && !array_key_exists('base_salary_min', $errors)) {
                    if (request()->base_salary_min > request()->income_min) {
                        $errors['base_salary_min'] = ['Lương cứng tối thiểu lớn hơn thu nhập tối thiểu'];
                    }
                }
            }
            if (request()->income_type==2) {
                if (!array_key_exists('income_max', $errors) && !array_key_exists('base_salary_max', $errors)) {
                    if (request()->base_salary_max > request()->income_max) {
                        $errors['base_salary_max'] = ['Lương cứng tối đa lớn hơn thu nhập tối đa'];
                    }
                }
            }
            if (request()->type==2 &&request()->employer_id =='') {
                $errors['employer_id'] = ['Không để trống trường này'];
            }
            if (!empty($errors)) {
                throw new HttpResponseException(response()->json(
                    [
                        'error' => $errors,
                        'status_code' => 422,
                    ],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                ));
            }
        });
    }
}
