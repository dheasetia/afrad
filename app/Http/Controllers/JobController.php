<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
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
        return view('jobs.job_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.job_create');
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
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(job $job)
    {
        //
    }

    //=== A P I ===
    public function ajax_index()
    {
        $jobs = Job::oldest()->get(['id', 'job']);
        $response = array(
            'status'    => 'success',
            'jobs'     => $jobs
        ) ;
        return response()->json($response, 200);
    }

    public function ajax_store(Request $request)
    {
        $temp_job = Job::where('job', $request->job)->get();
        if (count($temp_job) > 0) {
            $result = array(
                'status'    => 'fail',
                'message'   => 'اسم الوظيفة موجودة مسبقا',
            );
            return response()->json($result, 200);
        } else {
            $job = new Job([
                'job' => $request->job
            ]);
            $job->save();
            $result = array(
                'status'    => 'success',
                'message'   => 'تمت إضافة الوظيفة الجديدة',
                'job'      => $job
            );
            return response()->json($result, 200);
        }
    }

    public function ajax_destroy(Request $request)
    {
        $job = Job::findOrFail($request->job_id);
        if (count($job) == 1) {
            $job->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف الوظيفة: ' . $job->job
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف الوظيفة'
            ], 200);
        }

    }

    public function ajax_update(Request $request)
    {
        $job = Job::findOrFail($request->job_id);
        $job->job = $request->job;
        $job->save();

        return response()->json([
            'status'   => 'success',
            'message'   => 'تم تعديل الوظيفة: ' . $job->job,
            'job'      => $job
        ], 200);
    }
}
