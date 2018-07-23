<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemNeedResearch extends Model
{
    protected $table = 'item_need_research';
    protected $fillable = [
        'item_need_id',
        'research_id',
        'price',
        'quantity',
        'cost'
    ];

    public function item_need()
    {
        return $this->belongsTo('App\ItemNeed');
    }

    public function getSubtotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
