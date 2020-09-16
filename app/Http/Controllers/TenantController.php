<?php

namespace App\Http\Controllers;

use App\Tenant;
use App\Payment;
use Illuminate\Http\Request;
use DB;
use App\Unit;
use App\Personnel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Billing;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //
    }

    public function search(Request $request){   
        $search = $request->get('search');

        //create session for the search
        $request->session()->put(Auth::user()->id.'search_tenant', $search);

        $tenants = DB::table('tenants')
                ->join('units', 'unit_id', 'unit_tenant_id')
                ->where('unit_property', Auth::user()->property)
                ->whereRaw("concat(first_name, ' ', last_name) like '%$search%' ")
                // ->orWhereRaw("email_address like '%$search%' ")
                // ->orWhereRaw("contact_no like '%$search%' ")
                // ->orderBy('movein_date', 'desc')
                ->paginate(10);
    
        
         $count_tenants = DB::table('tenants')
         ->join('units', 'unit_id', 'unit_tenant_id')
         ->where('unit_property', Auth::user()->property)
         ->count();

        return view('admin.tenants', compact('tenants', 'count_tenants'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //get the number of last added bills
            $current_bill_no = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->max('billing_no') + 1;

        return view('tenants.create', compact('current_bill_no'));
    }

    public function postTenantStep1(Request $request, $unit_id){
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required',
            'email_address' => 'required',
        ]);

        $request->session()->put(Auth::user()->id.'type_of_tenant', 'student');
        $request->session()->put(Auth::user()->id.'first_name', $request->first_name);
        $request->session()->put(Auth::user()->id.'contact_no', $request->contact_no);
        $request->session()->put(Auth::user()->id.'last_name', $request->last_name);
        $request->session()->put(Auth::user()->id.'middle_name', $request->middle_name);
        $request->session()->put(Auth::user()->id.'birthdate', $request->birthdate);
        $request->session()->put(Auth::user()->id.'gender', $request->gender);
        $request->session()->put(Auth::user()->id.'civil_status', $request->civil_status);
        $request->session()->put(Auth::user()->id.'id_number', $request->id_number);
        $request->session()->put(Auth::user()->id.'email_address', $request->email_address);
        $request->session()->put(Auth::user()->id.'barangay', $request->barangay);
        $request->session()->put(Auth::user()->id.'city', $request->city);
        $request->session()->put(Auth::user()->id.'province', $request->province);
        $request->session()->put(Auth::user()->id.'country', $request->country);
        $request->session()->put(Auth::user()->id.'zip_code', $request->zip_code);
        $request->session()->put(Auth::user()->id.'guardian', $request->guardian);
        $request->session()->put(Auth::user()->id.'guardian_relationship', $request->guardian_relationship);
        $request->session()->put(Auth::user()->id.'guardian_contact_no', $request->guardian_contact_no);

        return redirect('/units/'.$unit_id.'/tenant-step2');
    }

    public function createTenantStep2()
    {   
        return view('admin.create-tenant-step-2');
    }

    public function postTenantStep2(Request $request, $unit_id){

        $request->session()->put(Auth::user()->id.'high_school', $request->high_school);
        $request->session()->put(Auth::user()->id.'high_school_address', $request->high_school_address);
        $request->session()->put(Auth::user()->id.'college_school', $request->colleges_school);
        $request->session()->put(Auth::user()->id.'college_school_address', $request->college_school_address);
        $request->session()->put(Auth::user()->id.'course', $request->course);
        $request->session()->put(Auth::user()->id.'year_level', $request->year_level);
        $request->session()->put(Auth::user()->id.'employer', $request->employer);
        $request->session()->put(Auth::user()->id.'employer_address', $request->employer_address);
        $request->session()->put(Auth::user()->id.'job', $request->job);
        $request->session()->put(Auth::user()->id.'years_of_employment', $request->years_of_employment);
        $request->session()->put(Auth::user()->id.'employer_contact_no', $request->employer_contact_no);

        return redirect('/units/'.$unit_id.'/tenant-step3');
    }

    public function createTenantStep3()
    {   
        return view('admin.create-tenant-step-3');
    }

    public function postTenantStep3(Request $request, $unit_id){

        if($request->moveout_date <= $request->movein_date){
            $request->session()->put(Auth::user()->id.'movein_date', $request->movein_date);
            $request->session()->put(Auth::user()->id.'moveout_date', $request->moveout_date);
            $request->session()->put(Auth::user()->id.'tenant_monthly_rent', $request->tenant_monthly_rent);
            return back()->with('danger', 'Invalid input. Make sure the moveout date is later than the movein date. ');
        }

        $request->session()->put(Auth::user()->id.'movein_date', $request->movein_date);
        $request->session()->put(Auth::user()->id.'moveout_date', $request->moveout_date);
        $request->session()->put(Auth::user()->id.'tenant_monthly_rent', $request->tenant_monthly_rent);

        return redirect('/units/'.$unit_id.'/tenant-step4');
    }

    public function createTenantStep4()
    {   
         //get the number of last added bills
         $current_bill_no = DB::table('units')
         ->join('tenants', 'unit_id', 'unit_tenant_id')
         ->join('billings', 'tenant_id', 'billing_tenant_id')
         ->where('unit_property', Auth::user()->property)
         ->max('billing_no') + 1;

        return view('admin.create-tenant-step-4', compact('current_bill_no'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // if($request->moveout_date <= $request->movein_date){
        //     $request->session()->put(Auth::user()->id.'movein_date', $request->movein_date);
        //     $request->session()->put(Auth::user()->id.'moveout_date', $request->moveout_date);
        //     $request->session()->put(Auth::user()->id.'tenant_monthly_rent', $request->tenant_monthly_rent);
        //     return back()->with('danger', 'Invalid input. Make sure the moveout date is later than the movein date. ');
        // }

        // $request->session()->put(Auth::user()->id.'movein_date', $request->movein_date);
        // $request->session()->put(Auth::user()->id.'moveout_date', $request->moveout_date);
        // $request->session()->put(Auth::user()->id.'tenant_monthly_rent', $request->tenant_monthly_rent);

        //insert tenant to a specific unit
        $tenant_id = DB::table('tenants')->insertGetId(
            [
                'unit_tenant_id' => session(Auth::user()->id.'unit_id'),
                'tenant_unique_id' => '',
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name'=> $request->last_name,
                'birthdate'=>$request->birthdate,
                'gender' => $request->gender,
                'civil_status'=> $request->civil_status,
                'id_number' => $request->id_number,

                // 'country' => session(Auth::user()->id.'country'),
                // 'province' => session(Auth::user()->id.'province'),
                // 'city' => session(Auth::user()->id.'city'),
                // 'barangay' => session(Auth::user()->id.'barangay'),
                // 'zip_code' => session(Auth::user()->id.'zip_code'),

                //contact number
                'contact_no' => $request->contact_no,
                'email_address' => $request->email_address,

                //guardian information
                // 'guardian' => session(Auth::user()->id.'guardian'),
                // 'guardian_relationship' => session(Auth::user()->id.'guardian_relationship'),
                // 'guardian_contact_no' => session(Auth::user()->id.'guardian_contact_no'),

                //rent information
                'tenant_monthly_rent' => $request->tenant_monthly_rent,
                'type_of_tenant' => 'walk-in',
                //change the tenant status to pending.
                'tenant_status' => 'pending',
                'movein_date'=> $request->movein_date,
                'moveout_date'=> $request->moveout_date,
        
                //information for student
                // 'high_school' => session(Auth::user()->id.'high_school'),
                // 'high_school_address' => session(Auth::user()->id.'high_school_address'),
                // 'college_school' => session(Auth::user()->id.'college_school'),
                // 'college_school_address' => session(Auth::user()->id.'college_school_address'),
                // 'course' => session(Auth::user()->id.'course'),
                // 'year_level' => session(Auth::user()->id.'year_level'),
             
                //      //information for working
                // 'employer' => session(Auth::user()->id.'employer'),
                // 'employer_address' => session(Auth::user()->id.'employer_address'),
                // 'job' => session(Auth::user()->id.'job'),
                // 'employer_contact_no' => session(Auth::user()->id.'employer_contact_no'),
                // 'years_of_employment' => session(Auth::user()->id.'years_of_employment'),
            
        ]);

          //get the number of last added bills

        $current_bill_no = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->max('billing_no') + 1;
                
        
    //    //create movein charges of the tenant.
    //     for($i = 0; $i<3 ; $i++){
    //         DB::table('billings')->insert(
    //             [
    //                 'billing_tenant_id' => $tenant_id,
    //                 'billing_no' => $current_bill_no++,
    //                 'billing_date' => session(Auth::user()->id.'movein_date'),
    //                 'billing_desc' =>  $request->input('desc'.$i),
    //                 'billing_amt' =>  $request->input('amt'.$i),
    //                 'billing_start' =>  session(Auth::user()->id.'movein_date'),
    //                 'billing_end'=> session(Auth::user()->id.'moveout_date'),
    //             ]);
    //     }        

        //change the unit status to reserved
         DB::table('units')->where('unit_id', session(Auth::user()->id.'unit_id'))
             ->update(
                        [
                            'status'=> 'reserved',
                            'updated_at' => $request->movein_date,   
                        ]
                    );

        //delete all the session created during the tenant's registration.
        // $request->session()->forget(Auth::user()->id.'first_name');
        // $request->session()->forget(Auth::user()->id.'middle_name');
        // $request->session()->forget(Auth::user()->id.'last_name');
        // $request->session()->forget(Auth::user()->id.'birthdate');
        // $request->session()->forget(Auth::user()->id.'gender');
        // $request->session()->forget(Auth::user()->id.'civil_status');
        // $request->session()->forget(Auth::user()->id.'id_number');
      

        // $request->session()->forget(Auth::user()->id.'zip_code');
        // $request->session()->forget(Auth::user()->id.'country');
        // $request->session()->forget(Auth::user()->id.'province');
        // $request->session()->forget(Auth::user()->id.'city');
        // $request->session()->forget(Auth::user()->id.'barangay');

        // $request->session()->forget(Auth::user()->id.'contact_no');
        // $request->session()->forget(Auth::user()->id.'email_address');

        // // $request->session()->forget(Auth::user()->id.'guardian');
        // // $request->session()->forget(Auth::user()->id.'guardian_relationship');
        // // $request->session()->forget(Auth::user()->id.'guardian_contact_no');
        
        // $request->session()->forget(Auth::user()->id.'tenant_monthly_rent');
        // // $request->session()->forget(Auth::user()->id.'type_of_tenant');

        // $request->session()->forget(Auth::user()->id.'movein_date');
        // $request->session()->forget(Auth::user()->id.'moveout_date');

        // $request->session()->forget(Auth::user()->id.'high_school');
        // $request->session()->forget(Auth::user()->id.'high_school_address');
        // $request->session()->forget(Auth::user()->id.'college_school');
        // $request->session()->forget(Auth::user()->id.'college_school_address');
        // $request->session()->forget(Auth::user()->id.'course');
        // $request->session()->forget(Auth::user()->id.'year_level');

        // $request->session()->forget(Auth::user()->id.'employer');
        // $request->session()->forget(Auth::user()->id.'employer_address');
        // $request->session()->forget(Auth::user()->id.'job');
        // $request->session()->forget(Auth::user()->id.'years_of_employment');
        // $request->session()->forget(Auth::user()->id.'employer_contact_no');

       
         $no_of_items = (int) $request->no_of_items; 

        for($i = 1; $i<$no_of_items; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $tenant_id,
                    'billing_no' => $current_bill_no++,
                    'billing_date' => $request->movein_date,
                    'billing_start' =>  $request->movein_date,
                    'billing_end' =>  $request->moveout_date,
                    'billing_desc' =>  $request->input('billing_desc'.$i),
                    'billing_amt' =>  $request->input('billing_amt'.$i)
                ]);
        }

        if(Auth::user()->user_type === 'admin'){
            return redirect('/units/'.session(Auth::user()->id.'unit_id').'/tenants/'.$tenant_id)->with('success', 'New tenant has been added to the property!');
        }else{
            return redirect('/units/'.session(Auth::user()->id.'unit_id').'/tenants/'.$tenant_id.'/billings')->with('success', 'New tenant has been added to the property!');
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show($unit_id, $tenant_id)
    {
        if(Auth::user()->status === 'registered'|| auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'billing'){
            $tenant = Tenant::findOrFail($tenant_id);

            $unit = Unit::findOrFail($unit_id);

            $personnels = DB::table('personnels')->where('personnel_property', Auth::user()->property)->get();
        

            $concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_id', $tenant_id)
            ->orderBy('date_reported', 'desc')
            ->orderBy('concern_urgency', 'desc')
            ->orderBy('concern_status', 'desc')
            ->paginate(10);

            $payments = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_id', $tenant_id)            
            ->orderBy('payment_created', 'desc')
            ->get()
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->payment_created)->timestamp;
            });

              //get the number of last added bills
            $current_bill_no = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->max('billing_no') + 1;

            $balance = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
            ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
            ->where('billing_tenant_id', $tenant_id)
            ->groupBy('billing_id')
            ->orderBy('billing_no', 'desc')
            ->havingRaw('balance > 0')
            ->get();

            
                return view('admin.show-tenant', compact('tenant','personnels' , 'payments','concerns', 'current_bill_no', 'balance', 'unit'));  
        }else{
                return view('unregistered');
        }
    }

    public function show_billings($unit_id, $tenant_id){

        if(auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'treasury' || auth()->user()->user_type === 'manager' ){
            
            //get the tenant information
            $tenant = Tenant::findOrFail($tenant_id);

            $room = Unit::findOrFail($unit_id);
    
            //get the ar number
            $payment_ctr = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->max('ar_number') + 1;

            //get the number of last added bills
            $current_bill_no = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->max('billing_no') + 1;

            //get the move in charges
            // $movein_charges = DB::table('billings')
            // ->where('billing_tenant_id', $tenant_id)
            // ->where('billing_amt','>',0)
            // ->whereIn('billing_desc', ['Security Deposit (Utilities)', 'Security Deposit (Rent)', 'Advance Rent', 'Others', 'Management Fee', 'General Cleaning'])
            // ->get();

            //count the number of payments made
            $payments = DB::table('payments')
            ->where('payment_tenant_id', $tenant_id)
            ->where('amt_paid','>',0)
            ->count();

            $balance = Billing::leftJoin('payments', 'billings.billing_id', '=', 'payments.payment_billing_id') 
            ->selectRaw('* ,billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
            ->where('billing_tenant_id', $tenant_id)
            ->groupBy('billing_no')
            ->orderBy('billing_no', 'desc')
            ->havingRaw('balance > 0')
            ->get();

            return view('billing.show-billings', compact('current_bill_no','tenant','payment_ctr','payments', 'room', 'balance'));  
        }else{
            return view('unregistered');
        }
    }

    public function show_payments($unit_id, $tenant_id){

        $tenant = Tenant::findOrFail($tenant_id);


    //   return  $collections = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
    //     ->selectRaw('*, billing_amt - IFNULL(sum(amt_paid),0) as balance')
    //     ->where('billing_tenant_id', $tenant_id)
    //     ->groupBy('billing_id')
    //     ->orderBy('billing_no', 'desc')
    //     ->havingRaw('balance > 0')
    //     ->get();

        $collections = DB::table('units')
        ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
        ->leftJoin('payments', 'tenant_id', 'payment_tenant_id')
        ->leftJoin('billings', 'payment_billing_no', 'billing_no')
        ->where('tenant_id', $tenant_id)
        ->orderBy('payment_created', 'desc')
        ->orderBy('ar_number', 'desc')
        ->groupBy('payment_id')
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->payment_created)->timestamp;
        });
    


        // $collections = DB::table('units')
        // ->join('tenants', 'unit_id', 'unit_tenant_id')
        // // ->join('billings', 'tenant_id', 'billing_tenant_id')
        // ->join('payments', 'tenant_id', 'payment_tenant_id')
        // ->where('tenant_id', $tenant_id)
        // // ->whereIn('payment_note',['Rent', 'Electricity', 'Water', 'Surcharge'])
        // ->orderBy('payment_created', 'desc')
        // ->orderBy('ar_number', 'desc')
        // ->get()
        // ->groupBy(function($item) {
        //     return \Carbon\Carbon::parse($item->payment_created)->timestamp;
        // });


        // $collections = DB::table('units')
        //     ->join('tenants', 'unit_id', 'unit_tenant_id')
        //     ->join('payments', 'tenant_id', 'payment_tenant_id')
        //     ->where('unit_property', Auth::user()->property)
        //     ->where('tenant_id', $tenant_id)
        //     ->where('amt_paid','>',0)
        //     // ->whereIn('payment_note',['Rent', 'Electricity', 'Water', 'Surcharge'])
            
        //     ->orderBy('payment_created', 'desc')
        //     ->orderBy('payment_id', 'desc')
        //     ->get()
        //     ->groupBy(function($item) {
        //         return \Carbon\Carbon::parse($item->payment_created)->timestamp;
        //     });
 
        return view('billing.show-payments', compact('collections', 'tenant'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit($unit_id, $tenant_id)
    {
        if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
            $tenant = Tenant::findOrFail($tenant_id);
            return view('admin.edit-tenant', compact('tenant'));
        }else{
            return view('unregistered');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $unit_id, $tenant_id)
    { 
        
        if($request->action==='request to moveout'){

            DB::table('notifications')->insertGetId(
                [
                    'notification_tenant_id' => $tenant_id,
                    'notification_room_id' => $unit_id,
                    'notification_user_id' => Auth::user()->id,
                    'action' => 'has requested to moveout!',
                    'created_at' => Carbon::now(),
                ]
            );

            DB::table('tenants')
            ->where('tenant_id', $tenant_id)
            ->update(
                [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'reason_for_moving_out' => $request->reason_for_moving_out,
                    'actual_move_out_date' => $request->actual_move_out_date,
                ]
            );

            $no_of_bills = (int) $request->no_of_bills; 

            //get the number of last added bills
            $current_bill_no = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->max('billing_no') + 1;

            for($i = 1; $i<$no_of_bills; $i++){
                DB::table('billings')->insert(
                    [
                        'billing_tenant_id' => $request->tenant_id,
                        'billing_no' => $current_bill_no++,
                        'billing_date' => $request->actual_move_out_date,
                        'billing_desc' =>  $request->input('billing_desc'.$i),
                        'billing_amt' =>  $request->input('billing_amt'.$i)
                    ]);
            }
                $tenant = Tenant::findOrFail($tenant_id);
                $unit = Unit::findOrFail($unit_id);

                $balance = Billing::leftJoin('payments', 'billings.billing_id', '=', 'payments.payment_billing_id') 
                ->selectRaw('* ,billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
                ->where('billing_tenant_id', $tenant_id)
                ->groupBy('billing_no')
                ->orderBy('billing_no', 'desc')
                ->havingRaw('balance > 0')
                ->get();

               //assign the value of tenant and unit information to variable data
               $data = array(
                'email' => $tenant->email_address,
                'name' => $tenant->first_name,
                'unit' => $unit->building.' '.$unit->unit_no,
                'contract_ends_at'  => $tenant->moveout_date,
                'contract_starts_at'  => $tenant->moveout_date,
                'balance' => $balance
            );

                //send welcome email to the tenant
                Mail::send('emails.send-request-moveout-mail', $data, function($message) use ($data){
                    $message->to($data['email']);
                    $message->subject('Request to Moveout');
                });
        
         

            return redirect('/units/'.$unit_id.'/tenants/'.$tenant_id)->with('success','Request to moveout has been sent!');
        }
        
           

        if($request->action==='approve to moveout'){
            DB::table('notifications')->insertGetId(
                [
                    'notification_tenant_id' => $tenant_id,
                    'notification_room_id' => $unit_id,
                    'notification_user_id' => Auth::user()->id,
                    'action' => 'request to moveout has been approved!',
                    'created_at' => Carbon::now(),
                ]
            );

            DB::table('tenants')
            ->where('tenant_id', $tenant_id)
            ->update(
                [
                    'updated_at' => Carbon::now(),
                    'reason_for_moving_out' => $request->reason_for_moving_out,
                    'actual_move_out_date' => $request->actual_move_out_date,
                ]
            );

            return redirect('/units/'.$unit_id.'/tenants/'.$tenant_id)->with('success','Request to moveout has been approved!');

        }

        if($request->action==='open notification'){
            DB::table('notifications')
            ->where('notification_id', $request->notification_id)
            ->update([
                'updated_at' => Carbon::now()
            ]);

            return redirect('/units/'.$unit_id.'/tenants/'.$tenant_id);

        }
           
       
        DB::table('tenants')
        ->where('tenant_id', $tenant_id)
        ->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'id_number' => $request->id_number,

                'contact_no' => $request->contact_no,
                'email_address' => $request->email_address,

                'barangay'=> $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'country' => $request->country,
                'zip_code' => $request->zip_code,

                'guardian' => $request->guardian,
                'guardian_relationship' => $request->guardian_relationship,
                'guardian_contact_no' => $request->guardian_contact_no,

                'high_school' => $request->high_school,
                'high_school_address' =>$request->high_school_address,
                'college_school' => $request->college_school,
                'college_school_address' => $request->college_school_address,
                'course' => $request->course,
                'year_level' => $request->year_level,
                
                'employer' => $request->employer,
                'employer_address' => $request->employer_address,
                'employer_contact_no' => $request->employer_contact_no,
                'job' => $request->job,
                'years_of_employment' => $request->years_of_employment,

                'tenants_note' => $request->tenants_note,

                 'tenant_status' => 'active'

                'created_at' => null,

                'updated_at' => null
        ]);

        // DB::table('units')->where('unit_id', 143)->delete();
        
       return redirect('/units/'.$unit_id.'/tenants/'.$tenant_id)->with('success','Tenant information has been updated!');
    }

    public function moveout(Request $request, $unit_id, $tenant_id){      

        $tenant = Tenant::findOrFail($tenant_id);

        $unit = Unit::findOrFail($unit_id);

        DB::table('tenants')
        ->where('tenant_id', $request->tenant_id)
        ->update([
            'tenant_status' => 'inactive',
        ]);

        $no_of_active_tenants_in_the_unit = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('tenant_status', 'active')
        ->where('unit_id', $request->unit_tenant_id)
        ->count();

        if($no_of_active_tenants_in_the_unit <= 0){
            DB::table('units')
            ->where('unit_id', $request->unit_tenant_id)
            ->update([
                'status' => 'vacant'
            ]);
        }

        $data = [
                
                'tenant' => $tenant,

                'unit' => $unit,

        ];

            $pdf = \PDF::loadView('admin.gatepass', $data)->setPaper('a4', 'portrait');
      
             return $pdf->download($tenant->first_name.' '.$tenant->last_name.'.pdf');
    
        //return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->tenant_id)->with('success','Tenant has been moved out!');
    }

    public function renew(Request $request, $unit_id, $tenant_id){
        

        $renewal_history = Tenant::findOrFail($tenant_id);

          //get the number of last added bills
            $current_bill_no = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->max('billing_no') + 1;

        //retrieve the number of dynamically created.
       $no_of_items = (int) $request->no_of_items; 
        
        // if number of rows is greater than 1
        if($no_of_items < 1){
            DB::table('tenants')
            ->where('tenant_id', $tenant_id)
            ->update([
                'movein_date' => $request->movein_date, 
                'moveout_date' => Carbon::parse($request->movein_date)->addMonths($request->no_of_months),
                'tenant_status' => 'active',
                'has_extended' => 'renewed',
                'renewal_history' => $renewal_history->renewal_history.', from '.Carbon::parse($request->old_movein_date)->format('M d Y').' to -'.Carbon::parse($request->movein_date)->format('M d Y')
            ]);

            return back()->with('success', 'Tenant contract has been extended to '. $request->no_of_months.' months.');

        }else{
            //insert all the additional charges
            for($i = 1; $i<=$no_of_items; $i++){
                DB::table('billings')->insert(
                    [
                        'billing_tenant_id' => $request->tenant_id,
                        'billing_no' => $current_bill_no++,
                        'billing_date' => $request->movein_date,
                        'billing_start' =>  $request->input('billing_start'.$i),
                        'billing_end' =>  $request->input('billing_end'.$i),
                        'billing_desc' =>  $request->input('billing_desc'.$i),
                        'billing_amt' =>  $request->input('billing_amt'.$i)
                    ]);
            }

            DB::table('tenants')
            ->where('tenant_id', $tenant_id)
            ->update([
                'movein_date' => $request->movein_date, 
                'moveout_date' => Carbon::parse($request->movein_date)->addMonths($request->no_of_months),
                'tenant_status' => 'pending',
                'has_extended' => 'renewed',
                'renewal_history' => $renewal_history->renewal_history.', from '.Carbon::parse($request->old_movein_date)->format('M d Y').' to '.Carbon::parse($request->movein_date)->format('M d Y')
            ]);
    
            DB::table('units')
            ->where('unit_id', $unit_id)
            ->update([
                'status' => 'reserved'
            ]);

            return back()->with('success', 'Tenant contract has been extended to '. $request->no_of_months.' months.');
            
        }
    }

    public function add_billings(Request $request){
    
        $active_tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status', 'active')
            ->orderBy('movein_date', 'desc')
            ->get();

        $delinquent_tenants = DB::table('units')
            ->selectRaw('*,sum(billing_amt) as total_bills')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->whereIn('billing_desc', ['Surcharge', 'Rent'])
            ->where('billing_status', 'unpaid')
            ->where('billing_date', '<', Carbon::now()->addDays(7))
            ->where('billing_amt', '>', 0)
            ->groupBy('tenant_id')
            ->get();

             //get the number of last added bills
             $current_bill_no = DB::table('units')
             ->join('tenants', 'unit_id', 'unit_tenant_id')
             ->join('billings', 'tenant_id', 'billing_tenant_id')
             ->where('unit_property', Auth::user()->property)
             ->max('billing_no') + 1;
       
        if($request->billing_option === 'rent'){
            return view('billing.add-billings', compact('active_tenants','current_bill_no'));
        }

        if($request->billing_option === 'electric'){
            return view('billing.add-billings-electric', compact('active_tenants','current_bill_no'));
        }

        if($request->billing_option === 'water'){
            return view('billing.add-billings-water', compact('active_tenants','current_bill_no'));
        }

        if($request->billing_option === 'surcharge'){
            return view('billing.add-billings-surcharge', compact('delinquent_tenants','current_bill_no'));
        }
        
    }

    public function post_billings(Request $request){

        if($request->desc1 === 'Surcharge'){
           
            for($i = 1; $i<=$delinquent_tenants->count(); $i++){
                DB::table('billings')->insert(
                    [
                        'billing_no' => $current_bill_no++,
                        'billing_tenant_id' => $request->input('tenant'.$i),
                        'billing_date' => Carbon::now()->addDays(7),
                        'billing_desc' =>  $request->input('desc'.$i),
                        'billing_amt' =>  $request->input('amt'.$i),
                        'details' => $request->input('details'.$i),
                    ]);

                DB::table('tenants')
                    ->where('tenant_id', $request->input('tenant'.$i))
                    ->where('tenant_status', 'active')
                    ->update(
                                [
                                    'tenants_note' => ''
                                ]
                            );
            }

            return redirect('/bills')->with('success', ($i-1).' '.$request->desc1.' bills has been posted!');
            
        }
        else{

        for($i = 1; $i<=$active_tenants->count(); $i++){
            DB::table('billings')->insert(
                [
                    'billing_no' => $current_bill_no++,
                    'billing_tenant_id' => $request->input('tenant'.$i),
                    'billing_date' => Carbon::now()->firstOfMonth(),
                    'billing_desc' =>  $request->input('desc'.$i),
                    'details' => $request->input('details'.$i),
                    'billing_amt' =>  $request->input('amt'.$i)
                ]);

                DB::table('tenants')
                ->where('tenant_id', $request->input('tenant'.$i))
                ->where('tenant_status', 'active')
                ->update(
                            [
                                'tenants_note' => ''
                            ]
                        );
        }
    }
        
        return redirect('/bills')->with('success', ($i-1).' '.$request->desc1.' bills has been posted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy($tenant_id)
    {
        DB::table('payments')->where('payment_tenant_id', $tenant_id)->delete();
        DB::table('billings')->where('billing_tenant_id', $tenant_id)->delete();
        DB::table('tenants')->where('tenant_id', $tenant_id)->delete();

        return back()->with('success', 'Tenant has been successfully deleted!');
    }

    public function post_reservation(Request $request){
        
        $tenant_id = DB::table('tenants')->insertGetId(
            [
                'unit_tenant_id' => $request->unit_id,
                'tenant_unique_id' => '',
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name'=> $request->last_name,
                'birthdate'=> $request->birthdate,
                'gender' => $request->gender,
                // 'civil_status'=> $request->civil_status,
                // 'id_number' => $request->id_number,

                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'zip_code' => $request->zip_code,

                //contact number
                'contact_no' => $request->contact_no,
                'email_address' => $request->email_address,

                //guardian information
                // 'guardian' => $request->guardian,
                // 'guardian_relationship' => $request->guardian_relationship,
                // 'guardian_contact_no' => $request->guardian_contact_no,

                //rent information
                'tenant_monthly_rent' => $request->tenant_monthly_rent,
                'type_of_tenant' => 'online',
                'tenant_status' => 'pending',
                'movein_date'=> $request->movein_date,
                'moveout_date'=> $request->moveout_date,
    
                
                //information for studentf
                'high_school' => $request->high_school,
                'high_school_address' => $request->high_school_address,
                'college_school' => $request->college_school,
                'college_school_address' => $request->college_school_address,
                'course' => $request->course,
                'year_level' => $request->year_level,
             
                     //information for working
                'employer' => $request->employer,
                'employer_address' => $request->employer_address,
                'job' => $request->job,
                'employer_contact_no' => $request->employer_contact_no,
                'years_of_employment' => $request->years_of_employment,

                'created_at' => Carbon::now(),

                'tenants_note' => 'One of our employee will contact you within the day to confirm your reservation. 
                                    Your reservation will expire after 1 week without payment.'
            
        ]);
            
        //insert billing information of tenant.
        
       $no_of_items = (int) $request->no_of_items; 
        
        for($i = 0; $i<$no_of_items; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $tenant_id,
                    'billing_date' => $request->movein_date,
                    'billing_desc' =>  $request->input('desc'.$i),
                    'billing_amt' =>  $request->input('amt'.$i)
                ]);
        }

        //web unit status to occupied.
         DB::table('units')->where('unit_id', $request->unit_id)
             ->update(['status'=> 'reserved']);

        return redirect($request->unit_property.'/units/'.$request->unit_id.'/tenants/'.$tenant_id.'/reserved')->with('success', 'Your reservation has been successfully recorded!');
    }

    public function get_reservation($properties, $unit_id, $tenant_id){
        
        $tenant = Tenant::findOrFail($tenant_id);

        $unit = Unit::findOrFail($unit_id);

        $billings = DB::table('billings')->where('billing_tenant_id', $tenant_id)->get();

        return view('reservation-forms.get-reservation', compact('tenant', 'unit', 'billings'));
    }

    public function export ($unit_id, $tenant_id, $payment_id,$payment_created){

            $tenant = Tenant::findOrFail($tenant_id);

            $unit = Unit::findOrFail($unit_id);

            $collections = DB::table('units')
                ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
                ->leftJoin('payments', 'tenant_id', 'payment_tenant_id')
                ->leftJoin('billings', 'payment_billing_no', 'billing_no')
                ->where('tenant_id', $tenant_id)
                ->where('payment_created', $payment_created)
                ->orderBy('payment_created', 'desc')
                ->orderBy('ar_number', 'desc')
                ->groupBy('payment_id')
                ->get();
                
    

            $balance = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
            ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
            ->where('billing_tenant_id', $tenant_id)
            ->groupBy('billing_id')

            ->havingRaw('balance > 0')
            ->get();

            $payment = Payment::findOrFail($payment_id);
            
            $data = [
                        'tenant' => $tenant->first_name.' '.$tenant->last_name ,
                        'unit' => $unit->building.' '.$unit->unit_no,
                        'collections' => $collections,
                        'balance' => $balance,
                        'payment_date' => $payment->payment_created,
                        'payment_ar' => $payment->ar_number
                    ];

            $pdf = \PDF::loadView('treasury.pdf', $data)->setPaper('a4', 'portrait');
      
            return $pdf->download($tenant->first_name.' '.$tenant->last_name.'.pdf');
    }

    public function exportBills ($unit_id, $tenant_id){

        $tenant = Tenant::findOrFail($tenant_id);

        $unit = Unit::findOrFail($unit_id);

    
        $bills = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
        ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
        ->where('billing_tenant_id', $tenant_id)
        ->groupBy('billing_id')
        ->havingRaw('balance > 0')
        ->get();
     
        $data = [
            
            'tenant' => $tenant->first_name.' '.$tenant->last_name ,

            'tenant_status' => $tenant->tenant_status,

            'unit' => $unit->building.' '.$unit->unit_no,

            'bills' => $bills,

    ];

        $pdf = \PDF::loadView('billing.pdf', $data)->setPaper('a4', 'portrait');
  
        return $pdf->download($tenant->first_name.' '.$tenant->last_name.'.pdf');
}

    public function printGatePass($unit_id, $tenant_id){
        return $unit_id;
    }
}


