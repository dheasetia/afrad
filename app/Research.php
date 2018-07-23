<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Research extends Model
{
    protected $fillable = [
        'beneficiary_id',
        'difference',
        'percentage',
        'total_money_needed',
        'project_manager_id',
        'researcher_id',
        'general_manager_id',
        'research_date',
        'hijri_research_day',
        'hijri_research_month',
        'hijri_research_year',
        'place'
    ];

    protected $dates = [
        'research_date'
    ];


    public function beneficiary()
    {
        return $this->belongsTo('App\Beneficiary');
    }

    public function income_research()
    {
        return $this->hasMany('App\IncomeResearch');
    }

    public function expense_research()
    {
        return $this->hasMany('App\ExpenseResearch');
    }

    public function money_need_research()
    {
        return $this->hasMany('App\MoneyNeedResearch');
    }

    public function item_need_research()
    {
        return $this->hasMany('App\ItemNeedResearch');
    }


    public function researcher()
    {
        return $this->belongsTo('App\User');
    }

    public function research_kind()
    {
        return $this->belongsTo('App\ResearchKind');
    }

    public function getFormattedResearchHijriDateAttribute()
    {
        return str_pad($this->hijri_research_day, 2, '0', STR_PAD_LEFT) . '/ ' . str_pad($this->hijri_research_month, 2, '0', STR_PAD_LEFT) . '/ ' . $this->hijri_research_year;
    }

    public function getDifferenceAttribute()
    {
        return $this->getTotalIncomeAttribute() - $this->getTotalExpenseAttribute();
    }

    public function getTotalIncomeAttribute()
    {
        $income_total = 0;
        foreach ($this->income_research as $income) {
            $income_total += $income->amount;
        }
        return $income_total;
    }

    public function getTotalExpenseAttribute()
    {
        $expense_total = 0;
        foreach ($this->expense_research as $expense) {
            $expense_total += $expense->amount;
        }
        return $expense_total;
    }

    public function getPercentageAttribute()
    {
        if ($this->getTotalExpenseAttribute() > 0 && $this->getTotalIncomeAttribute() > 0) {
            return round(100 - ($this->getTotalExpenseAttribute() / $this->getTotalIncomeAttribute()) * 100);
        }
        return 0;
    }

    public function getTotalMoneyNeedAttribute()
    {
        $money_need = 0;
        foreach ($this->money_need_research as $need) {
            $money_need += $need->amount;
        }
        return $money_need;
    }

    public function getTotalItemNeedAttribute()
    {
        $item_need = 0;

        foreach ($this->item_need_research as $need) {
            $subtotal = $need->price * $need->quantity;
            $item_need += $subtotal;
        }
        return $item_need;
    }

    public function getTotalNeedAttribute()
    {
        return $this->getTotalMoneyNeedAttribute() + $this->getTotalItemNeedAttribute();
    }

}
