<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserPostRequest extends FormRequest
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
            'email'         => 'required|unique:users|email',
            'mobile'        => ['required', 'digits:10', 'unique:users', 'regex:/^05\d{8}$/'],
            'phone'         => 'nullable|numeric',
            'ext'           => 'nullable|numeric',
            'password'      => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'job_id'        => 'required',
            'department_id' => 'required',
            'role_id' => 'required'
        ];
    }
}
