<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ResidentUpdateRequest extends FormRequest
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
            'resident_kind_id'  => 'required',
            'mobile'            => ['nullable', 'regex:/^05\d{8}$/'],
            'iban'              => ['nullable', 'unique:residents,iban,' . Request::input('resident_id'), 'regex:/^SA\d{22}$/'],
            'email'             => 'nullable|email',
            'annually_cost'     => 'nullable|numeric'
        ];
    }
}
