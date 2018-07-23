<?php

namespace App\Http\Controllers;

use App\Activity;
use App\area;
use App\Http\Requests\AreaPostRequest;
use Illuminate\Http\Request;

class AreaController extends Controller
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
        return view('areas.area_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.area_create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AreaPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaPostRequest $request)
    {
        $area = new Area(['area' => $request->area]);
        $area->save();
        return redirect(url('areas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(area $area)
    {
        //
    }


    //=== A P I ===
    public function ajax_index()
    {
        $areas = Area::oldest()->get(['id', 'area']);
        $response = array(
            'status'    => 'success',
            'areas'     => $areas
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_area = Area::where('area', $request->area)->get();
        if (count($temp_area) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم المنطقة موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $area = new Area([
                'area' => $request->area
            ]);
            $area->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة المنطقة الجديدة',
                'area'      => $area
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $area = Area::findOrFail($request->area_id);
        if (count($area) == 1) {
            $area->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المنطقة: ' . $area->area
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المنطقة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $area = Area::findOrFail($request->area_id);
        $area->area = $request->area;
        $area->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل المنطقة: ' . $area->area,
            'area'      => $area
        ], 200);
    }
}
