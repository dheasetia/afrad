<?php
namespace App\Classes\Helper;
use App\Budget;
use App\Donation;
use App\Transfer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetHelper {

    public function currentBudget()
    {
        $budget = Budget::where('year', date('Y'))->first();
        if ($budget) {
            return $budget->budget;
        }
        return 0;
    }

    public function currentExpense()
    {
        $first_day_of_year = date('Y') . '-01-01 00:00:01';
        $last_day_of_year = date('Y') . '-12-31 23:59:59';
        return Donation::whereBetween('created_at', [$first_day_of_year, $last_day_of_year])->sum('amount');
    }

    public function transfered()
    {
        $first_day_of_year = date('Y') . '-01-01 00:00:01';
        $last_day_of_year = date('Y') . '-12-31 23:59:59';
        return Transfer::whereBetween('created_at', [$first_day_of_year, $last_day_of_year])->sum('amount');
    }

    public function remainingBudget()
    {
        return $this->currentBudget() - $this->currentExpense();
    }

    public function currentQuarterBudget()
    {
        return $this->currentBudget() / 4;
    }

    public function expenseStatus()
    {
        $first_quarter_budget = $this->currentQuarterBudget();
        $second_quarter_budget = $this->currentQuarterBudget() * 2;
        $third_quarter_budget = $this->currentQuarterBudget() * 3;

        $current_expense = $this->currentExpense();
        $current_month = date('m');
        switch ($current_month) {
            case '01' || '02' || '03':
                if (($current_expense >= ($first_quarter_budget * 0.8)) && ($current_expense < $first_quarter_budget))
                {
                    $status = 'warning';
                }
                elseif ($current_expense >= $first_quarter_budget)
                {
                    $status = 'danger';
                }
            break;

            case '04' || '05' || '06':
                if (($current_expense >= ($second_quarter_budget * 0.8)) && ($current_expense < $second_quarter_budget))
                {
                    $status = 'warning';
                }
                elseif ($current_expense >= $second_quarter_budget)
                {
                    $status = 'danger';
                }
                break;

            case '07' || '08' || '09':
                if (($current_expense >= ($third_quarter_budget * 0.8)) && ($current_expense < $third_quarter_budget))
                {
                    $status = 'warning';
                }
                elseif ($current_expense >= $third_quarter_budget)
                {
                    $status = 'danger';
                }
                break;

            case '10' || '11' || '012':
                if (($current_expense >= ($this->currentBudget() * 0.8)) && ($current_expense < $this->currentBudget()))
                {
                    $status = 'warning';
                }
                elseif ($current_expense >= $this->currentBudget())
                {
                    $status = 'danger';
                }
                break;
            default:
                $status = 'success';
        }
        return $status;
    }

    public function expensePercentageBudget()
    {
        if ($this->currentExpense() == null && $this->currentExpense() == 0) {
            return 0;
        }
        return ($this->currentExpense() / $this->currentBudget()) * 100;
    }

    public function expensePercentageQuarter()
    {
        if ($this->currentQuarterExpense() == null || $this->currentQuarterExpense() == 0) {
            return 0;
        }
        return ($this->currentQuarterExpense() / $this->currentQuarterBudget()) * 100;
    }

    public function currentQuarter()
    {
        $month = date('m');
        switch ($month) {
            case '01' || '02' || '03':
                return 1;
            break;

            case '04' || '05' || '06':
                return 2;
            break;
            case '07' || '08' || '09':
                return 3;
            break;

            case '10' || '11' || '12':
                return 4;
            break;
        }
    }

    public function currentQuarterExpense()
    {
        switch ($this->currentQuarter()) {
            case 1:
                $from = date('Y').'-01-01 00:00:01';
                $to = date('Y').'-03-31 23:59:59';
                break;
            case 2:
                $from = date('Y').'-04-01 00:00:01';
                $to = date('Y').'-06-30 23:59:59';
                break;
            case 3:
                $from = date('Y').'-07-01 00:00:01';
                $to = date('Y').'-09-30 23:59:59';
                break;
            case 4:
                $from = date('Y').'-10-01 00:00:01';
                $to = date('Y').'-12-31 23:59:59';
                break;
        }

        $current_quarter_expense = Donation::whereBetween('created_at', [$from, $to])->sum('amount');
        return $current_quarter_expense;
    }

    public function currentQuarterRemainingBudget()
    {
        return $this->currentQuarterBudget() - $this->currentQuarterExpense();
    }

    public  function arabicStringCurrentQuarterRange()
    {
        $month = date('m');
        switch ($month) {
            case '01':
            case '02':
            case '03':
                return 'من ١ يناير إلى ٣١ مارس';
                break;
            case '04':
            case '05':
            case '06':
                return 'من ١ أبريل إلى ٣٠ يونيو';
                break;
            case '07':
            case '08':
            case '09':
                return 'من ١ يوليو إلى ٣٠ سبتمبر';
                break;

            case '10':
            case '11':
            case '12':
                return 'من ١ أكتوبر إلى ٣١ ديسمبر';
                break;
        }
    }

    public function reachYearBudgetLimit()
    {
        return $this->currentExpense() >= $this->currentBudget();
    }

    public function makeStatus($number = 0)
    {
        switch ($number) {
            case $number < 80:
                return 'success';
            break;
            case $number >= 80 && $number < 100:
                return 'warning';
            break;
            case $number >= 100:
                return 'danger';
            break;
        }
    }

    public function getMonthString($monthNumber)
    {
        switch ($monthNumber) {
            case '1' :
                return 'يناير';
                break;
            case '2':
                return 'فبراير';
                break;
            case '3' :
                return 'مارس';
                break;
            case '4':
                return 'أبريل';
                break;
            case '5' :
                return 'مايو';
                break;
            case '6':
                return 'يونيو';
                break;
            case '7' :
                return 'يوليو';
                break;
            case '8':
                return 'أغسطس';
                break;
            case '9' :
                return 'سبتمبر';
                break;
            case '10':
                return 'أكتوبر';
                break;
            case '11':
                return 'نوفمبر';
                break;
            case '12':
                return 'ديسمبر';
                break;
            default:
                return '';
                break;
        }
    }

    public function  getCurrentMonthDonation()
    {
        $year_number = date('Y', time());
        $month_number = date('n', time());
        $total_current_month_donation = DB::select(DB::raw('SELECT SUM(amount) as total_donation FROM donations WHERE MONTH(created_at) = ' . $month_number . ' AND YEAR(created_at) = ' . $year_number));
        return $total_current_month_donation[0]->total_donation;
    }

    public function getCurrentMonthBudget()
    {
        return $this->currentBudget() / 12;
    }

    public function getCurrentMonthName()
    {
        return $this->getMonthString(date('n', time()));
    }

    public function getCurrentMonthRemainingDonation()
    {
        return $this->getCurrentMonthBudget() - $this->getCurrentMonthDonation();
    }

    public function getCurrentMonthDonationPercentage()
    {
        return ($this->getCurrentMonthDonation() / $this->getCurrentMonthBudget()) * 100;
    }

    public function getCurrentMonthTransferred()
    {
        $year_number = date('Y', time());
        $month_number = date('n', time());
        $total_current_month_transferred = DB::select(DB::raw('SELECT SUM(amount) as total_transfer FROM transfers WHERE MONTH(created_at) =  ' . $month_number . ' AND YEAR(created_at) = ' . $year_number));
        return $total_current_month_transferred[0]->total_transfer;
    }

    public function getCurrentMonthTransferredRemaining()
    {
        return $this->getCurrentMonthBudget() - $this->getCurrentMonthTransferred();
    }

    public function getCurrentMonthTransferredPercentage()
    {
        return ($this->getCurrentMonthTransferred() / $this->getCurrentMonthBudget()) * 100;
    }

    public function getDiffDays($first_day, $second_day) {
        $first_day = Carbon::createFromFormat('Y-m-d', $first_day);
        $second_day = Carbon::createFromFormat('Y-m-d', $second_day);
        return $first_day->diffInDays($second_day);
    }

    public function getDiffDaysFromNow($second_day) {
        $today = Carbon::now();
        $second_day = Carbon::createFromFormat('Y-m-d', $second_day);
        return $today->diffInDays($second_day);
    }
}