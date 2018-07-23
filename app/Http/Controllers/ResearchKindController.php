<?php

namespace App\Http\Controllers;

use App\ResearchKind;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResearchKindController extends Controller
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
        $research_kinds = ResearchKind::all();
        return view('research_kinds.research_kind_index', compact('research_kinds'));
    }




    //=== A P I ===
    public function ajax_index()
    {
        $kinds = ResearchKind::oldest()->get(['id', 'kind']);
        $response = array(
            'status'    => 'success',
            'kinds'     => $kinds
        ) ;
        return response()->json($response, 200);
    }
    
    public function ajax_store(Request $request)
    {
        $temp_kind = ResearchKind::where('kind', $request->kind)->get();
        if (count($temp_kind) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم النوع موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $kind = new ResearchKind([
                'kind' => $request->kind
            ]);
            $kind->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة نوع الحالة',
                'kind'      => $kind
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $kind = ResearchKind::findOrFail($request->kind_id);
        if (count($kind) == 1) {
            $kind->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف نوع حالة: ' . $kind->kind
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف نوع حالة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $kind = ResearchKind::findOrFail($request->kind_id);
        $kind->kind = $request->kind;
        $kind->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل نوع حالة: ' . $kind->kind,
            'kind'      => $kind
        ], 200);
    }
}
