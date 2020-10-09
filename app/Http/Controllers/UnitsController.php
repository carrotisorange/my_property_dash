<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Unit, App\Billing;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                // 'date_invested' => $request->date_invested,
                'unit_owner' => $request->unit_owner,
                'unit_id_foreign' => $request->unit_id,
                // 'discount' => $request->discount,
                // 'investment_price' => $request->investment_price,
                // 'investment_type'=> $request->investment_type,
                // 'investor_representative' =>$request->investor_representative,
                'investor_email_address' => $request->investor_email_address,
                'investor_contact_no' => $request->investor_contact_no,
                // 'account_name' => $request->account_name,
                // 'bank_name' => $request->bank_name,
                // 'investor_address' =>$request->investor_address,
                // 'contract_start' =>$request->contract_start,
                // 'contract_end' => $request->contract_end,
            ]
        );

        //insert the id of the newly created investor to the unit.
        // DB::table('units')
        //     ->where('unit_id', $request->unit_id)
        //     ->update(
        //                 [
        //                     'unit_unit_owner_id' => $id,
        //                 ]
        //             );

    return redirect('/units/'.$request->unit_id.'/owners/'.$id.'/edit')->with('success', 'Owner has been added to the property! Please provide more information.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $unit_id)
    {
        if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager'){

            $unit = Unit::findOrFail($unit_id);

            $unit_owner = DB::table('unit_owners')
            ->join('units', 'unit_id_foreign', 'unit_id')
            ->where('unit_id_foreign', $unit_id)
            ->get();  
    
            $tenant_active = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_tenant_id', $unit_id)
            ->where('tenant_status', 'active')
            ->get();
    
            $tenant_inactive = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_tenant_id', $unit_id)
            ->where('tenant_status', 'inactive')
            ->get();

            $tenant_reservations = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_tenant_id', $unit_id)
            ->where('tenant_status', 'pending')
            ->get();
            
            $bills = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
           ->join('tenants', 'billing_tenant_id', 'tenant_id')
           ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
           ->where('unit_tenant_id', $unit_id)
           ->groupBy('billing_id')
           ->orderBy('billing_no', 'desc')
           ->havingRaw('balance > 0')
           ->get();

            $concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('unit_id', $unit_id)
            ->orderBy('date_reported', 'desc')
            ->orderBy('concern_urgency', 'desc')
            ->orderBy('concern_status', 'desc')
            ->get();
            

                // if(Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory'){
                    return view('admin.show-room',compact('unit', 'unit_owner', 'tenant_active', 'tenant_inactive', 'tenant_reservations', 'bills', 'concerns'));
                // }
                // else{
                //     return view('admin.show-unit',compact('unit', 'unit_owner', 'tenant_active', 'tenant_inactive', 'tenant_reservations', 'bills', 'concerns'));
                // }
        }else{
                return view('unregistered');
        }
    
        
    }

    // public function add_unit(Request $request){
        
    //    $id = DB::table('units')->insertGetId([
    //         'unit_no' => $request->unit_no,
    //         'floor_no' => $request->floor_no,
    //         'building' => $request->building,
    //         'beds' => $request->beds,
    //         'monthly_rent' => $request->monthly_rent,
    //         'status' => 'vacant',
    //         'unit_property' => Auth::user()->property,
    //         'type_of_units' => $request->type_of_units,
    //         'created_at'=> Carbon::now(),
    //     ]);

    //     return redirect('/units/'.$id)->with('success', '1 room has been added to the record!');
    // }

    public function add_multiple_rooms(Request $request){

       $building =  str_replace(' ', '-',$request->building);
        
        for($i = 1; $i<=$request->no_of_rooms; $i++ ) {
        $id = DB::table('units')->insertGetId([
             'unit_no' => $request->unit_no.'-'.$i,
             'floor_no' => $request->floor_no,
             'building' => $building,
             'max_occupancy' => $request->max_occupancy,
             'monthly_rent' => $request->monthly_rent,
             'status' => 'vacant',
             'unit_property' => Auth::user()->property,
             'type_of_units' => $request->type_of_units,
             'created_at'=> Carbon::now(),
         ]);
        }

        $units = DB::table('units')
        ->where('unit_property', Auth::user()->property)
        ->where('status','<>','deleted')
        ->count();

        $occupied_units = DB::table('units')
        ->where('unit_property', Auth::user()->property)
        ->where('status', 'occupied')
        ->count();

        DB::table('occupancy_rate')
            ->insert(
                        [
                            'occupancy_rate' => ($occupied_units/$units) * 100,
                            'occupancy_property' => Auth::user()->property,
                            'occupancy_date' => Carbon::now()
                        ]
                    );
        
 
         return back()->with('success', $request->no_of_rooms.' room/s have been added!');
     }

     public function show_edit_multiple_rooms($property){

        if($property === Auth::user()->property){
            $units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            // ->where('status','<>','deleted')
            ->orderBy('building', 'asc')
            ->orderBy('floor_no', 'asc')
            ->orderBy('unit_no', 'asc')
            ->get();
    
            return view('units.edit-units', compact('units'));
        }else{
            return view('unregistered');
        }
        
 
     }

     public function post_edit_multiple_rooms(Request $request){
      
      $units_count = DB::table('units')
         ->where('unit_property', Auth::user()->property)
        //  ->where('status','<>','deleted')
         ->count();
         
        for($i = 1; $i<=$units_count; $i++){
            DB::table('units')
            ->where('unit_id', $request->input('unit_id'.$i))
            ->update(
                [
                    'unit_no' => $request->input('unit_no'.$i),
                    'type_of_units' => $request->input('type_of_units'.$i),
                    'status' => $request->input('status'.$i),
                    'building' => $request->input('building'.$i),
                    'floor_no' => $request->input('floor_no'.$i),
                    'max_occupancy' => $request->input('max_occupancy'.$i),
                    'monthly_rent' => $request->input('monthly_rent'.$i),
                ]);
        }

        $units = DB::table('units')
        ->where('unit_property', Auth::user()->property)
        ->where('status','<>','deleted')
        ->count();

        $occupied_units = DB::table('units')
        ->where('unit_property', Auth::user()->property)
        ->where('status', 'occupied')
        ->count();

        DB::table('occupancy_rate')
            ->insert(
                        [
                            'occupancy_rate' => ($occupied_units/$units) * 100,
                            'occupancy_property' => Auth::user()->property,
                            'occupancy_date' => Carbon::now()
                        ]
                    );
        

        return redirect('/home')->with('success', $units_count.' rooms have been updated!');
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
        
        // if($request->action === 'enroll_leasing'){

        //     DB::table('units')->where('unit_id', $id)
        //     ->update([
        //         'beds' => $request->beds,
        //         'type_of_units' => 'leasing',
        //         'monthly_rent' => $request->monthly_rent,
        //         'date_enrolled' => Carbon::now(),
        //         'contract_start' => $request->contract_start,
        //         'contract_end' => $request->contract_end,
        //         'max_occupancy' => $request->max_occupancy,
        //     ]);

        //     return back()->with('success', 'The room has been enrolled to the leasing!');
        // }else{
            DB::table('units')->where('unit_id', $id)
            ->update([
                'unit_no' => $request->unit_no,
                'floor_no' => $request->floor_no,
                'max_occupancy' => $request->max_occupancy,
                'status' => $request->status,
                'building' => $request->building,
                'type_of_units' => $request->type_of_units,
                'monthly_rent' => $request->monthly_rent
            ]);

            $units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','<>','deleted')
            ->count();

            $occupied_units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status', 'occupied')
            ->count();
    
            DB::table('occupancy_rate')
                ->insert(
                            [
                                'occupancy_rate' => ($occupied_units/$units) * 100,
                                'occupancy_property' => Auth::user()->property,
                                'occupancy_date' => Carbon::now()
                            ]
                        );
   
                    
            return back()->with('success', 'Room has been updated!');
        // }
       
    }

    public function show_vacant_units($property){

        if(Auth::check()){
            return view('unregistered');
        }
        else
        $buildings = DB::table('units')
        ->select('building',DB::raw('count(*) as count'))
        ->whereIn('status', ['vacant','reserved'])
        ->where('status','<>','deleted')
        ->where('unit_property', $property)
        ->groupBy('building')
        ->get();

        $units = DB::table('units')
        ->whereIn('status', ['vacant','reserved'])
        ->where('unit_property', $property)
        ->where('status','<>','deleted')
        ->get();

        return view('reservation-forms.show-vacant-units', compact('buildings','units'));
    }

    public function show_property(){
       
         $properties = DB::table('units')
        ->select('unit_property',DB::raw('count(distinct building) as count_building'),DB::raw('count(distinct unit_no) as count_unit_no'))
        ->groupBy('unit_property')        
        ->get('unit_property', 'count_building','count_unit_no');

        return view('reservation-forms.show-property', compact('properties'));

    }

    public function show_reservation_form($property, $unit_id){

  
        $unit = Unit::whereIn('status', ['vacant', 'reserved'])->findOrFail($unit_id);

        return view('reservation-forms.show-reservation-form', compact('unit'));
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('units')->where('unit_id', $id)
            ->update([
                'status' => 'deleted',
            ]);

            $selected_unit = Unit::findOrFail($id);
            $units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','<>','deleted')
            ->count();

            $occupied_units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status', 'occupied')
            ->count();
    
            DB::table('occupancy_rate')
                ->insert(
                            [
                                'occupancy_rate' => ($occupied_units/$units) * 100,
                                'occupancy_property' => Auth::user()->property,
                                'occupancy_date' => Carbon::now()
                            ]
                        );
  

        return back()->with('success', $selected_unit->unit_no.' has been deleted!');
    }
}
