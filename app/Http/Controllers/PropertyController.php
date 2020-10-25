<?php

namespace App\Http\Controllers;

use App\Property;
use DB;
use Auth;
use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Billing;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenantRegisteredMail;
use App\Mail\SendContractAlertEmail;
use Uuid;
use App\UserProperty;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $properties = User::join('properties', 'user_id_foreign', 'id')
        // ->join('units', 'property_id', 'property_id_foreign')
        // ->select('*', 'properties.name as name')
        // ->selectRaw("count(case when units.status = 'reserved' then 1 end) as reserved_units")
        // ->selectRaw("count(case when units.status = 'occupied' then 1 end) as occupied_units")
        // ->selectRaw("count(case when units.status = 'vacant' then 1 end) as vacant_units")
        // ->selectRaw("count(*) as total_units")
        // ->where('id', Auth::user()->id)
        // ->get();

       $properties = User::findOrFail(Auth::user()->id)->properties;

        $users = DB::table('users_properties_relations')
       ->join('users', 'user_id_foreign', 'id')
       ->where('user_id_foreign', Auth::user()->id)
       ->count();



        return view('webapp.properties.index', compact('properties', 'users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('webapp.properties.create');
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        return redirect('/property/'.$request->selectedProperty.'/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => Uuid::generate()->string,
            'name' => 'required|unique:properties|max:255',
            'type' => 'required',
          
            'ownership' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'country' => 'required',
            'zip' => 'required',
        ]);

        $uuid = Uuid::generate()->string;
        
        DB::table('properties')
        ->insert
                (
                    [
                        'property_id' => $uuid,
                        'name' => $request->name,
                        'type' => $request->type,
                        'ownership' => $request->ownership,
                        'address' => $request->address,
                        'mobile' => $request->mobile,
                        'country' => $request->country,
                        'zip' => $request->zip,
                        'created_at' => Carbon::now(),
                        'user_id_property' => Auth::user()->id,
                    ]
                );
        
        DB::table('users_properties_relations')
        ->insert
                (
                    [
                        'user_id_foreign' => Auth::user()->id,
                        'property_id_foreign' => $uuid,
                    ]
                );

        
     DB::table('units')->where('unit_property', Auth::user()->property)
    ->update(
        [
            'property_id_foreign' => $uuid
        ]
    );

     DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)
    ->update(
        [
            'property_id_foreign' => $uuid
        ]
    );

    DB::table('payable_entry')->where('payable_entry_property', Auth::user()->property)
    ->update(
        [
            'property_id_foreign' => $uuid
        ]
    );

    DB::table('payable_request')->where('property', Auth::user()->property)
    ->update(
        [
            'property_id_foreign' => $uuid
        ]
    );

    DB::table('personnels')->where('personnel_property', Auth::user()->property)
    ->update(
        [
            'property_id_foreign' => $uuid
        ]
    );

        return redirect('property/all')->with('success', 'New property has been saved!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($property_id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
