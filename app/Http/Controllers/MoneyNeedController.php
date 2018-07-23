<?php

namespace App\Http\Controllers;

use App\MoneyNeed;
use Illuminate\Http\Request;

class MoneyNeedController extends Controller
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

    public function index()
    {
        $needs = MoneyNeed::all('id', 'description');
        return view('money_needs.money_need_index', compact('needs'));
    }



    //=== A P I ===
    public function ajax_index()
    {
        $needs = MoneyNeed::oldest()->get(['id', 'description']);
        $response = array(
            'status'    => 'success',
            'needs'     => $needs
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_need = MoneyNeed::where('description', $request->description)->get();
        if (count($temp_need) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم الوظيفة موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $need = new MoneyNeed([
                'description' => $request->description
            ]);
            $need->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الوظيفة الجديدة',
                'need'      => $need
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $need = MoneyNeed::findOrFail($request->need_id);
        if (count($need) == 1) {
            $need->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الاحتياج المالي: ' . $need->description
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الاحتياج المالي'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $need = MoneyNeed::findOrFail($request->need_id);
        $need->description = $request->description;
        $need->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الاحتياج المالي: ' . $need->description,
            'need'      => $need
        ], 200);
    }
}
