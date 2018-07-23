<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Employee;
use App\Expense;
use App\ExpenseResearch;
use App\Income;
use App\IncomeResearch;
use App\ItemNeed;
use App\ItemNeedResearch;
use App\MoneyNeed;
use App\MoneyNeedResearch;
use App\ResearchKind;
use App\Setting;
use Illuminate\Http\Request;
use App\Research;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researches = Research::all();
        return view('researches.research_index', compact('researches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beneficiaries = Beneficiary::all();
        $incomes = Income::all(['id', 'income']);
        $expenses = Expense::all(['id', 'expense']);
        $money_needs = MoneyNeed::all(['id', 'description']);
        $item_needs = ItemNeed::all(['id', 'item']);
        $employees = Employee::all('id', 'name');
        $researcher = Auth::user();
        $research_kinds = ResearchKind::all('id', 'kind');
        $setting = Setting::first();

        return view('researches.research_create', compact('beneficiaries', 'incomes', 'expenses', 'money_needs', 'item_needs', 'employees', 'researcher', 'research_kinds', 'setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $research = Research::findOrFail($id);
        $beneficiary = Beneficiary::findOrFail($research->beneficiary_id);
        $incomes = $research->income_research;
        $expenses = $research->expense_research;
        $setting = Setting::first();
        $money_needs = $research->money_need_research;
        $item_needs = $research->item_need_research;

        return view('researches.research_show', compact('research', 'setting', 'beneficiary', 'incomes', 'expenses', 'money_needs', 'item_needs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $research = Research::findOrFail($id);
        $beneficiaries = Beneficiary::all();
        $incomes = Income::all(['id', 'income']);
        $expenses = Expense::all(['id', 'expense']);
        $money_needs = MoneyNeed::all(['id', 'description']);
        $item_needs = ItemNeed::all(['id', 'item']);
        $employees = Employee::all('id', 'name');
        $research_kinds = ResearchKind::all('id', 'kind');
        $research_incomes = $research->income_research;
        $research_expenses = $research->expense_research;
        $research_money_needs = $research->money_need_research;
        $research_item_needs = $research->item_need_research;
        $setting = Setting::first();
        return view('researches.research_edit', compact('research', 'beneficiaries', 'incomes', 'expenses', 'money_needs', 'item_needs', 'employees', 'research_kinds', 'research_incomes', 'research_expenses', 'research_money_needs', 'research_item_needs', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print_research($id)
    {
        $research = Research::findOrFail($id);
        $beneficiary = Beneficiary::findOrFail($research->beneficiary_id);
        $incomes = $research->income_research;
        $expenses = $research->expense_research;

        $money_needs = $research->money_need_research;
        $item_needs = $research->item_need_research;
        return view('researches.research_print', compact('research', 'beneficiary', 'incomes', 'expenses', 'money_needs', 'item_needs'));
    }


    //=========== A J A X =================

    private function reset_fail_research($research_id) {
        $research = Research::findOrFail($research_id);
        DB::table('income_research')->where('research_id', $research_id)->delete();
        DB::table('expense_research')->where('research_id', $research_id)->delete();
        DB::table('money_need_research')->where('research_id', $research_id)->delete();
        DB::table('item_need_research')->where('research_id', $research_id)->delete();
        $research->delete();
    }

    public function ajax_store(Request $request)
    {
        $success = true;
        $response = array();
        $hijri_numbers = explode('/ ', $request->hijri_research_date);
        $greg_numbers = explode('/ ', $request->research_date);

        $setting = Setting::first();
        $research = new Research();
        $research->beneficiary_id = $request->beneficiary_id;
        $research->research_kind_id = $request->research_kind_id;
        $research->place = $request->place;
        $research->researcher_id = $request->researcher_id;
        $setting->employee_research_name = $request->employee_research_name;
        $setting->director_research_name = $request->director_research_name;
        $research->employee_research_name = $request->employee_research_name;
        $research->director_research_name = $request->director_research_name;
        $research->research_date = $greg_numbers[2] . '-' . $greg_numbers[1] . '-' . $greg_numbers[0];
        $research->hijri_research_day = intval($hijri_numbers[0]);
        $research->hijri_research_month = intval($hijri_numbers[1]);
        $research->hijri_research_year = intval($hijri_numbers[2]);
        $research->researcher_recommendation = $request->researcher_recommendation;
        $research->save();
        $setting->save();

        $request_keys = array_keys($request->all());
        for ($i = 0 ; $i < count($request_keys) ; $i++) {
            if (substr_count($request_keys[$i], 'income_amount') > 0) {
                $income_research = new IncomeResearch();
                $income_research->research_id = $research->id;
                $amount = $request_keys[$i];
                $income_research->amount = $request->$amount;
                $income_research->income_id = ltrim($request_keys[$i], 'income_amount_');
                if (!$income_research->save()) {
                    $success = false;
                }
            } else if (substr_count($request_keys[$i], 'expense_amount') > 0) {
                $expense_research = new ExpenseResearch();
                $expense_research->research_id = $research->id;
                $amount = $request_keys[$i];
                $expense_research->amount = $request->$amount;
                $expense_research->expense_id = ltrim($request_keys[$i], 'expense_amount_');
                if (!$expense_research->save()) {
                    $success = false;
                }
            } else if (substr_count($request_keys[$i], 'money_need_amount') > 0) {
                $money_need_research = new MoneyNeedResearch();
                $money_need_research->research_id = $research->id;
                $amount = $request_keys[$i];
                $money_need_research->amount = $request->$amount;
                $money_need_research->money_need_id = ltrim($request_keys[$i], 'money_need_amount_');
                if (!$money_need_research->save()) {
                    $success = false;
                }
            } else if (substr_count($request_keys[$i], 'item_need_price') > 0) {
                $item_need_research = new ItemNeedResearch();
                $item_need_research->research_id = $research->id;
                $item_need_id = ltrim($request_keys[$i], 'item_need_price_');
                $item_need_price_prop = 'item_need_price_' . $item_need_id;
                $item_need_quantity_prop = 'item_need_quantity_' . $item_need_id;
                $item_need_subtotal_prop  = 'item_need_sub_total_' . $item_need_id;

                $item_need_research->item_need_id = $item_need_id;
                $item_need_research->price = $request->$item_need_price_prop;
                $item_need_research->quantity = $request->$item_need_quantity_prop;
                $item_need_research->cost = intval($request->$item_need_subtotal_prop);

                if (!$item_need_research->save()) {
                    $success = false;
                }
            }
        }
        if ($success == false) {
            $this->reset_fail_research($research->id);
            $response['status'] = 'fail';
        } else {
            $response['status'] = 'success';
            $response['research'] = $research;
        }



        return response()->json($response);
    }

    public function ajax_update(Request $request)
    {
        $research = Research::findOrFail($request->research_id);
        $research_id = $research->id;
        $success = true;
        $response = array();
        $hijri_numbers = explode('/ ', $request->hijri_research_date);
        $greg_numbers = explode('/ ', $request->research_date);

        $research->beneficiary_id = $request->beneficiary_id;
        $research->research_kind_id = $request->research_kind_id;
        $research->place = $request->place;
        $research->project_manager_id = $request->project_manager_id;
        $research->researcher_id = $request->researcher_id;
        $research->general_manager_id = $request->general_manager_id;
        $research->research_date = $greg_numbers[2] . '-' . $greg_numbers[1] . '-' . $greg_numbers[0];
        $research->hijri_research_day = intval($hijri_numbers[0]);
        $research->hijri_research_month = intval($hijri_numbers[1]);
        $research->hijri_research_year = intval($hijri_numbers[2]);
        $research->researcher_recommendation = $request->researcher_recommendation;
        $research->save();

        //delete all research incomes
        DB::table('income_research')->where('research_id', $research_id)->delete();
        DB::table('expense_research')->where('research_id', $research_id)->delete();
        DB::table('money_need_research')->where('research_id', $research_id)->delete();
        DB::table('item_need_research')->where('research_id', $research_id)->delete();

        //save new research incomes
        $request_keys = array_keys($request->all());
        for ($i = 0 ; $i < count($request_keys) ; $i++) {
            if (substr_count($request_keys[$i], 'income_amount') > 0) {
                $income_research = new IncomeResearch();
                $income_research->research_id = $research->id;
                $amount = $request_keys[$i];
                $income_research->amount = $request->$amount;
                $income_research->income_id = ltrim($request_keys[$i], 'income_amount_');
                if (!$income_research->save()) {
                    $success = false;
                }
            } else if (substr_count($request_keys[$i], 'expense_amount') > 0) {
                $expense_research = new ExpenseResearch();
                $expense_research->research_id = $research->id;
                $amount = $request_keys[$i];
                $expense_research->amount = $request->$amount;
                $expense_research->expense_id = ltrim($request_keys[$i], 'expense_amount_');
                if (!$expense_research->save()) {
                    $success = false;
                }
            } else if (substr_count($request_keys[$i], 'money_need_amount') > 0) {
                $money_need_research = new MoneyNeedResearch();
                $money_need_research->research_id = $research->id;
                $amount = $request_keys[$i];
                $money_need_research->amount = $request->$amount;
                $money_need_research->money_need_id = ltrim($request_keys[$i], 'money_need_amount_');
                if (!$money_need_research->save()) {
                    $success = false;
                }
            } else if (substr_count($request_keys[$i], 'item_need_price') > 0) {
                $item_need_research = new ItemNeedResearch();
                $item_need_research->research_id = $research->id;
                $item_need_id = ltrim($request_keys[$i], 'item_need_price_');
                $item_need_price_prop = 'item_need_price_' . $item_need_id;
                $item_need_quantity_prop = 'item_need_quantity_' . $item_need_id;
                $item_need_subtotal_prop  = 'item_need_sub_total_' . $item_need_id;

                $item_need_research->item_need_id = $item_need_id;
                $item_need_research->price = $request->$item_need_price_prop;
                $item_need_research->quantity = $request->$item_need_quantity_prop;
                $item_need_research->cost = $request->$item_need_subtotal_prop;

                if (!$item_need_research->save()) {
                    $success = false;
                }
            }
        }

        if ($success == false) {
            $response['status'] = 'fail';
            $response['research'] = $research;
        } else {
            $response['status'] = 'success';
            $response['research'] = $research;
        }

        return response()->json($response);

    }

}
