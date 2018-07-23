<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'department_id',
        'job_id'
    ];

    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}
