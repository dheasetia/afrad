<?php

namespace App\Http\Controllers;

use App\EducationSpecialty;
use Illuminate\Http\Request;

class EducationSpecialtyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }

    public function index()
    {
        return view('education_specialties.education_specialty_index');
    }

    public function create()
    {
        return view('education_specialties.education_specialty_create');
    }




    //=== A P I ===
    public function ajax_index()
    {
        $specialties = EducationSpecialty::oldest()->get(['id', 'specialty']);
        $response = array(
            'status'    => 'success',
            'specialties'     => $specialties
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_specialty = EducationSpecialty::where('specialty', $request->specialty)->get();
        if (count($temp_specialty) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم التخصص الدراسي موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $specialty = new EducationSpecialty([
                'specialty' => $request->specialty
            ]);
            $specialty->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة التخصص الدراسي الجديد',
                'specialty'      => $specialty
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $specialty = EducationSpecialty::findOrFail($request->specialty_id);
        if (count($specialty) == 1) {
            $specialty->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف التخصص الدراسي: ' . $specialty->specialty
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف التخصص الدراسي'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $specialty = EducationSpecialty::findOrFail($request->specialty_id);
        $specialty->specialty = $request->specialty;
        $specialty->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل التخصص الدراسي: ' . $specialty->specialty,
            'specialty'      => $specialty
        ], 200);
    }
}
