<?php

namespace App\Http\Controllers;

use App\periodic_distribution;
use Illuminate\Http\Request;

class PeriodicDistributionController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\periodic_distribution  $periodic_distribution
     * @return \Illuminate\Http\Response
     */
    public function show(periodic_distribution $periodic_distribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\periodic_distribution  $periodic_distribution
     * @return \Illuminate\Http\Response
     */
    public function edit(periodic_distribution $periodic_distribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\periodic_distribution  $periodic_distribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, periodic_distribution $periodic_distribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\periodic_distribution  $periodic_distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(periodic_distribution $periodic_distribution)
    {
        //
    }
}
