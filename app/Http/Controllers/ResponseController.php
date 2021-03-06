<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Concern;
use Auth;
use Carbon\Carbon;

class ResponseController extends Controller
{
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
    public function store(Request $request, $concern_id)
    {
        DB::table('responses')
        ->insertGetId(
              [
                  'concern_id_foreign' => $request->concern_id,
                  'response' => $request->response,
                  'posted_by' => Auth::user()->name,
                  'created_at' => Carbon::now(),
              ]
        );
    
        $responses_count = Concern::findOrFail($concern_id)->responses->count();
    
        if($responses_count > 0){
            DB::table('concerns')
            ->where('concern_id', $request->concern_id)
            ->update(
                [
                    'concern_status' => 'active',
                    'updated_at' => Carbon::now(),
                ]
            );
    
        }
    
        return back()->with('success', 'reponse has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
