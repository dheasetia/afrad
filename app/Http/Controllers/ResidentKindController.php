<?php

namespace App\Http\Controllers;

use App\ResidentKind;
use Illuminate\Http\Request;

class ResidentKindController extends Controller
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

    public function ajax_store(Request $request)
    {
        $this->validate($request, [
            'kind'      => 'required|unique:resident_kinds'
        ]);

        $resident_kind = new ResidentKind([
            'kind' => $request->kind
        ]);

        $resident_kind->save();

        $result = array(
            'status'    => 'success',
            'message'   => 'تمت إضافة نوع السكن',
            'resident_kind'      => $resident_kind
        );
        return response()->json($result, 200);
    }
}
