<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeResearch extends Model
{
    protected $table = 'income_research';

    public function income()
    {
        return $this->belongsTo('App\Income');
    }
}
