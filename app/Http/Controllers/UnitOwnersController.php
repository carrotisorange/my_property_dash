<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UnitOwner, App\Unit;
use Illuminate\Support\Facades\Auth;

class UnitOwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    
    public function search(Request $request){   
        
        $search = $request->get('search');

        //create session for the search
        $request->session()->put(Auth::user()->id.'search_owner', $search);

        $owners = DB::table('units')
            ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
            ->where('unit_property', Auth::user()->property)
            ->whereRaw("unit_owner like '%$search%' ")
            ->paginate(10);

        $count_owners = DB::table('units')
            ->join('unit_owners', 'unit_owner_id', 'unit_unit_owner_id')
            ->where('unit_property', Auth::user()->property)
            ->count();

        return view('admin.owners', compact('owners', 'count_owners'));

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unit_id,$unit_owner_id)
    {

        if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
            $investor = UnitOwner::findOrFail($unit_owner_id);

            $investor_billings = DB::table('units')
           ->join('unit_owners', 'unit_id', 'unit_unit_owner_id')
           ->join('billings', 'unit_owner_id', 'billing_tenant_id')
           ->get();

           $unit = Unit::findOrFail($unit_id);
   
            return view('admin.show-investor', compact('investor','unit'));
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
    public function edit($unit_id,$unit_owner_id)
    {
        $investor = UnitOwner::findOrFail($unit_owner_id);

        $unit = Unit::findOrFail($unit_id);
        
        return view('admin.edit-investor', compact('investor','unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $unit_id, $unit_owner_id)
    {

        DB::table('unit_owners')
        ->where('unit_owner_id',$unit_owner_id )
        ->update([
            'unit_owner' => $request->unit_owner,
            'investor_contact_no' => $request->investor_contact_no,
            'investor_email_address' => $request->investor_email_address,
            'investor_address' => $request->investor_address,
            'investor_representative' => $request->investor_representative,
            'date_invested' => $request->date_invested,
            'investment_price' => $request->investment_price,
            'investment_type' => $request->investment_type
        ]);

        DB::table('units')
        ->where('unit_id', $unit_id)
        ->update([
            'date_accepted' => $request->date_accepted,
        ]);

        return redirect('/units/'.$unit_id)->with('success', 'Owner information has been updated!');
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
