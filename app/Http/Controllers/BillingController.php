<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class BillingController extends Controller
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
    public function store(Request $request)
    {



        if($request->ctr > 1){
            for($i = 1; $i<=$request->ctr; $i++){
                DB::table('billings')->insert(
                    [
                        'billing_no' => $request->input('billing_no'.$i),
                        'billing_tenant_id' => $request->input('billing_tenant_id'.$i),
                        'billing_date' => Carbon::now()->firstOfMonth(),
                        'billing_start' => $request->input('billing_start'.$i),
                        'billing_end' => $request->input('billing_end'.$i),
                        'billing_desc' => $request->input('billing_desc'.$i),
                        'billing_amt' =>  $request->input('billing_amt'.$i)
                    ]);
    
                    DB::table('tenants')
                    ->where('tenant_id', $request->input('billing_tenant_id'.$i))
                    ->where('tenant_status', 'active')
                    ->where('tenants_note', 'new')
                    ->update(
                                [
                                    'tenants_note' => ''
                                ]
                            );
            }

            return redirect('/bills')->with('success', ($i-1).' '.$request->billing_desc1.' bills has been posted!');

        }else{
         
                DB::table('billings')->insert(
                    [
                        'billing_no' => $request->billing_no,
                        'billing_tenant_id' => $request->billing_tenant_id,
                        'billing_date' => $request->billing_date,
                        'billing_start' =>$request->billing_start,
                        'billing_end' => $request->billing_end,
                        'billing_desc' => $request->billing_desc,
                        'billing_amt' =>  $request->billing_amt,
                    ]);


                    return back()->with('success', 'bill for '. $request->billing_desc.' '.$request->billing_amt .' has been posted!');
    
            
        }


        
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
    public function destroy($tenant_id, $billing_id)
    {

        DB::table('billings')->where('billing_tenant_id', $tenant_id)->delete();
        return back()->with('success', 'Bill has been deleted');
    }
}
