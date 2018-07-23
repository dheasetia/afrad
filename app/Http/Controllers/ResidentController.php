<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentUpdateRequest;
use App\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
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

    public function ajax_update(ResidentUpdateRequest $request, $id)
    {
        if ($request->resident_id !== $id) {
            return response()->json([
                'message'   => 'لا يوجد معلومات السكن المطلوبة',
                'status'    => 'fail',
                'resident'  => $request->all()
            ]);
        }

        $resident = Resident::findOrFail($request->resident_id);
        $resident->resident_kind_id = $request->resident_kind_id;
        $resident->owner = $request->owner;
        $resident->responsible_person = $request->responsible_person;
        $resident->mobile = $request->mobile;
        $resident->phone = $request->phone;
        $resident->fax = $request->fax;
        $resident->email = $request->email;
        $resident->bank_id = $request->bank_id;
        $resident->iban = $request->iban;
        $resident->payment_way = $request->payment_way;
        $resident->annually_cost = $request->annually_cost;
        $resident->description = $request->description;


        $resident->save();
        return response()->json([
            'status'    => 'success',
            'message'   => 'تم تحديث معلومات السكن',
            'resident'   => $resident],
            200);
    }
}
