<?php

namespace App\Http\Controllers;

use App\Tenant;
use Illuminate\Http\Request;
use DB;
use App\Unit;
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

        //create session for the search
        $request->session()->put(Auth::user()->property.'search_tenant', $search);

        $tenants = DB::table('tenants')
                ->join('units', 'unit_id', 'unit_tenant_id')
                ->where('unit_property', Auth::user()->property)
                ->whereRaw("concat(first_name, ' ', last_name) like '%$search%' ")
                ->get();

        return view('tenants', compact('tenants'));

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
        
        $request->session()->put(Auth::user()->property.'type_of_tenant', 'student');
        $request->session()->put(Auth::user()->property.'first_name', $request->first_name);
        $request->session()->put(Auth::user()->property.'middle_name', $request->middle_name);
        $request->session()->put(Auth::user()->property.'last_name', $request->last_name);
        $request->session()->put(Auth::user()->property.'birthdate', $request->birthdate);
        $request->session()->put(Auth::user()->property.'gender', $request->gender);
        $request->session()->put(Auth::user()->property.'civil_status', $request->civil_status);
        $request->session()->put(Auth::user()->property.'id_number', $request->id_number);
        $request->session()->put(Auth::user()->property.'contact_no', $request->contact_no);
        $request->session()->put(Auth::user()->property.'email_address', $request->email_address);
        $request->session()->put(Auth::user()->property.'barangay', $request->barangay);
        $request->session()->put(Auth::user()->property.'city', $request->city);
        $request->session()->put(Auth::user()->property.'province', $request->province);
        $request->session()->put(Auth::user()->property.'country', $request->country);
        $request->session()->put(Auth::user()->property.'zip_code', $request->zip_code);
        $request->session()->put(Auth::user()->property.'guardian', $request->guardian);
        $request->session()->put(Auth::user()->property.'guardian_relationship', $request->guardian_relationship);
        $request->session()->put(Auth::user()->property.'guardian_contact_no', $request->guardian_contact_no);

        return redirect('/units/'.$unit_id.'/tenant-step2');
    }

    public function createTenantStep2()
    {   
        return view('admin.create-tenant-step-2');
    }

    public function postTenantStep2(Request $request, $unit_id){

        $request->session()->put(Auth::user()->property.'high_school', $request->high_school);
        $request->session()->put(Auth::user()->property.'high_school_address', $request->high_school_address);
        $request->session()->put(Auth::user()->property.'college_school', $request->colleges_school);
        $request->session()->put(Auth::user()->property.'college_school_address', $request->college_school_address);
        $request->session()->put(Auth::user()->property.'course', $request->course);
        $request->session()->put(Auth::user()->property.'year_level', $request->year_level);
        $request->session()->put(Auth::user()->property.'employer', $request->employer);
        $request->session()->put(Auth::user()->property.'employer_address', $request->employer_address);
        $request->session()->put(Auth::user()->property.'job', $request->job);
        $request->session()->put(Auth::user()->property.'years_of_employment', $request->years_of_employment);
        $request->session()->put(Auth::user()->property.'employer_contact_no', $request->employer_contact_no);

        return redirect('/units/'.$unit_id.'/tenant-step3');
    }

    public function createTenantStep3()
    {   
        return view('admin.create-tenant-step-3');
    }

    public function postTenantStep3(Request $request, $unit_id){

        if($request->moveout_date <= $request->movein_date){
            return back()->with('error', 'Invalid input. Make sure the moveout date is later than the movein date. ');
        }

        $request->session()->put(Auth::user()->property.'movein_date', $request->movein_date);
        $request->session()->put(Auth::user()->property.'moveout_date', $request->moveout_date);
        $request->session()->put(Auth::user()->property.'tenant_monthly_rent', $request->tenant_monthly_rent);

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
                'unit_tenant_id' => session(Auth::user()->property.'unit_id'),
                'tenant_unique_id' => '',
                'first_name' => session(Auth::user()->property.'first_name'),
                'middle_name' => session(Auth::user()->property.'middle_name'),
                'last_name'=>session(Auth::user()->property.'last_name'),
                'birthdate'=>session(Auth::user()->property.'birthdate'),
                'gender' => session(Auth::user()->property.'gender'),
                'civil_status'=>session(Auth::user()->property.'civil_status'),
                'id_number' => session(Auth::user()->property.'id_number'),

                'country' => session(Auth::user()->property.'country'),
                'province' => session(Auth::user()->property.'province'),
                'city' => session(Auth::user()->property.'city'),
                'barangay' => session(Auth::user()->property.'barangay'),
                'zip_code' => session(Auth::user()->property.'zip_code'),

                //contact number
                'contact_no' => session(Auth::user()->property.'contact_no'),
                'email_address' => session(Auth::user()->property.'email_address'),

                //guardian information
                'guardian' => session(Auth::user()->property.'guardian'),
                'guardian_relationship' => session(Auth::user()->property.'guardian_relationship'),
                'guardian_contact_no' => session(Auth::user()->property.'guardian_contact_no'),

                //rent information
                'tenant_monthly_rent' => session(Auth::user()->property.'tenant_monthly_rent'),
                'type_of_tenant' => 'walk-in',
                'tenant_status' => 'active',
                'movein_date'=> session(Auth::user()->property.'movein_date'),
                'moveout_date'=> session(Auth::user()->property.'moveout_date'),

                
                //information for student
                'high_school' => session(Auth::user()->property.'high_school'),
                'high_school_address' => session(Auth::user()->property.'high_school_address'),
                'college_school' => session(Auth::user()->property.'college_school'),
                'college_school_address' => session(Auth::user()->property.'college_school_address'),
                'course' => session(Auth::user()->property.'course'),
                'year_level' => session(Auth::user()->property.'year_level'),
             
                     //information for working
                'employer' => session(Auth::user()->property.'employer'),
                'employer_address' => session(Auth::user()->property.'employer_address'),
                'job' => session(Auth::user()->property.'job'),
                'employer_contact_no' => session(Auth::user()->property.'employer_contact_no'),
                'years_of_employment' => session(Auth::user()->property.'years_of_employment'),
            
        ]);
            
        //insert billing information of tenant.
        
       $no_of_items = (int) $request->no_of_items; 
        
        for($i = 0; $i<$no_of_items; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $tenant_id,
                    'billing_date' => session(Auth::user()->property.'movein_date'),
                    'billing_desc' =>  $request->input('desc'.$i),
                    'billing_amt' =>  $request->input('amt'.$i),
                    'billing_status' => 'paid'
                ]);
        }        

        DB::table('payments')->insert([
            'payment_tenant_id' => $tenant_id,
            'payment_created' => session(Auth::user()->property.'movein_date'),
            'amt_paid' => DB::table('billings')->where('billing_tenant_id', $tenant_id)->sum('billing_amt'),
            'or_number' => $request->or_number,
            'ar_number' => $request->ar_number,
            'bank_name' => $request->bank_name,
            'form_of_payment' => $request->form_of_payment,
            'check_no' => $request->check_no,
            'date_deposited' => $request->date_deposited,
            'payment_note' => 'movein charges',
        ]);

        //web unit status to occupied.
         DB::table('units')->where('unit_id', session(Auth::user()->property.'unit_id'))
             ->update(['status'=> 'occupied']);

        //delete all the session created during the tenant's registration.
        $request->session()->forget(Auth::user()->property.'first_name');
        $request->session()->forget(Auth::user()->property.'middle_name');
        $request->session()->forget(Auth::user()->property.'last_name');
        $request->session()->forget(Auth::user()->property.'birthdate');
        $request->session()->forget(Auth::user()->property.'gender');
        $request->session()->forget(Auth::user()->property.'civil_status');
        $request->session()->forget(Auth::user()->property.'id_number');
      

        $request->session()->forget(Auth::user()->property.'zip_code');
        $request->session()->forget(Auth::user()->property.'country');
        $request->session()->forget(Auth::user()->property.'province');
        $request->session()->forget(Auth::user()->property.'city');
        $request->session()->forget(Auth::user()->property.'barangay');

        $request->session()->forget(Auth::user()->property.'contact_no');
        $request->session()->forget(Auth::user()->property.'email_address');

        $request->session()->forget(Auth::user()->property.'guardian');
        $request->session()->forget(Auth::user()->property.'guardian_relationship');
        $request->session()->forget(Auth::user()->property.'guardian_contact_no');
        
        $request->session()->forget(Auth::user()->property.'tenant_monthly_rent');
        $request->session()->forget(Auth::user()->property.'type_of_tenant');

        $request->session()->forget(Auth::user()->property.'movein_date');
        $request->session()->forget(Auth::user()->property.'moveout_date');

        $request->session()->forget(Auth::user()->property.'high_school');
        $request->session()->forget(Auth::user()->property.'high_school_address');
        $request->session()->forget(Auth::user()->property.'college_school');
        $request->session()->forget(Auth::user()->property.'college_school_address');
        $request->session()->forget(Auth::user()->property.'course');
        $request->session()->forget(Auth::user()->property.'year_level');

        $request->session()->forget(Auth::user()->property.'employer');
        $request->session()->forget(Auth::user()->property.'employer_address');
        $request->session()->forget(Auth::user()->property.'job');
        $request->session()->forget(Auth::user()->property.'years_of_employment');
        $request->session()->forget(Auth::user()->property.'employer_contact_no');

        return redirect('/units/'.session(Auth::user()->property.'unit_id').'/tenants/'.$tenant_id)->with('success', 'Tenant has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show($unit_id, $tenant_id)
    {
        if(Auth::user()->status === 'unregistered')
            return view('unregistered');
        else
        $tenant = Tenant::findOrFail($tenant_id);

        $payments = DB::table('payments')->where('payment_tenant_id', $tenant_id)->get();

        $billings = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid')->get();

        $overall_payments = DB::table('payments')->where('payment_tenant_id', $tenant_id)->sum('amt_paid');
        $overall_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->sum('billing_amt');

        $pending_balance = $overall_bills - $overall_payments;
        
            return view('show-tenant', compact('tenant', 'billings', 'payments', 'pending_balance'));  
    }

    public function show_billings($unit_id, $tenant_id){

        $tenant = Tenant::findOrFail($tenant_id);

        $unit_no = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('tenant_id', $tenant_id)
        ->get();

        $payments = DB::table('payments')->where('payment_tenant_id', $tenant_id)->get();

        $monthly_rent = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid')->where('billing_desc', 'Monthly Rent')->get();

        $total_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid')->sum('billing_amt');

        $other_charges = DB::table('billings')->where('billing_tenant_id', $tenant_id)->where('billing_status', 'unpaid')->where('billing_desc', '!=','Monthly Rent')->get();

        $overall_payments = DB::table('payments')->where('payment_tenant_id', $tenant_id)->sum('amt_paid');
        $overall_bills = DB::table('billings')->where('billing_tenant_id', $tenant_id)->sum('billing_amt');

        $pending_balance = $overall_bills - $overall_payments;
        
            return view('billings.show-billings', compact('tenant', 'monthly_rent', 'pending_balance', 'unit_no', 'other_charges', 'total_bills'));  
    }


    public function show_payments($unit_id, $tenant_id){

        $tenant = Tenant::findOrFail($tenant_id);

        $payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_tenant_id', $tenant_id)
        ->where('unit_property', Auth::user()->property)
        ->get();

        return view('billings.show-payments', compact('payments', 'tenant'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit($unit_id, $tenant_id)
    {
        $tenant = Tenant::findOrFail($tenant_id);
        
        return view('edit-tenant', compact('tenant'));
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
       return redirect('/units/'.$unit_id.'/tenants/'.$tenant_id)->with('success','Tenant has been successfully updated!');
    }

    public function moveout(Request $request, $tenant_id){        

        $no_of_items = (int) $request->no_of_items; 
        
        for($i = 1; $i<$no_of_items; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $request->tenant_id,
                    'billing_date' => $request->actual_move_out_date,
                    'billing_desc' =>  $request->input('desc'.$i),
                    'billing_amt' =>  $request->input('amt'.$i)
                ]);
        }
        
        DB::table('tenants')
        ->where('tenant_id', $request->tenant_id)
        ->update([
            'tenant_status' => 'inactive',
            'actual_move_out_date' => $request->actual_move_out_date,
        ]);

        DB::table('units')
        ->where('unit_id', $request->unit_tenant_id)
        ->update([
            'status' => 'vacant'
        ]);
    
        return redirect('/units/'.$request->unit_tenant_id.'/tenants/'.$request->tenant_id)->with('success','Tenant has been successfully moved out!');
    }

    public function renew(Request $request, $unit_id, $tenant_id){

        if($request->moveout_date <= $request->movein_date){
            return back()->with('error', 'Invalid input. Make sure the moveout date is later than the movein date. ');
        } 
        
        //retrieve the number of dynamically created.
       $no_of_row = (int) $request->no_of_row; 
        
        // if number of rows is greater than 1
        if($no_of_row < 1){
            DB::table('tenants')
            ->where('tenant_id', $tenant_id)
            ->update([
                'movein_date' => $request->movein_date,
                'moveout_date' => $request->moveout_date,
                'has_extended' => 'renewed'
            ]);

            return back()->with('success', 'Tenant contract has been successfully renewed!');

        }else{
            //insert all the additional charges
            for($i = 1; $i<$no_of_row; $i++){

                DB::table('billings')->insert(
                    [
                        'billing_tenant_id' => $tenant_id,
                        'billing_date' => Carbon::now(),
                        'billing_desc' =>  $request->input('desc'.$i),
                        'billing_amt' =>  $request->input('amt'.$i)
                    ]);
            }

            DB::table('tenants')
            ->where('tenant_id', $tenant_id)
            ->update([
                'movein_date' => $request->movein_date,
                'moveout_date' => $request->moveout_date,
                'tenant_status' => 'pending',
                'has_extended' => 'renewed'
            ]);
    
            DB::table('units')
            ->where('unit_id', $unit_id)
            ->update([
                'status' => 'reserved'
            ]);

            return back()->with('success', 'Tenant has been successfully renewed!');
            
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
        ->whereIn('billing_desc', ['Monthly Rent', 'Surcharge Fee'])
        ->where('billing_status', 'unpaid')
        ->where('billing_date', '<', Carbon::now()->subMonth())
        ->groupBy('tenant_id')
        ->orderBy('total_bills')
        ->get();

        if($request->billing_option === 'rent'){
            return view('billings.add-billings', compact('active_tenants'));
        }

        if($request->billing_option === 'electric'){
            return view('billings.add-billings-electric', compact('active_tenants'));
        }

        if($request->billing_option === 'water'){
            return view('billings.add-billings-water', compact('active_tenants'));
        }

        if($request->billing_option === 'surcharge'){
            return view('billings.add-billings-surcharge', compact('delinquent_tenants'));
        }
        
    }

    public function post_billings(Request $request){

        if($request->desc1 === 'Surcharge'){
            $delinquent_tenants = DB::table('units')
            ->selectRaw('*,sum(billing_amt) as total_bills')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->whereIn('billing_desc', ['Monthly Rent', 'Surcharge Fee'])
            ->where('billing_status', 'unpaid')
            ->where('billing_date', '<', Carbon::now()->subMonth())
            ->groupBy('tenant_id')
            ->count();

            for($i = 1; $i<=$delinquent_tenants; $i++){
                DB::table('billings')->insert(
                    [
                        'billing_tenant_id' => $request->input('tenant'.$i),
                        'billing_date' => Carbon::now(),
                        'billing_desc' =>  $request->input('desc'.$i),
                        'details' => $request->input('details'.$i),
                        'billing_amt' =>  $request->input('amt'.$i)
                    ]);
            }
        }
        else{
        $total_bills = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->where('tenant_status', 'active')
        ->count();

        for($i = 1; $i<=$total_bills; $i++){
            DB::table('billings')->insert(
                [
                    'billing_tenant_id' => $request->input('tenant'.$i),
                    'billing_date' => Carbon::now(),
                    'billing_desc' =>  $request->input('desc'.$i),
                    'details' => $request->input('details'.$i),
                    'billing_amt' =>  $request->input('amt'.$i)
                ]);
        }
    }
        
        return redirect('/tenants/posted-bills')->with('success', ($i-1). ' Bills has been successfully posted!');
    }

    public function show_posted_bills(){

        $billings = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->where('billing_status', 'unpaid')
        ->orderBy('billing_date')
        ->get();

        return view('billings.show-posted-bills', compact('billings'));
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

    //functions for tenant's reservation

    public function create_reservation(){
        return view('reservation-forms.reservation');
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
                'civil_status'=> $request->civil_status,
                'id_number' => $request->id_number,

                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'zip_code' => $request->zip_code,

                //contact number
                'contact_no' => $request->contact_no,
                'email_address' => $request->email_address,

                //guardian information
                'guardian' => $request->guardian,
                'guardian_relationship' => $request->guardian_relationship,
                'guardian_contact_no' => $request->guardian_contact_no,

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

        return redirect('/units/'.$request->unit_id.'/tenants/'.$tenant_id.'/reserved')->with('success', 'Unit has been successfully reserved!');
    }

    public function get_reservation($unit_id, $tenant_id){
        
        $tenant = Tenant::findOrFail($tenant_id);

        $unit = Unit::findOrFail($unit_id);

        $billings = DB::table('billings')->where('billing_tenant_id', $tenant_id)->get();

        return view('reservation-forms.get-reservation', compact('tenant', 'unit', 'billings'));
    }

   

}


