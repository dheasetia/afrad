<?php

namespace App\Http\Controllers;

use App\DistributionKind;
use App\Http\Requests\DistributionKindPostRequest;
use Illuminate\Http\Request;

class DistributionKindController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }



    // AJAX
    public function ajax_store(DistributionKindPostRequest $request)
    {
        $distribution_kind = new DistributionKind();
        $distribution_kind->kind = $request->kind;
        $distribution_kind->save();

        $result = [
            'status'   => 'success',
            'message'   => 'تمت عملية حفظ نوع المساعدة',
            'kind'  => $distribution_kind
        ];

        return response()->json($result);
    }
}
