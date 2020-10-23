<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, App\Tenant, App\Unit, App\Concern, Auth, Carbon\Carbon;

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

       $concern_id = DB::table('concerns')->insertGetId(
            [
                'concern_tenant_id' => $request->reported_by,
                'date_reported' => $request->date_reported,
                'concern_type'=> $request->concern_type,
                'concern_urgency' => $request->concern_urgency,
                'is_warranty' => 'na',
                'concern_item' => $request->concern_item,
                'concern_desc' => $request->concern_desc,
                'concern_qty' => $request->concern_qty,
                'concern_status' => 'pending',
                'concern_personnel_id' => 1,
                'is_paid' => 'unpaid',
            ]);

            return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->reported_by.'/concerns/'.$concern_id)->with('success', 'concern has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unit_id, $tenant_id, $concern_id)
    {
        if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury' || auth()->user()->user_type === 'billing'){
        
            $tenant = Tenant::findOrFail($tenant_id);

            $unit = Unit::findOrFail($unit_id);

            $concern = Concern::findOrFail($concern_id);

            $responses = DB::table('concerns')
            
            ->join('responses', 'concern_id', 'concern_id_foreign')
            ->select('*', 'responses.created_at as created_at')
            ->where('concern_id', $concern_id)
            ->orderBy('responses.created_at', 'desc')
            ->get();
      
       return view('webapp.concerns.show-concern', compact('tenant','unit','concern', 'responses'));
   }else{
       return view('unregistered');
   }

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
    public function update(Request $request, $concern_id)
    {
        DB::table('concerns')
        ->where('concern_id', $concern_id)
        ->update([
            'date_reported' => $request->date_reported,
            'concern_item' => $request->concern_item,
            'concern_type' => $request->concern_type,
            'concern_desc' => $request->concern_desc,
            'concern_urgency' => $request->concern_urgency
        ]);

        return back()->with('success', 'changes has been saved!');
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
