<?php

namespace App\Http\Controllers;

use App\Graduation;
use Illuminate\Http\Request;

class GraduationController extends Controller
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
        return view('graduations.graduation_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('graduations.graduation_create');
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
     * @param  \App\graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function show(graduation $graduation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function edit(graduation $graduation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, graduation $graduation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function destroy(graduation $graduation)
    {
        //
    }


    //=== A P I ===
    public function ajax_index()
    {
        $graduations = Graduation::oldest()->get(['id', 'graduation']);
        $response = array(
            'status'    => 'success',
            'graduations'     => $graduations
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_graduation = Graduation::where('graduation', $request->graduation)->get();
        if (count($temp_graduation) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'المؤهل دراسي موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $graduation = new Graduation([
                'graduation' => $request->graduation
            ]);
            $graduation->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة المؤهل الدراسي',
                'graduation'      => $graduation
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $graduation = Graduation::findOrFail($request->graduation_id);
        if (count($graduation) == 1) {
            $graduation->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المؤهل الدراسي: ' . $graduation->graduation
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المؤهل الدراسي'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $graduation = Graduation::findOrFail($request->graduation_id);
        $graduation->graduation = $request->graduation;
        $graduation->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل المؤهل الدراسي: ' . $graduation->graduation,
            'graduation'      => $graduation
        ], 200);
    }
}
