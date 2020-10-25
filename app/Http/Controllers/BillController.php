<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
use App\Property;
use App\Tenant;
use App\Unit;
use App\Billing;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {
        if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'billing'){

            $bills = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('property_id_foreign', $property_id)
            ->orderBy('billing_no', 'desc')
            ->get()
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->billing_start)->timestamp;
            });

            $property = Property::findOrFail($property_id);
    
            return view('webapp.bills.bills', compact('bills', 'property'));
        }else{
            return view('unregistered');
        }
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

    public function post_bills_rent(Request $request, $property_id, $date)
    {

    $updated_billing_start = $request->billing_start;
    $updated_billing_end = $request->billing_end;


  $active_tenants = DB::table('tenants')
  ->join('units', 'unit_id', 'unit_tenant_id')
  ->where('property_id_foreign', $property_id)
  ->where('tenant_status', 'active')
  ->get();

   //get the number of last added bills
   $current_bill_no = DB::table('units')
   ->join('tenants', 'unit_id', 'unit_tenant_id')
   ->join('billings', 'tenant_id', 'billing_tenant_id')
   ->where('property_id_foreign', $property_id)
   ->max('billing_no') + 1;

   DB::table('users')
   ->where('id', Auth::user()->id)
   ->update([
        'electric_rate_kwh' => $request->electric_rate_kwh
   ]);

   $property = Property::findOrFail($property_id);

    return view('webapp.bills.add-rental-bill', compact('active_tenants','current_bill_no', 'updated_billing_start', 'updated_billing_end', 'property'))->with('success', 'changes have been saved!');

    }

    public function post_bills_electric(Request $request, $property_id, $date)
    {
        $updated_billing_start = $request->billing_start;
    $updated_billing_end = $request->billing_end;
    $electric_rate_kwh = $request->electric_rate_kwh;


  $active_tenants = DB::table('tenants')
  ->join('units', 'unit_id', 'unit_tenant_id')
  ->where('property_id_foreign', $property_id)
  ->where('tenant_status', 'active')
  ->get();

   //get the number of last added bills
   $current_bill_no = DB::table('units')
   ->join('tenants', 'unit_id', 'unit_tenant_id')
   ->join('billings', 'tenant_id', 'billing_tenant_id')
   ->where('property_id_foreign', $property_id)
   ->max('billing_no') + 1;

   DB::table('users')
   ->where('id', Auth::user()->id)
   ->update([
        'electric_rate_kwh' => $request->electric_rate_kwh
   ]);

   $property = Property::findOrFail($property_id);

    return view('webapp.bills.add-electric-bill', compact('active_tenants','current_bill_no', 'updated_billing_start', 'updated_billing_end', 'electric_rate_kwh', 'property'))->with('success', 'changes have been saved!');


       
    }

    public function post_bills_water(Request $request, $property_id, $date)
    {

        $updated_billing_start = $request->billing_start;
        $updated_billing_end = $request->billing_end;
        $water_rate_cum = $request->water_rate_cum;
    
    
      $active_tenants = DB::table('tenants')
      ->join('units', 'unit_id', 'unit_tenant_id')
      ->where('property_id_foreign', $property_id)
      ->where('tenant_status', 'active')
      ->get();
    
       //get the number of last added bills
       $current_bill_no = DB::table('units')
       ->join('tenants', 'unit_id', 'unit_tenant_id')
       ->join('billings', 'tenant_id', 'billing_tenant_id')
       ->where('property_id_foreign', $property_id)
       ->max('billing_no') + 1;
    
       DB::table('users')
       ->where('id', Auth::user()->id)
       ->update([
            'water_rate_cum' => $request->water_rate_cum
       ]);

       $property = Property::findOrFail($property_id);
    
        return view('webapp.bills.add-water-bill', compact('property','active_tenants','current_bill_no', 'updated_billing_start', 'updated_billing_end', 'water_rate_cum'))->with('success', 'changes have been saved!');
    

      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $active_tenants = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('property_id_foreign', $request->property_id)
        ->where('tenant_status', 'active')
        ->count();

        $current_bill_no = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('property_id_foreign', $request->property_id)
        ->max('billing_no') + 1;
        
        if($request->action === 'add_move_in_charges'){
            for($i = 1; $i<$no_of_bills; $i++){
                DB::table('billings')->insert(
                    [
                        'billing_tenant_id' => $request->tenant_id,
                        'billing_no' => $current_bill_no++,
                        'billing_date' => $request->billing_date,
                        'billing_start' =>  $request->input('billing_start'.$i),
                        'billing_end' =>  $request->input('billing_end'.$i),
                        'billing_desc' =>  $request->input('billing_desc'.$i),
                        'billing_amt' =>  $request->input('billing_amt'.$i)
                    ]);
            }
            return back()->with('success', ($i-1).' bills have been posted!');
        }else{
          $no_of_billed = 1;
            for($i = 1; $i<=$active_tenants; $i++){
               if($request->input('billing_amt'.$i) > 0){
                $no_of_billed++;
                DB::table('billings')->insert(
                    [
                        'billing_no' => $current_bill_no++,
                        'billing_tenant_id' => $request->input('billing_tenant_id'.$i),
                        'billing_date' => $request->billing_date,
                        'billing_start' => $request->input('billing_start'.$i),
                        'billing_end' => $request->input('billing_end'.$i),
                        'billing_desc' => $request->input('billing_desc'.$i),
                        'billing_amt' =>  $request->input('billing_amt'.$i)
                    ]);

                    if($request->billing_desc1 === 'Water'){
                        DB::table('tenants')
                        ->where('tenant_id', $request->input('billing_tenant_id'.$i))
                        ->where('tenant_status', 'active')
                       
                        ->update(
                                    [
                                        
                                        'previous_water_reading' => $request->input('current_reading'.$i),
                                    ]
                                );
                    }elseif($request->billing_desc1 === 'Electricity'){
                        DB::table('tenants')
                        ->where('tenant_id', $request->input('billing_tenant_id'.$i))
                        ->where('tenant_status', 'active')
                        
                        ->update(
                                    [
                                        
                                        'previous_electric_reading' => $request->input('current_reading'.$i),
                                    ]
                                );
                    }

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
            }
            return redirect('/property/'.$request->property_id.'/bills')->with('success', ($no_of_billed-1).' '.$request->billing_desc1.' bills have been posted!');
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
    public function edit($property_id, $unit_id, $tenant_id)
    {

        if(auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'manager' ){
            
            //get the tenant information
            $tenant = Tenant::findOrFail($tenant_id);

            $room = Unit::findOrFail($unit_id);

            $property = Property::findOrFail($property_id);
    
            //get the number of last added bills
            $current_bill_no = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('property_id_foreign', $property_id)
            ->max('billing_no') + 1;

            $balance = Billing::leftJoin('payments', 'billings.billing_id', '=', 'payments.payment_billing_id') 
            ->selectRaw('* ,billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
            ->where('billing_tenant_id', $tenant_id)
            ->groupBy('billing_no')
            ->orderBy('billing_no', 'desc')
            ->havingRaw('balance > 0')
            ->get();

            return view('webapp.bills.edit-billings', compact('current_bill_no','tenant', 'room', 'balance', 'property'));  
        }else{
            return view('unregistered');
        }
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

    public function post_edited_bills(Request $request, $property_id, $unit_id, $tenant_id){

        if(auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'manager' ){


            $balance = Billing::leftJoin('payments', 'billings.billing_id', '=', 'payments.payment_billing_id') 
            ->selectRaw('* ,billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
            ->where('billing_tenant_id', $tenant_id)
            ->groupBy('billing_no')
            ->orderBy('billing_no', 'desc')
            ->havingRaw('balance > 0')
            ->get();
        
        
            for ($i=1; $i <= $balance->count(); $i++) { 
                DB::table('billings')
                ->where('billing_id', $request->input('billing_id_ctr'.$i))
                ->update
                        (
                            [
                                'billing_start' => $request->input('billing_start_ctr'.$i),
                                'billing_end' => $request->input('billing_end_ctr'.$i),
                                'billing_amt' => $request->input('billing_amt_ctr'.$i),
                            ]
                        );
               }

               DB::table('users')
               ->where('property', Auth::user()->property)
               ->update(
                       [
                           'note' => $request->note,
                       ]
                   );
          
          
            return redirect('/property/'.$property_id.'/home/'.$unit_id.'/tenant/'.$tenant_id.'#bills')->with('success','changes have been saved!');
        }else{
            return view('unregistered');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tenant_id, $billing_id)
    {


        //  DB::table("billings")
        //  ->join('tenants', 'billing_tenant_id', 'tenant_id')
        //  ->join('units', 'unit_tenant_id', 'unit_id')
        // ->where('unit_property', Auth::user()->property)
        // // ->whereIn('billing_desc', ['Water', 'Electricity'])
        // ->where('billing_desc', 'Rent')
        // ->delete();

        DB::table('billings')->where('billing_id', $billing_id)->delete();
        return back()->with('success', 'bill has been deleted!');
    }
}