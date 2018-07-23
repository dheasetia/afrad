<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MeUpdateRequest extends FormRequest
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
            'email'         => 'required|email|unique:users,email,'. Auth::user()->id,
            'mobile'        => ['required', 'digits:10', 'unique:users,mobile,' . Auth::user()->id, 'regex:/^05\d{8}$/'],
            'phone'         => 'nullable|numeric',
            'ext'           => 'nullable|numeric',
            'password'      => 'nullable|min:6|confirmed',
            'job_id'        => 'required',
            'department_id' => 'required'
        ];
    }
}
