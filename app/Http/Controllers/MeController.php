<?php

namespace App\Http\Controllers;

use App\Department;
use App\Job;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }
    public function show()
    {
        $user = Auth::user();
        $jobs = Job::all('id', 'job');
        $departments = Department::all('id', 'department');
        return view('me.me', compact('user', 'jobs', 'departments'));
    }

    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != '' && $request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->ext = $request->ext;
        $user->job_id = $request->job_id;
        $user->department_id = $request->department_id;
        $user->save();
        return redirect(url('me'));
    }
}
