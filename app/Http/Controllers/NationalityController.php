<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }

    public function index()
    {
        return view('nationalities.nationality_index');
    }

    public function create()
    {
        return view('nationalities.nationality_create');
    }

    //=== A P I ===
    public function ajax_index()
    {
        $nationalities = Nationality::oldest()->get(['id', 'nationality']);
        $response = array(
            'status'    => 'success',
            'nationalities'     => $nationalities
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_nationality = Nationality::where('nationality', $request->nationality)->get();
        if (count($temp_nationality) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم الجنسية موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $nationality = new Nationality([
                'nationality' => $request->nationality
            ]);
            $nationality->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الجنسية الجديدة',
                'nationality'      => $nationality
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $nationality = Nationality::findOrFail($request->nationality_id);
        if (count($nationality) == 1) {
            $nationality->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الجنسية: ' . $nationality->nationality
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الجنسية'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $nationality = Nationality::findOrFail($request->nationality_id);
        $nationality->nationality = $request->nationality;
        $nationality->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الجنسية: ' . $nationality->nationality,
            'nationality'      => $nationality
        ], 200);
    }
}
