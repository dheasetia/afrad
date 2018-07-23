<?php

namespace App\Http\Controllers;

use App\Area;
use App\Beneficiary;
use App\City;
use App\Classes\HijriCalendar;
use App\Distribution;
use App\DistributionItem;
use App\DistributionKind;
use App\Http\Requests\DistributionPostRequest;
use App\Http\Requests\DistributionUpdateRequest;
use App\Item;
use Illuminate\Http\Request;

class DistributionController extends Controller
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
        $distributions = Distribution::all();
        return view('distributions.distribution_index', compact('distributions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $distribution_kinds = DistributionKind::all('id', 'kind');
        $beneficiaries  = Beneficiary::all('id', 'name');
        $cities = City::all('id', 'city');
        $areas = Area::all('id', 'area');
        return view('distributions.distribution_create', compact('beneficiaries', 'distribution_kinds', 'cities', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistributionPostRequest $request)
    {
        // store distribution and go to distribution detail form
        $hijri = new HijriCalendar();
        $distribution = new Distribution();

        $hijri_numbers = explode('/ ', $request->hijri_distribution_date);
        $hijri_day = $hijri_numbers[0];
        $hijri_month = $hijri_numbers[1];
        $hijri_year = $hijri_numbers[2];
        $gregorian_in_array = $hijri->u2g(intval($hijri_day), intval($hijri_month), intval($hijri_year));
        $gregorian_in_string = $gregorian_in_array['year'] . '-' . str_pad($gregorian_in_array['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($gregorian_in_array['day'], 2, '0', STR_PAD_LEFT);

        $distribution->beneficiary_id = $request->beneficiary_id;
        $distribution->distribution_kind_id = $request->distribution_kind_id;
        $distribution->city_id = $request->city_id;
        $distribution->distribution_date = $gregorian_in_string;
        $distribution->distribution_hijri_day = $hijri_day;
        $distribution->distribution_hijri_month = $hijri_month;
        $distribution->distribution_hijri_year = $hijri_year;
        $distribution->place = $request->place;
        $distribution->is_periodic = $request->is_periodic;

        $distribution->save();
        return redirect(url('distributions', $distribution->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function show(Distribution $distribution)
    {
        $distribution_kinds = DistributionKind::all('id', 'kind');
        $beneficiaries  = Beneficiary::all('id', 'name');
        $cities = City::all('id', 'city');
        $areas = Area::all('id', 'area');
        $items = Item::all('id', 'item');
        $distribution_items = DistributionItem::where('distribution_id', '=', $distribution->id)->get();
        return view('distributions.distribution_show', compact('distribution', 'beneficiaries', 'distribution_kinds', 'cities', 'items', 'areas', 'distribution_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function edit(distribution $distribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, distribution $distribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(distribution $distribution)
    {
        //
    }



    // A J A X


    public function ajax_update(DistributionUpdateRequest $request, $id)
    {
        if ($request->distribution_id != $id) {
            return response('Not Found', 404);
        }
        $distribution = Distribution::findOrFail($request->distribution_id);

        $hijri = new HijriCalendar();

        $hijri_numbers = explode('/ ', $request->hijri_distribution_date);
        $hijri_day = $hijri_numbers[0];
        $hijri_month = $hijri_numbers[1];
        $hijri_year = $hijri_numbers[2];
        $gregorian_in_array = $hijri->u2g(intval($hijri_day), intval($hijri_month), intval($hijri_year));
        $gregorian_in_string = $gregorian_in_array['year'] . '-' . str_pad($gregorian_in_array['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($gregorian_in_array['day'], 2, '0', STR_PAD_LEFT);

        $distribution->beneficiary_id = $request->beneficiary_id;
        $distribution->distribution_kind_id = $request->distribution_kind_id;
        $distribution->city_id = $request->city_id;
        $distribution->distribution_date = $gregorian_in_string;
        $distribution->distribution_hijri_day = $hijri_day;
        $distribution->distribution_hijri_month = $hijri_month;
        $distribution->distribution_hijri_year = $hijri_year;
        $distribution->place = $request->place;
        $distribution->is_periodic = $request->is_periodic;

        $distribution->save();
        return response()->json([
            'status'    => 'success',
            'message'   => 'تم تحديث بيانات صرف المساعدة',
            'distribution_id'   => $distribution->id,
            'beneficiary_id'   => $distribution->beneficiary_id,
            'distribution_kind_id'   => $distribution->distribution_kind_id,
            'hijri_distribution_date'   => $distribution->hijri_distribution_date,
            'distribution_date'   => $distribution->greg_distribution_date,
            'city_id'   => $distribution->city_id,
            'place'   => $distribution->place,
            'is_periodic'   => $distribution->is_periodic,

        ]);
    }

    public function ajax_destroy(Request $request)
    {
        $distribution = Distribution::findOrFail($request->distribution_id);
        $distribution_items = DistributionItem::where('distribution_id', '=', $distribution->id)->get();
        foreach ($distribution_items as $item) {
            $item->delete();
        }
        if (count($distribution) == 1) {
            $distribution->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المساعدة ',
                'distribution' => $distribution
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المساعدة'
            ], 200);
        }

    }
}
