<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;
use App\Charts\DashboardChart;
use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Payment, App\Billing;
use Carbon\Carbon;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;

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
        ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
       
        ->leftJoin('payments', 'tenant_id', 'payment_tenant_id')
        ->leftJoin('billings', 'payment_billing_no', 'billing_no')
        ->where('unit_property', Auth::user()->property)
        ->where('payment_created', $search)
        ->orderBy('payment_created', 'desc')
        ->orderBy('ar_number', 'desc')
        ->groupBy('payment_id')
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->payment_created)->timestamp;
        });

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
        
        // retrieve the number of payments to be added.
        $no_of_payments = (int) $request->no_of_payments; 

        //get the ar number
        $payment_ctr = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->max('ar_number') + 1;

        //add all the payment to the database.
        for($i = 1; $i<$no_of_payments; $i++){
             $explode = explode("-",  $request->input('billing_no'.$i));
            DB::table('payments')->insert(
                [
                    'payment_tenant_id' => $request->payment_tenant_id, 
                    'payment_billing_no' => $explode[0], 
                    'payment_billing_id' => $explode[1],
                    'amt_paid' => $request->input('amt_paid'.$i),
                    'payment_created' => $request->payment_created,
                    'or_number' => $request->or_number,
                    'ar_number' => $payment_ctr,
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

            //send welcome email to the tenant
            Mail::send('emails.user-generated-mail', $data, function($message) use ($data){
                $message->to($data['email']);
                $message->subject('Welcome Message');
            });
        }

        return back()->with('success', ($i-1).' payments have been added!');

    //     $balance = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
    //    ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
    //    ->where('billing_tenant_id', $request->payment_tenant_id)
    //    ->whereIn('billing_desc', ['Security Deposit (Utilities)', 'Advance Rent', 'Security Deposit (Rent)'])
    //    ->groupBy('billing_id')
    //    ->havingRaw('balance > 0')
    //    ->get();


    //     //payment for movein charges
    //    if($request->tenant_status === 'pending'){
    //     if($balance->sum('balance') <= $request->amt_paid){
    //         for($i = 1; $i<=$request->ctr; $i++){
    //         DB::table('payments')->insert(
    //             [
    //                 'payment_tenant_id' => $request->payment_tenant_id,
    //                 'payment_billing_no' => $request->input('billno'.$i),
    //                 'payment_created' => $request->payment_created,
    //                 'amt_paid' => $request->input('amt'.$i),
    //                 'or_number' => $request->or_number,
    //                 'ar_number' => $request->ar_number,
    //                 'bank_name' => $request->bank_name,
    //                 'form_of_payment' => $request->form_of_payment,
    //                 'check_no' => $request->check_no,
    //                 'date_deposited' => $request->date_deposited,
    //                 'payment_note' =>  $request->input('desc'.$i),
    //                 'created_at' => Carbon::now(),
    //             ]
    //         );
    //         }
            
    //         //change the unit status to occupied.
    //         DB::table('units')
    //         ->where('unit_id', $request->unit_tenant_id)
    //         ->update(
    //                     [
    //                         'status'=> 'occupied',
    //                         'updated_at' => Carbon::now(), 
    //                     ]
    //             );

            
    //         //change tenant's status to active.
    //         DB::table('tenants')
    //         ->where('tenant_id', $request->payment_tenant_id)
    //         ->update(
    //                     [
    //                         'tenant_status'=> 'active',
    //                         'tenants_note' => 'new'
    //                     ]
    //                 );

    //         $tenant = Tenant::findOrFail($request->payment_tenant_id);
    //         $unit  = Unit::findOrFail($request->unit_tenant_id);

    //         $data = array(
    //             'email' => $tenant->email_address,
    //             'name' => $tenant->first_name,
    //             'unit' => $unit->building.' '.$unit->unit_no,
    //             'contract_ends_at'  => $tenant->moveout_date,
    //             'contract_starts_at'  => $tenant->moveout_date,
    //             'monthly_rent'=> $tenant->tenant_monthly_rent
    //         );
        
    //         // Mail::send('emails.user-generated-mail', $data, function($message) use ($data){
    //         //     $message->to($data['email']);
    //         //     $message->subject('Welcome Message');
    //         // });
            
    //         DB::table('notifications')->insertGetId(
    //             [
    //                 'notification_tenant_id' => $tenant->tenant_id,
    //                 'notification_room_id' => $tenant->unit_tenant_id,
    //                 'notification_user_id' => Auth::user()->id,
    //                 'action' => 'has been added to the property!',
    //                 'created_at' => Carbon::now(),
    //             ]
    //         );

    //         return back()->with('success','Payment has been recorded!');
    //     }else{
    //         return back()->with('danger','Payment has been rejected. Insufficient amount!');
    //     }
    //    }       


    //    $count_billed = DB::table('billings')
    //    ->where('billing_tenant_id', $request->payment_tenant_id)
    //    ->where('billing_desc', $request->payment_note)
    //    ->where('billing_status', 'unpaid')
    //    ->where('details', $request->details)
    //    ->count();

    //    if($count_billed <= 0){
    //     return back()->with('danger','Payment has been rejected. Bill was not found!');
    //    }else{
        // DB::table('billings')
        // ->where('billing_tenant_id', $request->payment_tenant_id)
        // ->where('billing_desc', $request->payment_note)
        // ->where('billing_status', 'unpaid')
        // ->where('details', $request->details)
        // ->update(
        //             [
        //                 'billing_status' => 'paid',
        //                 'created_at' => Carbon::now(),
        //             ]
        //         ); 
 
        // $current_bill_no = DB::table('units')
        // ->join('tenants', 'unit_id', 'unit_tenant_id')
        // ->join('billings', 'tenant_id', 'billing_tenant_id')
        // ->where('unit_property', Auth::user()->property)
        // ->max('billing_no') + 1;
 
        //  DB::table('payments')
        //          ->insert(
        //                      [
        //                          'payment_tenant_id' => $request->payment_tenant_id,
        //                          'payment_billing_no' => $request->billing_no,
        //                          'payment_created' => $request->payment_created,
        //                          'amt_paid' => $request->amt_paid,
        //                          'ar_number' => $request->ar_number,
        //                          'bank_name' => $request->bank_name,
        //                          'form_of_payment' => $request->form_of_payment,
        //                          'check_no' => $request->check_no,
        //                          'date_deposited' => $request->date_deposited,
        //                          'created_at' => Carbon::now(),
        //                      ]
        //                  );
       
        
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
    
        DB::table('payments')->where('payment_id', $payment_id)->delete();

        return back()->with('success', 'Payment has been successfully deleted!');
    }

}
