<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'area'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
