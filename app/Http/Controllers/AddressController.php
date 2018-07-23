<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Requests\AddressUpdateRequest;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }

    public function ajax_update(AddressUpdateRequest $request, $id)
    {
        if ($request->address_id !== $id) {
            return response()->json([
                'message'   => 'لا يوجد العنوان المطلوب',
                'status'    => 'fail',
                'address_id' => $request->address_id,
                'id'    => $id
            ]);
        }
        $address = Address::findOrFail($request->address_id);

        $address->city_id = $request->city_id;
        $address->building_name = $request->building_name;
        $address->phone = $request->phone;
        $address->fax = $request->fax;
        $address->street = $request->street;
        $address->district = $request->district;
        $address->building_no = $request->building_no;
        $address->additional_no = $request->additional_no;
        $address->po_box = $request->po_box;
        $address->zip_code = $request->zip_code;
        $address->coordinate = $request->coordinate;
        $address->description = $request->description;

        $address->save();
        return response()->json([
            'status'    => 'success',
            'message'   => 'تم تحديث بيانات العنوان',
            'address'   => $address],
            200);
    }
}
