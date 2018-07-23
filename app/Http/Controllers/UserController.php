<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Job;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
        $this->middleware('role:admin');
    }

    public function index()
    {
        $users = User::all();
        return view('users.user_index', compact('users'));
    }

    public function create()
    {
        $jobs = Job::all(['id', 'job']);
        $departments = Department::all(['id', 'department']);
        $roles = Role::all('id', 'label');
        return view('users.user_create', compact('jobs', 'departments', 'roles'));
    }

    public function store(UserPostRequest $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->ext = $request->ext;
        $user->job_id = $request->job_id;
        $user->department_id = $request->department_id;

        $role = Role::findOrFail($request->role_id);
        $user->save();
        $user->assignRole($role->name);
        return redirect(url('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $jobs = Job::all(['id', 'job']);
        $departments = Department::all(['id', 'department']);
        $roles = Role::all();
        return view('users.user_show', compact('jobs', 'departments', 'user', 'roles'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password !== '') {
            $user->password = bcrypt($request->password);
        }
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->ext = $request->ext;
        $user->job_id = $request->job_id;
        $user->department_id = $request->department_id;
        $user->save();
        $user->syncRoles([Role::findById($request->role_id, 'web')]);
        return redirect(url('users', $user->id));
    }

    public function prepare_avatar($id)
    {
        $user = User::findOrFail($id);
        return view('users.avatars.avatar_prepare', compact('user'));
    }

    public function store_avatar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($request->hasFile('avatar')){
            $document = $request->file('avatar');
            $destination_path = public_path('files/users/avatars');
            $file_name = time() . '_' . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $user->avatar = $file_name;
                $user->save();
            }
            $x = intval($request->x);
            $y = intval($request->y);

            Image::make($destination_path . '/' . $file_name)
                ->crop(300, 300, $x, $y)
                ->save($destination_path .  '/thumbnails/' . 'thumb_' . $file_name);
            return redirect(url('users', $user->id));
        }
        return redirect()->back();
    }

    public function delete_confirmation(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $prev_page_text = $request->prev_page;
        if ($prev_page_text === 'user_show') {
            $prev_page = 'users/' . $user->id;
        } else {
            $prev_page = 'users';
        }
        return view('users.user_delete_confirmation', compact('user', 'prev_page'));
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($user->id == Auth::user()->id) {
            return redirect()->back();
        }
        $user->delete();
        return redirect('users');
    }


    //--- A J A X ---
    public function ajax_ban_user(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($user->id == Auth::user()->id) {
            return redirect()->back();
        }
        $user->is_banned = 1;
        $user->save();
        return response()->json([
            'status'    => 'success',
            'user_name' => $user->name
        ]);
    }

    public function ajax_unban_user(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($user->id == Auth::user()->id) {
            return redirect()->back();
        }
        $user->is_banned = 0;
        $user->save();
        return response()->json([
            'status'    => 'success',
            'user_name' => $user->name
        ]);
    }
}
