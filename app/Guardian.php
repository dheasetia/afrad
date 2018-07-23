<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'phone',
        'description'
    ];
}
