<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
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


    //=== A P I ===
    public function ajax_index()
    {
        $items = DB::table('items')
            ->join('areas', 'items.area_id', '=', 'areas.id')
            ->select('items.id', 'items.item', 'areas.area')
            ->orderBy('item')
            ->get();
        $response = array(
            'status'    => 'success',
            'items'     => $items
        ) ;

        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_item = Item::where('item', $request->item)->get();
        if (count($temp_item) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم البند مساعدة موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $item = new Item();
            $item->item = $request->item;
            $item->save();

            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة البند مساعدة الجديدة',
                'item'      => array(
                    'id'    => $item->id,
                    'item'  => $item->item
                )
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        if (count($item) == 1) {
            $item->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف البند مساعدة: ' . $item->item
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف البند مساعدة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $item = Item::findOrFail($request->id);
        $item->item = $request->item;
        $item->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل البند مساعدة: ' . $item->item,
            'item'      => $item
        ], 200);
    }

}
