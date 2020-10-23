<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;
use App\Charts\DashboardChart;
use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Payment, App\Billing;
use Carbon\Carbon;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $request->session()->put(Auth::user()->id.'search_payment', $search);

        
        $collections = DB::table('units')
        ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
       
        ->leftJoin('payments', 'tenant_id', 'payment_tenant_id')
        ->leftJoin('billings', 'payment_billing_no', 'billing_no')
        ->where('unit_property', Auth::user()->property)
        ->where('payment_created', $search)
        ->orderBy('payment_created', 'desc')
        ->orderBy('ar_no', 'desc')
        ->groupBy('payment_id')
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->payment_created)->timestamp;
        });

       return view('webapp.collections.collections', compact('collections'));
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
    public function store(Request $request){ 
        
        // retrieve the number of payments to be added.
        $no_of_payments = (int) $request->no_of_payments; 

        //get the ar number
        $payment_ctr = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->max('ar_no') + 1;


        //add all the payment to the database.
        for($i = 1; $i<$no_of_payments; $i++){
             $explode = explode("-", $request->input('billing_no'.$i));
            DB::table('payments')->insert(
                [
                    'payment_tenant_id' => $request->payment_tenant_id, 
                    'payment_billing_no' => $explode[0], 
                    'payment_billing_id' => $explode[1],
                    'amt_paid' => $request->input('amt_paid'.$i),
                    'payment_created' => $request->payment_created,
                    'ar_no' => $payment_ctr,
                    'bank_name' => $request->input('bank_name'.$i),
                    'form_of_payment' => $request->input('form_of_payment'.$i),
                    'check_no' => $request->input('cheque_no'.$i),
                    'date_deposited' => $request->date_deposited,
                    'created_at' => Carbon::now(),
                ]
           );
        }

        //do the action below if the tenant status is pending.
        if($request->tenant_status === 'pending'){
            //change the unit status to occupied.
            DB::table('units')
                ->where('unit_id', $request->unit_tenant_id)
                ->update(
                            [
                                'status'=> 'occupied',
                                'updated_at' => Carbon::now(), 
                            ]
                        );

            //update the occupancy rate
               
            $units = DB::table('units')->where('unit_property', Auth::user()->property)->where('status','<>','deleted')->count();

            $occupied_units = DB::table('units')->where('unit_property', Auth::user()->property)->where('status', 'occupied')->count();
    
            DB::table('occupancy_rate')
                ->insert(
                            [
                                'occupancy_rate' => ($occupied_units/$units) * 100,
                                'occupancy_property' => Auth::user()->property,
                                'occupancy_date' => Carbon::now()
                            ]
                        );
   
                    
            //change tenant's status to active.
            DB::table('tenants')
                ->where('tenant_id', $request->payment_tenant_id)
                ->update(
                            [
                                'tenant_status'=> 'active',
                                'tenants_note' => 'new'
                            ]
                        );

            //retrieve all the tenant information
            $tenant = Tenant::findOrFail($request->payment_tenant_id);
            //retrieve all the unit information
            $unit  = Unit::findOrFail($request->unit_tenant_id);

            //assign the value of tenant and unit information to variable data
            $data = array(
                'email' => $tenant->email_address,
                'name' => $tenant->first_name,
                'unit' => $unit->building.' '.$unit->unit_no,
                'contract_ends_at'  => $tenant->moveout_date,
                'contract_starts_at'  => $tenant->moveout_date,
                'monthly_rent'=> $tenant->tenant_monthly_rent
            );

            if($tenant->email_address !== null){
                //send welcome email to the tenant
                Mail::send('webapp.tenants.user-generated-mail', $data, function($message) use ($data){
                $message->to($data['email']);
             
                $message->subject('Welcome Tenant');
            });
            }
           
        }

        if(Auth::user()->user_type === 'manager'){
            return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->payment_tenant_id.'/#payments')->with('success', ($i-1).' payment/s have been added!');
        }else{
            return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->payment_tenant_id.'/billings#profile')->with('success', ($i-1).' payment/s have been added!');
        }
        
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unit_id, $tenant_id, $payment_id)
    {

        if(Auth::user()->status === 'unregistered')
             return view('unregistered'); 

         else
             $payment = DB::table('units')
             ->join('tenants', 'unit_id', 'unit_tenant_id')
             ->join('payments', 'tenant_id', 'payment_tenant_id')
             ->where('payment_id', $payment_id)
             ->where('amt_paid','>',0)
            ->get();

         return view('treasury.show-payment', compact('payment'));
        
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
    public function destroy($tenant_id,$payment_id)
    {

        // DB::table("payments")->delete();

        $tenant = Tenant::findOrFail($tenant_id);
    
        DB::table('payments')->where('payment_id', $payment_id)->delete();

        return back()->with('success', ' Payment has been deleted!');
    }

}
