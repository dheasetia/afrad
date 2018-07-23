<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
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
        $documents = Document::all();
        return view('documents.documents_index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.document_create');
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
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(document $document)
    {
        //
    }

    //=== A P I ===
    public function ajax_destroy(Request $request)
    {
        $document = Document::findOrFail($request->doc_id);
        if (count($document) == 1) {
            $document->delete();
            return response()->json([
                'status'   => 'success',
                'message'   => 'تم حذف المستند ' . $document->area
            ], 200);
        } else {
            return response()->json([
                'status'   => 'fail',
                'message'   => 'تعذر حذف المستند'
            ], 200);
        }

    }
}
