<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class BeneficiaryUpdateRequest extends FormRequest
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
            'name'              => 'required|min:6',
            'national_number'   => 'required|digits:10|unique:beneficiaries,national_number,' . Request::input('beneficiary_id'),
            'mobile'            => 'required|digits:10|regex:/^05\d{8}$/',
            'phone'             => 'nullable|numeric',
            'email'             => 'nullable|email:unique:beneficiary',
            'sex'               => 'required',
            'dob'               => ['nullable', 'regex:/(0[1-9]|[1-2][0-9]|30)\/\s(0[1-9]|1[0-2])\/\s(13[3-9][0-9]|14[0-4][0-9])$/'],
            'marital_status_id'    => 'required',
            'family_member_count'   => 'nullable|numeric',
            'son_count'         => 'nullable|numeric',
            'daughter_count'    => 'nullable|numeric',
            'iban'              => ['nullable',
                Rule::unique('beneficiaries')->ignore(Request::input('beneficiary_id')),
                'regex:/^SA\d{22}$/'
            ],
        ];
    }
}
