<?php

namespace App\Http\Controllers;

use App\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuardianController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $guardians = Guardian::oldest()->get();
        $response = array(
            'status'    => 'success',
            'guardians'     => $guardians
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|unique:guardians',
            'mobile'    => 'required|unique:guardians',
            'email'     => 'nullable|email|unique:guardians'
        ]);

        $guardian = new Guardian([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'description' => $request->description
        ]);

        $guardian->save();

        $result = array(
            'status'    => 'success',
            'message'   => 'تمت إضافة الشخص المسؤول',
            'guardian'      => $guardian
        );
        return response()->json($result, 200);
    }

    public function ajax_destroy(Request $request)
    {
        $guardian = Guardian::findOrFail($request->guardian_id);
        if (count($guardian) == 1) {
            $guardian->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الوظيفة: ' . $guardian->guardian
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف بيانات الشخص المسؤول'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $guardian = Guardian::findOrFail($request->guardian_id);
        $guardian->name = $request->name;
        $guardian->mobile = $request->mobile;
        $guardian->email = $request->email;
        $guardian->description = $request->description;
        $guardian->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الوظيفة: ' . $guardian->guardian,
            'guardian'      => $guardian
        ], 200);
    }
}
