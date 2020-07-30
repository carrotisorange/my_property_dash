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

        $property = explode(",", Auth::user()->property);

        //create session for the search
        $request->session()->put(Auth::user()->id.'search_tenant', $search);

        $tenants = DB::table('tenants')
                ->join('units', 'unit_id', 'unit_tenant_id')
                ->where('unit_property', Auth::user()->property)
                ->whereRaw("concat(first_name, ' ', last_name) like '%$search%' ")
                ->orderBy('movein_date', 'desc')
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
    public function createTenantStep1()
    {   
        return view('admin.create-tenant-step-1');
    }

    public function postTenantStep1(Request $request, $unit_id){
        
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
            return back()->with('danger', 'Invalid input. Make sure the moveout date is later than the movein date. ');
        }

        $request->session()->put(Auth::user()->id.'movein_date', $request->movein_date);
        $request->session()->put(Auth::user()->id.'moveout_date', $request->moveout_date);
        $request->session()->put(Auth::user()->id.'tenant_monthly_rent', $request->tenant_monthly_rent);

        return redirect('/units/'.$unit_id.'/tenant-step4');
    }

    public function createTenantStep4()
    {   
        return view('admin.create-tenant-step-4');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //insert tenant to a specific unit
        $tenant_id = DB::table('tenants')->insertGetId(
            [
                'unit_tenant_id' => session(Auth::user()->id.'unit_id'),
                'tenant_unique_id' => '',
                'first_name' => session(Auth::user()->id.'first_name'),
                'middle_name' => session(Auth::user()->id.'middle_name'),
                'last_name'=>session(Auth::user()->id.'last_name'),
                'birthdate'=>session(Auth::user()->id.'birthdate'),
                'gender' => session(Auth::user()->id.'gender'),
                'civil_status'=>session(Auth::user()->id.'civil_status'),
                'id_number' => session(Auth::user()->id.'id_number'),

                'country' => session(Auth::user()->id.'country'),
                'province' => session(Auth::user()->id.'province'),
                'city' => session(Auth::user()->id.'city'),
                'barangay' => session(Auth::user()->id.'barangay'),
                'zip_code' => session(Auth::user()->id.'zip_code'),

                //contact number
                'contact_no' => session(Auth::user()->id.'contact_no'),
                'email_address' => session(Auth::user()->id.'email_address'),

                //guardian information
                'guardian' => session(Auth::user()->id.'guardian'),
                'guardian_relationship' => session(Auth::user()->id.'guardian_relationship'),
                'guardian_contact_no' => session(Auth::user()->id.'guardian_contact_no'),

                //rent information
                'tenant_monthly_rent' => session(Auth::user()->id.'tenant_monthly_rent'),
                'type_of_tenant' => 'walk-in',
                //change the tenant status to pending.
                'tenant_status' => 'pending',
                'movein_date'=> session(Auth::user()->id.'movein_date'),
                'moveout_date'=> session(Auth::user()->id.'moveout_date'),
        
                //information for student
                'high_school' => session(Auth::user()->id.'high_school'),
                'high_school_address' => session(Auth::user()->id.'high_school_address'),
                'college_school' => session(Auth::user()->id.'college_school'),
                'college_school_address' => session(Auth::user()->id.'college_school_address'),
                'course' => session(Auth::user()->id.'course'),
                'year_level' => session(Auth::user()->id.'year_level'),
             
                     //information for working
                'employer' => session(Auth::user()->id.'employer'),
                'employer_address' => session(Auth::user()->id.'employer_address'),
                'job' => session(Auth::user()->id.'job'),
                'employer_contact_no' => session(Auth::user()->id.'employer_contact_no'),
                'years_of_employment' => session(Auth::user()->id.'years_of_employment'),
            
        ]);

          //get the number of last added bills
          $current_bill_no = DB::table('units')
          ->join('tenants', 'unit_id', 'unit_tenant_id')
          ->join('billings', 'tenant_id', 'billing_tenant_id')
          ->where('unit_property', Auth::user()->property)
          ->count();
            
        
       //create movein charges of the tenant.
        for($i = 0; $i<3 ; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $tenant_id,
                'billing_no' => $current_bill_no++,
                    'billing_date' => session(Auth::user()->id.'movein_date'),
                    'billing_desc' =>  $request->input('desc'.$i),
                    'billing_amt' =>  $request->input('amt'.$i),
                    'billing_status' => 'unpaid'
                ]);
        }        

        //change the unit status to reserved
         DB::table('units')->where('unit_id', session(Auth::user()->id.'unit_id'))
             ->update(
                        [
                            'status'=> 'reserved',
                            'updated_at' => session(Auth::user()->id.'movein_date'),   
                        ]
                    );

        //delete all the session created during the tenant's registration.
        $request->session()->forget(Auth::user()->id.'first_name');
        $request->session()->forget(Auth::user()->id.'middle_name');
        $request->session()->forget(Auth::user()->id.'last_name');
        $request->session()->forget(Auth::user()->id.'birthdate');
        $request->session()->forget(Auth::user()->id.'gender');
        $request->session()->forget(Auth::user()->id.'civil_status');
        $request->session()->forget(Auth::user()->id.'id_number');
      

        $request->session()->forget(Auth::user()->id.'zip_code');
        $request->session()->forget(Auth::user()->id.'country');
        $request->session()->forget(Auth::user()->id.'province');
        $request->session()->forget(Auth::user()->id.'city');
        $request->session()->forget(Auth::user()->id.'barangay');

        $request->session()->forget(Auth::user()->id.'contact_no');
        $request->session()->forget(Auth::user()->id.'email_address');

        $request->session()->forget(Auth::user()->id.'guardian');
        $request->session()->forget(Auth::user()->id.'guardian_relationship');
        $request->session()->forget(Auth::user()->id.'guardian_contact_no');
        
        $request->session()->forget(Auth::user()->id.'tenant_monthly_rent');
        $request->session()->forget(Auth::user()->id.'type_of_tenant');

        $request->session()->forget(Auth::user()->id.'movein_date');
        $request->session()->forget(Auth::user()->id.'moveout_date');

        $request->session()->forget(Auth::user()->id.'high_school');
        $request->session()->forget(Auth::user()->id.'high_school_address');
        $request->session()->forget(Auth::user()->id.'college_school');
        $request->session()->forget(Auth::user()->id.'college_school_address');
        $request->session()->forget(Auth::user()->id.'course');
        $request->session()->forget(Auth::user()->id.'year_level');

        $request->session()->forget(Auth::user()->id.'employer');
        $request->session()->forget(Auth::user()->id.'employer_address');
        $request->session()->forget(Auth::user()->id.'job');
        $request->session()->forget(Auth::user()->id.'years_of_employment');
        $request->session()->forget(Auth::user()->id.'employer_contact_no');

        return redirect('/units/'.session(Auth::user()->id.'unit_id').'/tenants/'.$tenant_id)->with('success', 'New tenant has been added to the record!');
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

            $personnels = DB::table('personnels')->where('personnel_property', Auth::user()->property)->get();

            $payments = DB::table('payments')->where('payment_tenant_id', $tenant_id)->where('amt_paid','>', 0)->get();
        
            $security_deposits = DB::table('payments')->where('payment_tenant_id', $tenant_id)->wherein('payment_note',['Security Deposit (Rent)', 'Security Deposit (Utilities)'])->get();
    
            $billings = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid')->get();
    
            $overall_payments = DB::table('payments')->where('payment_tenant_id', $tenant_id)->sum('amt_paid');
            $overall_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->sum('billing_amt');
    
            $pending_balance = $overall_bills - $overall_payments;
            
                return view('admin.show-tenant', compact('tenant','personnels' ,'billings', 'payments', 'pending_balance','security_deposits'));  
        }else{
                return view('unregistered');
        }
    }

    public function show_billings($unit_id, $tenant_id){

        if(auth()->user()->status === 'registered' && (auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'treasury' || auth()->user()->user_type === 'manager' )){
            
            //get the tenant information
            $tenant = Tenant::findOrFail($tenant_id);

            //get the unit number
            $unit_no = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('tenant_id', $tenant_id)
            ->get();
    
            //get the ar number
            $payment_ctr = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->count();

            //get the move in charges
            $movein_charges = DB::table('billings')
            ->where('billing_tenant_id', $tenant_id)
            ->where('billing_amt','>',0)
            ->whereIn('billing_desc', ['Security Deposit (Utilities)', 'Security Deposit (Rent)', 'Advance Rent', 'Others', 'Management Fee', 'General Cleaning'])
            ->get();

            //count the number of payments made
            $payments = DB::table('payments')
            ->where('payment_tenant_id', $tenant_id)
            ->where('amt_paid','>',0)
            ->count();
    
            //get all the unpaid  bills
            $bills = DB::table('billings')
            ->where('billing_tenant_id', $tenant_id)
            ->where('billing_status', 'unpaid')
            ->where('billing_amt','>',0)
            ->distinct()
            ->get();

            //get the sum of all the unpaid bills
            $total_bills = DB::table('billings')
            ->where('billing_tenant_id', $tenant_id)
            ->where('billing_status', 'unpaid')
            ->where('billing_amt','>',0)
            ->sum('billing_amt');
            
            return view('billing.show-billings', compact('tenant', 'unit_no', 'bills', 'total_bills','payment_ctr','payments', 'movein_charges'));  
        }else{
            return view('unregistered');
        }
    }

    public function show_payments($unit_id, $tenant_id){

        $tenant = Tenant::findOrFail($tenant_id);
     
        $collections = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->where('tenant_id', $tenant_id)
        // ->whereIn('payment_note',['Rent', 'Electricity', 'Water', 'Surcharge'])
        ->orderBy('payment_created', 'desc')
        ->orderBy('payment_created', 'desc')
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->payment_created)->timestamp;
        });
 
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
        if(Auth::user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
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
        ]);
       return redirect('/units/'.$unit_id.'/tenants/'.$tenant_id)->with('success','Tenant information has been updated!');
    }

    public function moveout(Request $request, $tenant_id){       

        $no_of_items = (int) $request->no_of_items; 

          //get the number of last added bills
          $current_bill_no = DB::table('units')
          ->join('tenants', 'unit_id', 'unit_tenant_id')
          ->join('billings', 'tenant_id', 'billing_tenant_id')
          ->where('unit_property', Auth::user()->property)
          ->count();
        
        for($i = 1; $i<$no_of_items; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $request->tenant_id,
                    'billing_no' => $current_bill_no++,
                    'billing_date' => $request->actual_move_out_date,
                    'billing_desc' =>  $request->input('desc'.$i),
                    'billing_amt' =>  $request->input('amt'.$i)
                ]);
        }
        
        DB::table('tenants')
        ->where('tenant_id', $request->tenant_id)
        ->update([
            'tenant_status' => 'inactive',
            'reason_for_moving_out' => $request->reason_for_moving_out,
            'actual_move_out_date' => $request->actual_move_out_date,
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
    
        return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->tenant_id)->with('success','Tenant has been moved out!');
    }

    public function renew(Request $request, $unit_id, $tenant_id){
        

        $renewal_history = Tenant::findOrFail($tenant_id);

          //get the number of last added bills
          $current_bill_no = DB::table('units')
          ->join('tenants', 'unit_id', 'unit_tenant_id')
          ->join('billings', 'tenant_id', 'billing_tenant_id')
          ->where('unit_property', Auth::user()->property)
          ->count();

        //retrieve the number of dynamically created.
       $no_of_row = (int) $request->no_of_row; 
        
        // if number of rows is greater than 1
        if($no_of_row < 1){
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
            for($i = 1; $i<$no_of_row; $i++){

                DB::table('billings')->insert(
                    [
                        'billing_tenant_id' => $tenant_id,
                        'billing_no' => $current_bill_no++,
                        'billing_date' => Carbon::now(),
                        'billing_desc' =>  $request->input('desc'.$i),
                        'billing_amt' =>  $request->input('amt'.$i)
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
            ->whereIn('billing_desc', ['Monthly Rent', 'Surcharge', 'Rent'])
            ->where('billing_status', 'unpaid')
            ->where('billing_date', '<', Carbon::now()->addDays(7))
            ->groupBy('tenant_id')
            ->get();

            //get the number of last added bills
            $billing_ctr = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->count();

             //get the number of last added bills
             $current_bill_no = DB::table('units')
             ->join('tenants', 'unit_id', 'unit_tenant_id')
             ->join('billings', 'tenant_id', 'billing_tenant_id')
             ->where('unit_property', Auth::user()->property)
             ->count();
    
       
        if($request->billing_option === 'rent'){
            return view('billing.add-billings', compact('active_tenants', 'billing_ctr','current_bill_no'));
        }

        if($request->billing_option === 'electric'){
            return view('billing.add-billings-electric', compact('active_tenants', 'billing_ctr','current_bill_no'));
        }

        if($request->billing_option === 'water'){
            return view('billing.add-billings-water', compact('active_tenants', 'billing_ctr','current_bill_no'));
        }

        if($request->billing_option === 'surcharge'){
            return view('billing.add-billings-surcharge', compact('delinquent_tenants', 'billing_ctr','current_bill_no'));
        }
        
    }

    public function post_billings(Request $request){

        if($request->desc1 === 'Surcharge'){
           
            for($i = 1; $i<=$request->ctr; $i++){
                DB::table('billings')->insert(
                    [
                        'billing_no' => $request->input('billing_no'.$i),
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

        for($i = 1; $i<=$request->ctr; $i++){
            DB::table('billings')->insert(
                [
                    'billing_no' => $request->input('billing_no'.$i),
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

            $payment = Payment::findOrFail($payment_id);

            $payment_breakdown = DB::table('payments')
            ->where('payment_tenant_id',$tenant_id)
            ->where('payment_created', $payment_created)
            ->where('amt_paid','>',0)
            ->get();
            
            $payment_amt = DB::table('payments')
            ->where('payment_tenant_id',$tenant_id)
            ->where('payment_created', $payment_created)
            ->sum('amt_paid');

            $running_balance = DB::table('billings')
            ->where('billing_tenant_id', $tenant_id)
            ->where('billing_status', 'unpaid')
            ->sum('billing_amt');
            
            $data = [
                
                'tenant' => $tenant->first_name.' '.$tenant->last_name ,

                'unit' => $unit->building.' '.$unit->unit_no,

                'payment_amt' => $payment_amt,

                'payment_date' => $payment->payment_created,

                'payment_ar' => $payment->ar_number,

                'payment_breakdown' => $payment_breakdown,

                'running_balance' => $running_balance,

        ];

            $pdf = \PDF::loadView('treasury.pdf', $data)->setPaper('a4', 'portrait');
      
            return $pdf->download($tenant->first_name.' '.$tenant->last_name.'.pdf');
    }

    public function exportBills ($unit_id, $tenant_id){

        $tenant = Tenant::findOrFail($tenant_id);

        $unit = Unit::findOrFail($unit_id);

        $rent_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid') ->where('billing_amt','>',0)->whereIn('billing_desc', ['Monthly Rent', 'Surcharges'])->get();

         $other_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid') ->where('billing_amt','>',0)->where('billing_desc','!=','Monthly Rent')->where('billing_desc','!=','Surcharges')->get();

         $total_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid')->sum('billing_amt');
         
        $data = [
            
            'tenant' => $tenant->first_name.' '.$tenant->last_name ,

            'tenant_status' => $tenant->tenant_status,

            'unit' => $unit->building.' '.$unit->unit_no,

            'rent_bills' => $rent_bills,

            'other_bills' => $other_bills,

            'total_bills' => $total_bills,

    ];

        $pdf = \PDF::loadView('billing.pdf', $data)->setPaper('a4', 'portrait');
  
        return $pdf->download($tenant->first_name.' '.$tenant->last_name.'.pdf');
}
}


