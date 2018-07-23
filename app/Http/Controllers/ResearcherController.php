<?php

namespace App\Http\Controllers;

use App\researcher;
use Illuminate\Http\Request;

class ResearcherController extends Controller
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
     * @param  \App\researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function show(researcher $researcher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function edit(researcher $researcher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, researcher $researcher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(researcher $researcher)
    {
        //
    }
}
