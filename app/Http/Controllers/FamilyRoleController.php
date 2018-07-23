<?php

namespace App\Http\Controllers;

use App\family_role;
use App\FamilyRole;
use Illuminate\Http\Request;

class FamilyRoleController extends Controller
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
        return view('family_roles.family_role_index');
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
     * @param  \App\family_role  $family_role
     * @return \Illuminate\Http\Response
     */
    public function show(family_role $family_role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\family_role  $family_role
     * @return \Illuminate\Http\Response
     */
    public function edit(family_role $family_role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\family_role  $family_role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, family_role $family_role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\family_role  $family_role
     * @return \Illuminate\Http\Response
     */
    public function destroy(family_role $family_role)
    {
        //
    }

    //=== A P I ===
    public function ajax_index()
    {
        $roles = FamilyRole::oldest()->get(['id', 'role']);
        $response = array(
            'status'    => 'success',
            'roles'     => $roles
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_role = FamilyRole::where('role', $request->role)->get();
        if (count($temp_role) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم العلاقة الأسرية موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $role = new FamilyRole([
                'role' => $request->role
            ]);
            $role->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة العلاقة الأسرية الجديدة',
                'role'      => $role
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $role = FamilyRole::findOrFail($request->role_id);
        if (count($role) == 1) {
            $role->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف العلاقة الأسرية: ' . $role->role
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف العلاقة الأسرية'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $role = FamilyRole::findOrFail($request->role_id);
        $role->role = $request->role;
        $role->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل العلاقة الأسرية: ' . $role->role,
            'role'      => $role
        ], 200);
    }
}
