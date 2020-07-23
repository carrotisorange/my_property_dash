<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;
use App\Charts\DashboardChart;
use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Payment, App\Billing;
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

        $request->session()->put(Auth::user()->id.'search_payment', $search);
        
           $collections = DB::table('units')
           ->select('*', DB::raw('sum(amt_paid) as total'))
           ->join('tenants', 'unit_id', 'unit_tenant_id')
           ->join('payments', 'tenant_id', 'payment_tenant_id')
           ->groupBy('tenant_id')
           ->groupBy('payment_created')
           ->where('unit_property', Auth::user()->property)
           ->where('payment_created', $search)
           ->orderBy('payment_created', 'desc')
           ->get();
    
       return view('billing.collections', compact('collections'));
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

        $movein_charges = DB::table('billings')
        ->where('billing_tenant_id', $request->payment_tenant_id)
        ->whereIn('billing_desc', ['Security Deposit (Utilities)', 'Security Deposit (Rent)', 'Advance Rent', 'Others', 'Management Fee', 'General Cleaning'])
        ->where('billing_status', 'unpaid')
        ->sum('billing_amt');

        //payment for movein charges
       if($request->tenant_status === 'pending'){
        if($movein_charges <= $request->amt_paid){
            for($i = 1; $i<=$request->ctr; $i++){
            DB::table('payments')->insert(
                [
                    'payment_tenant_id' => $request->payment_tenant_id,
                    'payment_billing_no' => $request->input('billno'.$i),
                    'payment_created' => $request->payment_created,
                    'amt_paid' => $request->input('amt'.$i),
                    'or_number' => $request->or_number,
                    'ar_number' => $request->ar_number,
                    'bank_name' => $request->bank_name,
                    'form_of_payment' => $request->form_of_payment,
                    'check_no' => $request->check_no,
                    'date_deposited' => $request->date_deposited,
                    'payment_note' =>  $request->input('desc'.$i),
                ]
            );
            }

            //change the billing status to paid,
            DB::table('billings')
            ->where('billing_tenant_id', $request->payment_tenant_id)
            ->where('billing_status', 'unpaid')
            ->update(
                        [
                            'billing_status' => 'paid'
                        ]
                    );
            
            //change the unit status to occupied.
            DB::table('units')
            ->where('unit_id', $request->unit_tenant_id)
            ->update(
                        [
                            'status'=> 'occupied',
                            'updated_at' => Carbon::now(), 
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

            return back()->with('success','Payment has been recorded!');
        }else{
            return back()->with('danger','Payment has been rejected. Insufficient amount!');
        }
       }       

       
       $billing_no =  DB::table('billings')
       ->where('billing_tenant_id', $request->payment_tenant_id)
       ->where('billing_desc', $request->payment_note)
       ->where('billing_status', 'unpaid')
       ->where('details', $request->details)
       ->update(
                   [
                       'billing_status' => 'paid',
                       'created_at' => Carbon::now(),
                   ]
               );

        DB::table('payments')
                ->insert(
                            [
                                'payment_tenant_id' => $request->payment_tenant_id,
                                'payment_billing_no' => $billing_no->billing_no,
                                'payment_created' => $request->payment_created,
                                'amt_paid' => $request->amt_paid,
                                'or_number' => $request->or_number, //period covered
                                'ar_number' => $request->ar_number,
                                'bank_name' => $request->bank_name,
                                'form_of_payment' => $request->form_of_payment,
                                'check_no' => $request->check_no,
                                'date_deposited' => $request->date_deposited,
                                'payment_note' => $request->payment_note //payment description
                            ]
                        );


            return back()->with('success','Payment has been recorded!');
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
    public function destroy($payment_id)
    {
        DB::table('payments')->where('payment_id', $payment_id)->delete();

        return back()->with('success', 'Payment has been successfully deleted!');
    }

}
