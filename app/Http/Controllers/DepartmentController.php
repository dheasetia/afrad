<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }

    public function index()
    {
        return view('departments.department_index');
    }

    public function create()
    {
        return view('departments.department_create');
    }




    //=== A P I ===
    public function ajax_index()
    {
        $departments = Department::oldest()->get(['id', 'department']);
        $response = array(
            'status'    => 'success',
            'departments'     => $departments
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_department = Department::where('department', $request->department)->get();
        if (count($temp_department) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم الإدارة موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $department = new Department([
                'department' => $request->department
            ]);
            $department->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الإدارة الجديدة',
                'department'      => $department
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $department = Department::findOrFail($request->department_id);
        if (count($department) == 1) {
            $department->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الإدارة: ' . $department->department
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الإدارة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $department = Department::findOrFail($request->department_id);
        $department->department = $request->department;
        $department->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الإدارة: ' . $department->department,
            'department'      => $department
        ], 200);
    }
}
