<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use DB;
use Illuminate\Support\Facades\Auth;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->status === 'unregistered')
            return view('unregistered'); 
    
        // $ei_floor = DB::table('units')->where('floor_no','8')->orderBy('unit_id')->get();
        // $sv_floor = DB::table('units')->where('floor_no','7')->orderBy('unit_id')->get();
        // $si_floor = DB::table('units')->where('floor_no','6')->orderBy('unit_id')->get();
        // $fi_floor = DB::table('units')->where('floor_no','5')->orderBy('unit_id')->get();
        // $fo_floor = DB::table('units')->where('floor_no','4')->orderBy('unit_id')->get();
        // $th_floor = DB::table('units')->where('floor_no','3')->orderBy('unit_id')->get();
        // $se_floor = DB::table('units')->where('floor_no','2')->orderBy('unit_id')->get();
        // $gr_floor = DB::table('units')->where('floor_no','1')->orderBy('unit_id')->get();

        // $total_units = DB::table('units')->count();

        // return view('units', compact('total_units','ei_floor','sv_floor','si_floor','fi_floor','fo_floor','th_floor','se_floor','gr_floor'));
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
        //insert investor to a specific unit.
       $id = DB::table('unit_owners')->insertGetId(
            [
                'date_invested' => $request->date_invested,
                'unit_owner' => $request->unit_owner,
                'discount' => $request->discount,
                'investment_price' => $request->investment_price,
                'investment_type'=> $request->investment_type,
                'investor_representative' =>$request->investor_representative,
                'investor_email_address' => $request->investor_email_address,
                'investor_contact_no' => $request->investor_contact_no,
                'account_number' => $request->contact_no,
                'account_name' => $request->account_name,
                'bank_name' => $request->bank_name,
                'investor_address' =>$request->investor_address,
                'contract_start' =>$request->contract_start,
                'contract_end' => $request->contract_end,
            ]
        );

        //insert the id of the newly created investor to the unit.
        DB::table('units')
            ->where('unit_id', $request->unit_id)
            ->update(
                        [
                            'unit_unit_owner_id' => $id,
                        ]
                    );

        return back()->with('success', 'Investor has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $unit_id)
    {


        if(Auth::user()->status === 'unregistered')
            return view('unregistered'); 
        else
            if(Auth::user()->user_type !== 'admin')
            return abort('404');
            else
            
            $unit = Unit::where('unit_property', Auth::user()->property)->findOrFail($unit_id);

            $unit_owner = DB::table('units')
            ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
            ->where('unit_id', $unit_id)->get();  
    
            $tenant_active = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_tenant_id', $unit_id)
            ->whereIn('tenant_status', ['active', 'pending'])
            ->get();
    
            $tenant_inactive = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_tenant_id', $unit_id)
            ->where('tenant_status', 'inactive')
            ->get();
                
                return view('show-unit',compact('unit', 'unit_owner', 'tenant_active', 'tenant_inactive'));
        
    }

    public function add_unit(Request $request){
        
        DB::table('units')->insert([
            'unit_no' => $request->unit_no,
            'floor_no' => $request->floor_no,
            'building' => $request->building,
            'beds' => $request->beds,
            'monthly_rent' => $request->monthly_rent,
            'status' => 'vacant',
            'unit_property' => $request->unit_property,
            'type_of_units' => 'residential',
        ]);

        return back()->with('success', 'Unit has been successfully created!');
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
        DB::table('units')->where('unit_id', $id)
            ->update([
                'unit_no' => $request->unit_no,
                'floor_no' => $request->floor_no,
                'beds' => $request->beds,
                'status' => $request->status,
                'type_of_units' => $request->type_of_units
            ]);
        
        return back()->with('success', 'Unit information has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $request->all();
    }
}
