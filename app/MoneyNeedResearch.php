<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyNeedResearch extends Model
{
    protected $table = 'money_need_research';
    protected $fillable = [
        'money_need_id',
        'research_id',
        'amount'
    ];


    public function money_need()
    {
        return $this->belongsTo('App\MoneyNeed');
    }
}
