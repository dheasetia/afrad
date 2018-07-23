<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $dates = [
        'distribution_date'
    ];

    public function beneficiary()
    {
        return $this->belongsTo('App\Beneficiary');
    }

    public function distribution_kind()
    {
        return $this->belongsTo('App\DistributionKind');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function distribution_items()
    {
        return $this->hasMany('App\DistributionItem');
    }




    public function getHijriDistributionDateAttribute()
    {
        return str_pad($this->distribution_hijri_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->distribution_hijri_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->distribution_hijri_year;
    }

    public function getGregDistributionDateAttribute()
    {
        return $this->distribution_date->format('d/ m/ Y');
    }


}
