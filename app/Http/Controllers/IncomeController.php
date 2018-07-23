<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
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
        return view('incomes.income_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incomes.income_create');
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


    //=== A P I ===
    public function ajax_index()
    {
        $incomes = Income::oldest()->get(['id', 'income']);
        $response = array(
            'status'    => 'success',
            'incomes'     => $incomes
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_income = Income::where('income', $request->income)->get();
        if (count($temp_income) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم المصدر دخل موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $income = new Income([
                'income' => $request->income
            ]);
            $income->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة المصدر دخل الجديد',
                'income'      => $income
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $income = Income::findOrFail($request->income_id);
        if (count($income) == 1) {
            $income->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المصدر دخل: ' . $income->income
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المصدر دخل'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $income = Income::findOrFail($request->income_id);
        $income->income = $request->income;
        $income->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل المصدر دخل: ' . $income->income,
            'income'      => $income
        ], 200);
    }
}
