<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
        'resident_kind_id',
        'owner',
        'responsible_person',
        'phone',
        'fax',
        'mobile',
        'bank_id',
        'iban',
        'payment_way',
        'annually_cost',
        'description'
    ];

    public function beneficiary()
    {
        return $this->hasOne('App\Beneficiary');
    }

    public function resident_kind()
    {
        return $this->belongsTo('App\ResidentKind');
    }
}
