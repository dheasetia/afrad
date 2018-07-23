<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePostRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('roles.role_index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.role_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePostRequest $request)
    {
        $role = new Role([
            'name'  => $request->name,
            'label' => $request->label,
            'description'   => $request->description
        ]);
        $role->save();
        return redirect(url('roles', $role->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {

        $permissions = Permission::all();
        return view('roles.role_show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $role)
    {
        //
    }


    public function assign_permission(Request $request)
    {
        $role = Role::find($request->role_id);
        if (count($request->permission) > 0 ) {
            $permissions = array();
            foreach ($request->permission as $permission_name) {
                $permission = Permission::findByName($permission_name);
                array_push($permissions, $permission);
            }
            $role->syncPermissions($permissions);
        } else {
            $old_permissions = $role->permissions;
            if (count($old_permissions) > 0) {
                foreach ($old_permissions as $old_permission) {
                    $role->revokePermissionTo($old_permission);
                }
            }
        }
        return redirect(url('roles', $role->id));

    }

    // AJAX
    public function ajax_index()
    {
        $roles = Role::all();
        return response()->json([
            'status'    => 'success',
            'roles'     => $roles
        ]);
    }

    public function ajax_store(RolePostRequest $request)
    {
        $role = new Role([
            'name'  => $request->name,
            'label' => $request->label,
            'description'   => $request->description
        ]);
        $role->save();
        if ($role->id !== null)
        {
            $result = [
                'status'    => 'success',
                'message'   => 'تم حفظ المجموعة',
                'role'      => $role
            ];
        } else {
            $result = [
                'status'    => 'fail',
                'message'   => 'لم يتم حفظ المجموعة الجديدة'
            ];
        }
        return response()->json($result);
    }

    public function ajax_destroy(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        if (count($role) == 1) {
            $role->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المجموعة: ' . $role->role
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المجموعة'
            ], 200);
        }

    }

    public function ajax_update(Request $request, $id)
    {
        if ($request->id != $id) {
            return response('خطأ', 500);
        }
        $role = Role::findOrFail($request->role_id);
        $role->label = $request->label;
        $role->description = $request->description;
        $role->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل المجموعة: ' . $role->label,
            'role'      => $role
        ], 200);
    }
}
