<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required',
            'mobile'        => ['required', 'digits:10', 'unique:employees,mobile,' . Request::input('employee_id'), 'regex:/^05\d{8}$/'],
            'email'         => 'required|email|unique:employees,email,' . Request::input('employee_id'),
            'department_id' => 'required',
            'job_id'        => 'required'
        ];
    }
}
