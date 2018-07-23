<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
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
        return view('professions.profession_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professions.profession_create');
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
     * @param  \App\profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(profession $profession)
    {
        //
    }

    //=== A P I ===
    public function ajax_index()
    {
        $professions = Profession::oldest()->get(['id', 'profession']);
        $response = array(
            'status'    => 'success',
            'professions'     => $professions
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_profession = Profession::where('profession', $request->profession)->get();
        if (count($temp_profession) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم المهنة موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $profession = new Profession([
                'profession' => $request->profession
            ]);
            $profession->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة المهنة الجديدة',
                'profession'      => $profession
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $profession = Profession::findOrFail($request->profession_id);
        if (count($profession) == 1) {
            $profession->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المهنة: ' . $profession->profession
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المهنة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $profession = Profession::findOrFail($request->profession_id);
        $profession->profession = $request->profession;
        $profession->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل المهنة: ' . $profession->profession,
            'profession'      => $profession
        ], 200);
    }
}
