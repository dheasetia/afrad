<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'city_id',
        'building_name',
        'phone',
        'fax',
        'street',
        'district',
        'building_no',
        'additional_no',
        'po_box',
        'coordinate',
        'description'
    ];

    public function beneficiary()
    {
        return $this->hasOne('App\Beneficiary');
    }
}
