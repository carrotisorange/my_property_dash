<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UnitOwner, App\Unit, App\Billing;
use Illuminate\Support\Facades\Auth;
use App\Property;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {
        $owners = DB::table('units')
        ->join('unit_owners', 'unit_id', 'unit_id_foreign')
        ->where('property_id_foreign', $property_id)
        
        ->get();

        $count_owners = DB::table('units')
        ->join('unit_owners', 'unit_id', 'unit_id_foreign')
        ->where('property_id_foreign', $property_id)
        ->count();

        $property = Property::findOrFail($property_id);
        
        return view('webapp.owners.owners', compact('owners','count_owners','property'));
    }

    
    public function search(Request $request){   
        
        $search = $request->get('search');

        //create session for the search
        $request->session()->put(Auth::user()->id.'search_owner', $search);

        $owners = DB::table('unit_owners')
            ->join('units', 'unit_id_foreign', 'unit_id')
            ->where('unit_property', Auth::user()->property)
            ->whereRaw("unit_owner like '%$search%' ")
            ->get();

            $count_owners = DB::table('unit_owners')
            ->join('units', 'unit_id_foreign', 'unit_id')
            ->where('unit_property', Auth::user()->property)
            ->count();

        return view('webapp.owners.owners', compact('owners', 'count_owners'));

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

           $units = DB::table('unit_owners')
           ->join('units', 'unit_id_foreign', 'unit_id')
           ->where('unit_id_foreign', $unit_id)
           ->get();
  
           $bills = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
           ->join('tenants', 'billing_tenant_id', 'tenant_id')
           
           ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
           ->where('unit_tenant_id', $unit_id)
           ->groupBy('billing_id')
           ->orderBy('billing_no', 'desc')
           ->havingRaw('balance > 0')
           ->get();
   
            return view('webapp.owners.show-investor', compact('investor','unit', 'units', 'bills'));
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
        
        return view('webapp.owners.edit-investor', compact('investor','unit'));
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

        return redirect('/units/'.$unit_id.'#owners')->with('success', 'changes have been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('unit_owners')->where('unit_owner_id', $id)->delete();

        return back();
    }
}
