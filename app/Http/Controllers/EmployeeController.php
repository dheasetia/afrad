<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Http\Requests\EmployeePostRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Job;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }


    public function index()
    {
        $employees = Employee::all();
        return view('employees.employee_index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $jobs = Job::all('id', 'job');
        $departments = Department::all('id', 'department');
        return view('employees.employee_show', compact('employee', 'jobs', 'departments'));
    }

    public function create()
    {
        $jobs = Job::all('id', 'job');
        $departments = Department::all('id', 'department');
        return view('employees.employee_create', compact('jobs', 'departments'));
    }

    public function store(EmployeePostRequest $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->mobile = $request->mobile;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->job_id = $request->job_id;
        $employee->notes = $request->notes;
        $employee->save();
        return redirect(url('employees'));
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->name = $request->name;
        $employee->mobile = $request->mobile;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->job_id = $request->job_id;
        $employee->notes = $request->notes;
        $employee->save();
        return redirect(url('employees', $employee->id));
    }



    // ==== A J A X ====
    public function ajax_destroy(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $employee->delete();
        $result = [
            'message'   => 'تمت عملية حذف الموظف: ' . $employee->name,
            'status'    => 'success',
            'employee'  => $employee
        ];

        return response()->json($result);
    }
}
