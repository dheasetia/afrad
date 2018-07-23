<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'city',
        'city_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
