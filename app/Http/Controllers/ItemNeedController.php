<?php

namespace App\Http\Controllers;

use App\ItemNeed;
use Illuminate\Http\Request;

class ItemNeedController extends Controller
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
        $needs = ItemNeed::all(['id', 'item']);
        return view('item_needs.item_need_index', compact('needs'));
    }




    //=== A P I ===
    public function ajax_index()
    {
        $needs = ItemNeed::oldest()->get(['id', 'item']);
        $response = array(
            'status'    => 'success',
            'needs'     => $needs
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_need = ItemNeed::where('item', $request->item)->get();
        if (count($temp_need) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم الاحتياج العيني موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $need = new ItemNeed([
                'item' => $request->item
            ]);
            $need->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الاحتياج العيني',
                'need'      => $need
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $need = ItemNeed::findOrFail($request->need_id);
        if (count($need) == 1) {
            $need->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الاحتياج العيني: ' . $need->item
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الاحتياج العيني'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $need = ItemNeed::findOrFail($request->need_id);
        $need->item = $request->item;
        $need->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الاحتياج العيني: ' . $need->item,
            'need'      => $need
        ], 200);
    }
}
