<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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
        return view('expenses.expense_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.expense_create');
    }



    
    //=== A P I ===
    public function ajax_index()
    {
        $expenses = Expense::oldest()->get(['id', 'expense']);
        $response = array(
            'status'    => 'success',
            'expenses'     => $expenses
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_expense = Expense::where('expense', $request->expense)->get();
        if (count($temp_expense) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم النوع مصروف موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $expense = new Expense([
                'expense' => $request->expense
            ]);
            $expense->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة النوع مصروف الجديد',
                'expense'      => $expense
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $expense = Expense::findOrFail($request->expense_id);
        if (count($expense) == 1) {
            $expense->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف النوع مصروف: ' . $expense->expense
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف النوع مصروف'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $expense = Expense::findOrFail($request->expense_id);
        $expense->expense = $request->expense;
        $expense->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل النوع مصروف: ' . $expense->expense,
            'expense'      => $expense
        ], 200);
    }
}
