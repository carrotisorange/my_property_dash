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
            if(Auth::user()->user_type == 'manager'){
                $properties = User::findOrFail(Auth::user()->id)->properties->units;
                // $units = DB::table('users_properties_relations')
                // ->join('properties', 'property_id_foreign', 'property_id')
                // ->join('units', 'users_properties_relations.property_id_foreign', 'units.property_id_foreign')
                // ->where('user_id_foreign', Auth::user()->id)
                // ->count();
            
                // $users = DB::table('users_properties_relations')
                // ->join('users', 'user_id_foreign', 'id')
                // ->where('user_id_foreign', Auth::user()->id)
                // ->orWhere('lower_access_user_id', Auth::user()->id)
                // ->count();

                $users = User::findOrFail(Auth::user()->id)->users->count();

                $existing_users = DB::table('users')->where('property', Auth::user()->property)
                ->where('id','<>',Auth::user()->id )
                ->count();

        return view('webapp.properties.index', compact('properties', 'users','existing_users')); 

            }else{
                    if(Auth::user()->lower_access_user_id == null){
                        return view('webapp.users.system-users.warning'); 
                    }else{
                        $properties = User::findOrFail(Auth::user()->lower_access_user_id)->properties;

                        $users = DB::table('users_properties_relations')
                        ->join('users', 'user_id_foreign', 'id')
                        ->where('user_id_foreign', Auth::user()->lower_access_user_id)
                        ->count();

                        return view('webapp.properties.index', compact('properties', 'users')); 
                    }
            }

        // $properties = User::join('properties', 'user_id_foreign', 'id')
        // ->join('units', 'property_id', 'property_id_foreign')
        // ->select('*', 'properties.name as name')
        // ->selectRaw("count(case when units.status = 'reserved' then 1 end) as reserved_units")
        // ->selectRaw("count(case when units.status = 'occupied' then 1 end) as occupied_units")
        // ->selectRaw("count(case when units.status = 'vacant' then 1 end) as vacant_units")
        // ->selectRaw("count(*) as total_units")
        // ->where('id', Auth::user()->id)
        // ->get();

       
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

    public function search(Request $request, $property_id){

         $search_key = $request->search_key;

        $tenants = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('property_id_foreign', $property_id)
        ->whereRaw("concat(first_name, ' ', last_name) like '%$search_key%' ")
       
        ->get();

        $units = DB::table('units')
        ->where('property_id_foreign', $property_id)
        ->whereRaw("unit_no like '%$search_key%' ")
        ->orWhereRaw("building like '%$search_key%' ")
        ->get();

        $owners = DB::table('unit_owners')
        ->join('units', 'unit_id_foreign', 'unit_id')
        ->where('property_id_foreign', $property_id)
        ->whereRaw("unit_owner like '%$search_key%' ")
        ->get();

        $property = Property::findOrFail($property_id);
    

        return view('webapp.properties.search', compact('property','search_key', 'tenants', 'units', 'owners'));
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

    DB::table('users')->where('property', Auth::user()->property)
    ->update(
        [
         'lower_access_user_id' => Auth::user()->id
        ]
    );


    // DB::table('concerns')
    //     ->join('users', 'concern_user_id', 'id')
    //     ->join('tenants', 'concern_tenant_id', 'tenant_id')
    //     ->join('units', 'unit_tenant_id', 'unit_id')
    //     ->where('unit_property', Auth::user()->property)
    //     ->update([
    //         'concern_user_id' => Auth::user()->id
    // ]);

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
