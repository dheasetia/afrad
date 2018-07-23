<?php

namespace App\Http\Controllers;

use App\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
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
        return view('marital_statuses.marital_status_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marital_statuses.marital_status_create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    //=== A P I ===
    public function ajax_index()
    {
        $statuses = MaritalStatus::oldest()->get(['id', 'status']);
        $response = array(
            'status'    => 'success',
            'statuses'     => $statuses
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_status = MaritalStatus::where('status', $request->status)->get();
        if (count($temp_status) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => ' الحالة الاجتماعية موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $status = new MaritalStatus([
                'status' => $request->status
            ]);
            $status->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الحالة الاجتماعية الجديدة',
                'marital_status'     => $status
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $status = MaritalStatus::findOrFail($request->status_id);
        if (count($status) == 1) {
            $status->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الحالة الاجتماعية: ' . $status->status
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الحالة الاجتماعية'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $status = MaritalStatus::findOrFail($request->status_id);
        $status->status = $request->status;
        $status->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الحالة الاجتماعية: ' . $status->status,
            'status'      => $status
        ], 200);
    }
}
