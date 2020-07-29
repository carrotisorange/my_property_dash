<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ConcernController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::table('personnels')->insert([
            'personnel_name' => 'Juan',
            'personnel_contact_no' => '123123123',
            'personnel_availability' => 'yes'
        ]);

        DB::table('concerns')->insert(
            [
                'concern_tenant_id' => $request->tenant_id,
                'date_reported' => $request->date_reported,
                'concern_type'=> $request->concern_type,
                'concern_urgency' => $request->concern_urgency,
                'is_warranty' => $request->is_warranty,
                'concern_item' => $request->concern_item,
                'concern_qty' => $request->concern_qty,
                'concern_status' => 'pending',
                'concern_desc' => $request->concern_desc,
                'concern_personnel_id' => $request->concern_personnel_id,
                'is_paid' => 'unpaid',
            ]);

            return back()->with('success', 'Concern has been added to the record!');
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
