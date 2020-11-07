<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use App\Unit;
use App\Property;
use DB;
use App\Tenant;
use Auth;
use Uuid;
use Carbon\Carbon;

class ContractController extends Controller
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
    public function create(Request $request, $property_id, $tenant_id)
    {

        $request->validate([
            'unit_id' => 'required'
        ]);

        $unit = Unit::findOrFail($request->unit_id);

        $tenant = Tenant::findOrFail($tenant_id);

        $property = Property::findOrFail($property_id);

        $users = DB::table('users_properties_relations')
        ->join('properties', 'property_id_foreign', 'property_id')
        ->join('users', 'user_id_foreign', 'id')
        ->select('*', 'properties.name as property')
        ->where('lower_access_user_id', Auth::user()->id)
        ->orWhere('id', Auth::user()->id)  
        ->orderBy('users.name')
        ->get();

         $units = Property::findOrFail($property_id)
        ->units
        ->whereIn('status',['vacant', 'reserved']);

        $current_bill_no = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('property_id_foreign', $property_id)
        ->max('billing_no') + 1;

        return view('webapp.contracts.create', compact('tenant','unit', 'property', 'current_bill_no', 'users', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $property_id,$unit_id,$tenant_id)
    {
        
        $tenant_unique_id = Uuid::generate()->string;

            DB::table('contracts')->insert(
                    [
                        'contract_id' => Uuid::generate()->string,
                        'unit_id_foreign' => $unit_id,
                        'tenant_id_foreign' => $tenant_id,
                        'referrer_id_foreign' => $request->referrer_id,
                        'form_of_interaction' => $request->form_of_interaction,
                        'rent' => $request->rent,
                        'status' => 'pending',
                        'movein_at' => $request->movein_at,
                        'moveout_at' => $request->moveout_at,
                        'discount' => $request->discount,
                        'term' => $request->term,
                        'number_of_months' => $request->number_of_months,
                        'created_at' => $request->movein_at,
                    ]
                );

            
            DB::table('units')
            ->where('unit_id', $unit_id)
            ->update(
                [
                    'status' => 'reserved'
                ]
            );

            $units = DB::table('units')
            ->where('property_id_foreign', $property_id)
            ->where('status','<>','deleted')
            ->count();

            $occupied_units = DB::table('units')
            ->where('property_id_foreign', $property_id)
            ->where('status', 'occupied')
            ->count();

        DB::table('occupancy_rate')
            ->insert(
                        [
                            'occupancy_rate' => ($occupied_units/$units) * 100,
                            'property_id_foreign' => $property_id,
                           'occupancy_date' => Carbon::now(),
                           'created_at' => Carbon::now(),
                        ]
                    );

                    $current_bill_no = DB::table('units')
                    ->join('tenants', 'unit_id', 'unit_tenant_id')
                    ->join('billings', 'tenant_id', 'billing_tenant_id')
                    ->where('property_id_foreign', $property_id)
                    ->max('billing_no') + 1;

         $no_of_items = (int) $request->no_of_items; 

        for($i = 1; $i<$no_of_items; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $tenant_id,
                    'billing_no' => $current_bill_no++,
                    'billing_date' => $request->movein_at,
                    'billing_start' =>  $request->movein_at,
                    'billing_end' =>  $request->moveout_at,
                    'billing_desc' =>  $request->input('billing_desc'.$i),
                    'billing_amt' =>  $request->input('billing_amt'.$i)
                ]);
        }

            return redirect('/property/'.$request->property_id.'/tenant/'.$tenant_unique_id.'/'.$tenant_id)->with('success', 'new tenant has been added!');
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
