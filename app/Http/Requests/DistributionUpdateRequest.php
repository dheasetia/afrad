<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DistributionUpdateRequest extends FormRequest
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
            'beneficiary_id'    => 'required',
            'distribution_kind_id'  => 'required',
            'hijri_distribution_date'   => 'required',
            'distribution_date'   => 'required',
            'city_id'   => 'required',
            'place' => 'required',
            'is_periodic' => 'required'
        ];
    }
}
