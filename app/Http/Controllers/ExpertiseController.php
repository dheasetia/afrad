<?php

namespace App\Http\Controllers;

use App\Expertise;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }



    //=== A P I ===
    public function ajax_index()
    {
        $expertises = Expertise::oldest()->get(['id', 'expertise']);
        $response = array(
            'status'    => 'success',
            'expertises'     => $expertises
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_expertise = Expertise::where('expertise', $request->expertise)->get();
        if (count($temp_expertise) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم الحرفة موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $expertise = new Expertise([
                'expertise' => $request->expertise
            ]);
            $expertise->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الحرفة الجديدة',
                'expertise'      => $expertise
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $expertise = Expertise::findOrFail($request->expertise_id);
        if (count($expertise) == 1) {
            $expertise->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الحرفة: ' . $expertise->expertise
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الحرفة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $expertise = Expertise::findOrFail($request->expertise_id);
        $expertise->expertise = $request->expertise;
        $expertise->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الحرفة: ' . $expertise->expertise,
            'expertise'      => $expertise
        ], 200);
    }
}
