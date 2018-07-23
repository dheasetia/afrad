<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionItem extends Model
{
    protected $fillable = [
        'distribution_id',
        'is_money',
        'item_id',
        'cost',
        'quantity',
        'is_received'
    ];

    public function distribution()
    {
        return $this->belongsTo('App\Distribution');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function getIsMoneyAttribute($value)
    {
        return $value == 1 ? 'نقدي' : 'عيني';
    }
}
