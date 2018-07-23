<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'label',
        'path',
        'beneficiary_id',
        'document_type_id',
        'extension',
        'expiry_date',
        'expiry_hijri_day',
        'expiry_hijri_month',
        'expiry_hijri_year',
    ];

    protected $dates = [
        'expiry_date'
    ];
}
