<?php

namespace App\Http\Controllers;

use App\Area;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
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
        $areas = Area::all(['id', 'area']);
        return view('cities.city_index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.city_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(city $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(city $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, city $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(city $city)
    {
        //
    }

    //=== A P I ===
    public function ajax_index()
    {
//        $cities = City::oldest()->get();
        $cities = DB::table('cities')
                    ->join('areas', 'cities.area_id', '=', 'areas.id')
                    ->select('cities.id', 'cities.city', 'areas.area')
                    ->orderBy('city')
                    ->get();
        $response = array(
            'status'    => 'success',
            'cities'     => $cities
        ) ;

        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_city = City::where('city', $request->city)->get();
        if (count($temp_city) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم المدينة موجود مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $city = new City();
            $city->city = $request->city;
            $city->area_id  = $request->area_id;
            $city->save();

            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة المدينة الجديدة',
                'city'      => array(
                    'id'    => $city->id,
                    'city'  => $city->city,
                    'area'  => $city->area->area
                )
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $city = City::findOrFail($request->city_id);
        if (count($city) == 1) {
            $city->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المدينة: ' . $city->city
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المدينة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $city = City::findOrFail($request->id);
        $city->city = $request->city;
        $city->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل المدينة: ' . $city->city,
            'city'      => $city
        ], 200);
    }

    public function city_area(Request $request)
    {
        $city = City::findOrFail($request->city_id);
        $area = $city->area->area;
        return response()->json($area);
    }
}
