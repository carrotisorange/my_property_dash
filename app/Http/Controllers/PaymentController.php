<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use DB, Auth;
use App\Charts\DashboardChart;
use App\Unit, App\UnitOwner, App\Tenant, App\User;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $request->session()->put(Auth::user()->property.'search_payment', $search);

        $payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->groupBy('tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->where('payment_created', $search)
        ->get();

       return view('treasury.show-all-payments', compact('payments'));
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
        $movein_charges = DB::table('billings')
        ->where('billing_tenant_id', $request->payment_tenant_id)
        ->whereIn('billing_desc', ['Security Deposit (Utilities)', 'Security Deposit (Rent)', 'Advance Rent'])
        ->where('billing_status', 'unpaid')
        ->sum('billing_amt');

        //payment for movein charges
       if($request->tenant_status === 'pending'){
        if($movein_charges <= $request->amt_paid){

            DB::table('payments')->insert([
                'payment_tenant_id' => $request->payment_tenant_id,
                'payment_created' => $request->payment_created,
                'amt_paid' => $request->amt_paid,
                'or_number' => $request->or_number,
                'ar_number' => $request->ar_number,
                'bank_name' => $request->bank_name,
                'form_of_payment' => $request->form_of_payment,
                'check_no' => $request->check_no,
                'date_deposited' => $request->date_deposited,
                'payment_note' => $request->payment_note,
            ]);
            
            //change tenant's status to active.
            DB::table('tenants')
            ->where('tenant_id', $request->payment_tenant_id)
            ->update(['tenant_status'=> 'active']);

            //change the billing status to paid,
            DB::table('billings')
            ->where('billing_tenant_id', $request->payment_tenant_id)
            ->update(['billing_status' => 'paid']);
            
            //change the unit status to occupied.
            DB::table('units')
            ->where('unit_id', $request->unit_tenant_id)
            ->update(['status'=> 'occupied']);

           
        }else{
            return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->payment_tenant_id.'/billings')->with('error','Payment has been rejected. Insufficient amount!');
        }
       }else{
                DB::table('payments')->insert([
                    'payment_tenant_id' => $request->payment_tenant_id,
                    'payment_created' => $request->payment_created,
                    'amt_paid' => $request->amt_paid,
                    'or_number' => $request->or_number,
                    'ar_number' => $request->ar_number,
                    'bank_name' => $request->bank_name,
                    'form_of_payment' => $request->form_of_payment,
                    'check_no' => $request->check_no,
                    'date_deposited' => $request->date_deposited,
                    'payment_note' => $request->payment_note
                ]);
    
                $count_payment_note =  count(explode(',',$request->payment_note));

                if($count_payment_note >1){
                     //change the billing status to paid.
                    DB::table('billings')
                    ->where('billing_tenant_id', $request->payment_tenant_id)
                    ->whereRaw("billing_desc like '%$request->payment_note_%' ")
                    ->where('billing_status', 'unpaid')
                    ->update(['billing_status' => 'paid']); 
                }else{
                    //change the billing status to paid.
                    DB::table('billings')
                    ->where('billing_tenant_id', $request->payment_tenant_id)
                    ->whereRaw("billing_desc like '%$request->payment_note%' ")
                    ->where('billing_status', 'unpaid')
                    ->update(['billing_status' => 'paid']); 
                }
               
       }

       return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->payment_tenant_id.'/billings')->with('success','Payment has been successfully added!');
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
    public function destroy($id)
    {
        //
    }
}
