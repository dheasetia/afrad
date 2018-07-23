<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseResearch extends Model
{
    protected $table = 'expense_research';
    protected $fillable = [
        'expense_id',
        'research_id',
        'amount'
    ];

    public function expense()
    {
        return $this->belongsTo('App\Expense');
    }
}
