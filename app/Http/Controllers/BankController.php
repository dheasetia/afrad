<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
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
        return view('banks.bank_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.bank_create');
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
     * @param  \App\bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(bank $bank)
    {
        //
    }

    //=== A P I ===
    public function ajax_index()
    {
        $banks = Bank::oldest()->get(['id', 'bank']);
        $response = array(
            'status'    => 'success',
            'banks'     => $banks
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_bank = Bank::where('bank', $request->bank)->get();
        if (count($temp_bank) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم البنك موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $bank = new Bank([
                'bank' => $request->bank
            ]);
            $bank->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة البنك الجديد',
                'bank'      => $bank
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $bank = Bank::findOrFail($request->bank_id);
        if (count($bank) == 1) {
            $bank->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف البنك: ' . $bank->bank
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف البنك'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $bank = Bank::findOrFail($request->bank_id);
        $bank->bank = $request->bank;
        $bank->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل البنك: ' . $bank->bank,
            'bank'      => $bank
        ], 200);
    }
}
