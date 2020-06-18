<?php

use App\Unit, App\UnitOwner, App\Tenant, App\User;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function(Request $request){

    if(Auth::guest()){
        return view('auth.login');
    }
    

    if(auth()->user()->status === 'unregistered'){
        return view('unregistered');
    }

    $property = explode(",", Auth::user()->property);

    //get all the units
   if(count($property) > 1){
     $units = DB::table('units')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->orderBy('building')
    ->orderBy('floor_no')
    ->orderBy('unit_no')
    ->get();

     $commercial_units = DB::table('units')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->where('type_of_units', 'commercial')
    ->orderBy('building')
    ->orderBy('floor_no')
    ->orderBy('unit_no')
    ->get();

    $leasing_units= DB::table('units')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->where('type_of_units', 'leasing')
    ->orderBy('building')
    ->orderBy('floor_no')
    ->orderBy('unit_no')
    ->get();

    $residential_units= DB::table('units')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->where('type_of_units', 'residential')
    ->orderBy('building')
    ->orderBy('floor_no')
    ->orderBy('unit_no')
    ->get();

    $occupied_units = DB::table('units')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->orderBy('building')
    ->orderBy('unit_no')
    ->where('status','occupied')
    ->get();

    

    $investors = DB::table('units')
    ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->get();

    $tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->orderBy('movein_date')
    ->get();

    $pending_tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->where('tenant_status', 'pending')
    ->orderBy('movein_date')
    ->get();


    $tenants_to_watch_out = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->orderBy('moveout_date')
    ->where('tenant_status', 'active')
    ->get();

    $active_tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->where('tenant_status', 'active')
    ->orderBy('movein_date', 'desc')
    ->get();

     $all_active_tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->orderBy('movein_date', 'desc')
    ->get();

    $reservations = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->where('tenant_status', 'pending')
    ->where('type_of_tenant', 'online')
    ->orderBy('movein_date', 'desc')
    ->get();

    $renewed_contracts = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->orderBy('movein_date', 'desc')
    ->where('has_extended', 'renewed')
    ->where('tenant_status', '!=', 'inactive')
    ->get();

    $terminated_contracts = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->whereIn('unit_property', [$property[0],$property[1]])
    ->orderBy('movein_date', 'desc')
    ->where('tenant_status', 'inactive')
    ->get();



    $movein_rate_1 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('movein_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
        ->where('movein_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('tenant_status',['active', 'inactive'])
        ->where('type_of_units', 'leasing')
        ->count();

    $movein_rate_2 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('movein_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
        ->where('movein_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('tenant_status',['active', 'inactive'])
        ->where('type_of_units', 'leasing')
        ->count();
        
    $movein_rate_3 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('movein_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
        ->where('movein_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('tenant_status',['active', 'inactive'])
        ->where('type_of_units', 'leasing')
        ->count();

    $movein_rate_4 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('movein_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
        ->where('movein_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('tenant_status',['active', 'inactive'])
        ->where('type_of_units', 'leasing')
        ->count();

    $movein_rate_5 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('movein_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
        ->where('movein_date', '<=', Carbon::now()->subMonth()->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('tenant_status',['active', 'inactive'])
        ->where('type_of_units', 'leasing')
        ->count();

    $movein_rate_6 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('movein_date', '>=', Carbon::now()->firstOfMonth())
        ->where('movein_date', '<=', Carbon::now()->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('tenant_status',['active', 'inactive'])
        ->where('type_of_units', 'leasing')
        ->count();

        $moveout_rate_1 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('moveout_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
        ->where('moveout_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('tenant_status','inactive')
        ->where('type_of_units', 'leasing')
        ->count();
    
        $moveout_rate_2 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('moveout_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
        ->where('moveout_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('tenant_status','inactive')
        ->where('type_of_units', 'leasing')
        ->count();
    
        $moveout_rate_3 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('moveout_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
        ->where('moveout_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('tenant_status','inactive')
        ->where('type_of_units', 'leasing')
        ->count();
    
        $moveout_rate_4 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('moveout_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
        ->where('moveout_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('tenant_status','inactive')
        ->where('type_of_units', 'leasing')
        ->count();
    
        $moveout_rate_5 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('moveout_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
        ->where('moveout_date', '<=', Carbon::now()->subMonth()->endOfMonth())
        ->where('unit_property', Auth::user()->property)
        ->where('tenant_status','inactive')
        ->where('type_of_units', 'leasing')
        ->count();
    
        $moveout_rate_6 = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('moveout_date', '>=', Carbon::now()->firstOfMonth())
        ->where('moveout_date', '<=', Carbon::now()->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('tenant_status','inactive')
        ->where('type_of_units', 'leasing')
        ->count();

        $recent_movein = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->orderBy('movein_date', 'desc')
        ->where('tenant_status', 'active')
        ->limit(5)
        ->get();
    
       $units_per_status = DB::table('units')
        ->select('status',DB::raw('count(*) as count'))
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('type_of_units', 'leasing')
        ->groupBy('status')
        ->get();
    
         $units_per_building = DB::table('units')
        ->select('building', 'status', DB::raw('count(*) as count'))
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->groupBy('building')
        ->where('type_of_units', 'leasing')
        ->get('building', 'status','count');       

        $units_per_status_residential = DB::table('units')
        ->select('status',DB::raw('count(*) as count'))
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('type_of_units', 'residential')
        ->groupBy('status')
        ->get();

        $units_per_building_residential = DB::table('units')
        ->select('building', 'status', DB::raw('count(*) as count'))
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->groupBy('building')
        ->where('type_of_units', 'residential')
        ->get('building', 'status','count');  
    
        //billings
        $expected_collection = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->whereMonth('billing_date', Carbon::today()->month)
        ->whereYear('billing_date', Carbon::today()->year)
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('billing_amt');
    
        $actual_collection = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->whereMonth('payment_created', Carbon::today()->month)
        ->whereYear('payment_created', Carbon::today()->year)
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('amt_paid');
    
        $total_billings = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('billing_amt');
    
        $total_payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('amt_paid');
    
        $uncollected_amount = $total_billings-$total_payments;
    
        $delinquent_accounts = DB::table('units')
        ->selectRaw('*,sum(billing_amt) as total_bills')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereIn('billing_desc', ['Monthly Rent', 'Surcharge'])
        ->where('billing_status', 'unpaid')
        ->where('billing_date', '<', Carbon::now()->addDays(7))
        ->groupBy('tenant_id')
        ->orderBy('total_bills', 'desc')
        ->get();
    
        $recent_payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->orderBy('payment_created', 'desc')
        ->get();
    
        $collection_rate_1 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(5)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
       
        ->sum('amt_paid');
    
        $collection_rate_2 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(4)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->whereRaw("payment_note like '%Rent%' ")
        ->sum('amt_paid');
    
        $collection_rate_3 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(3)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        
        ->sum('amt_paid');
    
         $collection_rate_4 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(2)->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('amt_paid');
    
         $collection_rate_5 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonth()->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonth()->firstOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('amt_paid');
    
         $collection_rate_6 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->endOfMonth())
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->sum('amt_paid');

            //for treasury
        $payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->groupBy('tenant_id')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->where('payment_created', Carbon::today()->format('Y-m-d'))
        ->get();


         $posted_bills_this_month_for_rent = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->whereMonth('billing_date', Carbon::today()->month)
        ->where('billing_desc', 'Monthly Rent')
        ->whereIn('unit_property', [$property[0],$property[1]])
        ->count();

        //for admin
       $users = DB::table('users')
       ->whereIn('property', [$property[0],$property[1]])
       ->orderBy('created_at')
       ->get();

   }else{
     $units = DB::table('units')
    ->where('unit_property', $property[0])
    ->orderBy('building')
    ->orderBy('floor_no')
    ->orderBy('unit_no')
    ->get();

    $occupied_units = DB::table('units')
    ->where('unit_property', $property[0])
    ->orderBy('building')
    ->orderBy('unit_no')
    ->where('status','occupied')
    ->get();

    $investors = DB::table('units')
    ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
    ->where('unit_property', $property[0])
    ->get();

    $tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->orderBy('movein_date', 'desc')
    ->get();

    $tenants_to_watch_out = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->orderBy('moveout_date')
    ->where('tenant_status', 'active')
    ->get();

    $active_tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->where('tenant_status', 'active')
    ->orderBy('movein_date', 'desc')
    ->get();

    $all_active_tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->orderBy('movein_date', 'desc')
    ->get();

    $pending_tenants = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->where('tenant_status', 'pending')
    ->orderBy('movein_date')
    ->get();

    $reservations = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->where('tenant_status', 'pending')
    ->where('type_of_tenant', 'online')
    ->orderBy('movein_date', 'desc')
    ->get();

    $renewed_contracts = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->orderBy('movein_date', 'desc')
    ->where('has_extended', 'renewed')
    ->where('tenant_status', '!=', 'inactive')
    ->get();

    $terminated_contracts = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('unit_property', $property[0])
    ->orderBy('movein_date', 'desc')
    ->where('tenant_status', 'inactive')
    ->get();

    $movein_rate_1 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('movein_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
    ->where('movein_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->count();

    $movein_rate_2 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('movein_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
    ->where('movein_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->count();

    $movein_rate_3 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('movein_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
    ->where('movein_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->count();

     $movein_rate_4 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('movein_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
    ->where('movein_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->count();

    $movein_rate_5 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('movein_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
    ->where('movein_date', '<=', Carbon::now()->subMonth()->endOfMonth())
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->count();
    
    $movein_rate_6 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('movein_date', '>=', Carbon::now()->firstOfMonth())
    ->where('movein_date', '<=', Carbon::now()->endOfMonth())
    ->where('unit_property', $property[0])
    ->whereIn('tenant_status',['active', 'inactive'])
    ->count();

    $moveout_rate_1 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('moveout_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
    ->where('moveout_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
    ->where('unit_property', $property[0])
    ->where('tenant_status','inactive')
    ->count();

    $moveout_rate_2 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('moveout_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
    ->where('moveout_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
    ->where('unit_property', $property[0])
    ->where('tenant_status','inactive')
    ->count();

    $moveout_rate_3 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('moveout_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
    ->where('moveout_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
    ->where('unit_property', $property[0])
    ->where('tenant_status','inactive')
    ->count();

    $moveout_rate_4 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('moveout_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
    ->where('moveout_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
    ->where('unit_property', $property[0])
    ->where('tenant_status','inactive')
    ->count();

    $moveout_rate_5 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('moveout_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
    ->where('moveout_date', '<=', Carbon::now()->subMonth()->endOfMonth())
    ->where('unit_property', $property[0])
    ->where('tenant_status','inactive')
    ->count();

    $moveout_rate_6 = DB::table('tenants')
    ->join('units', 'unit_id', 'unit_tenant_id')
    ->where('moveout_date', '>=', Carbon::now()->firstOfMonth())
    ->where('moveout_date', '<=', Carbon::now()->endOfMonth())
    ->where('unit_property', $property[0])
    ->where('tenant_status','inactive')
    ->count();  

    $recent_movein = DB::table('tenants')
        ->join('units', 'unit_id', 'unit_tenant_id')
        ->where('unit_property', $property[0])
        ->orderBy('movein_date', 'desc')
        ->where('tenant_status', 'active')
        ->limit(5)
        ->get();
    
        $units_per_status = DB::table('units')
        ->select('status','building',DB::raw('count(*) as count'))
        ->where('unit_property', $property[0])
        ->where('type_of_units', 'leasing')
        ->groupBy('status')
        ->get('status','building', 'count');
    
        $units_per_building = DB::table('units')
        ->select('building',DB::raw('count(*) as count'))
        ->where('unit_property', $property[0])
        ->where('type_of_units', 'leasing')
        ->groupBy('building')
        ->get('building', 'count');

        $units_per_status_residential = DB::table('units')
        ->select('status',DB::raw('count(*) as count'))
        ->where('unit_property', $property[0])
        ->where('type_of_units', 'residential')
        ->groupBy('status')
        ->get();

        $units_per_building_residential = DB::table('units')
        ->select('building', 'status', DB::raw('count(*) as count'))
        ->where('unit_property', $property[0])
        ->groupBy('building')
        ->where('type_of_units', 'residential')
        ->get('building', 'status','count');  
    
        //billings
        $expected_collection = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->whereMonth('billing_date', Carbon::today()->month)
        ->whereYear('billing_date', Carbon::today()->year)
        ->where('unit_property', $property[0])
        ->sum('billing_amt');
    
        $actual_collection = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->whereMonth('payment_created', Carbon::today()->month)
        ->whereYear('payment_created', Carbon::today()->year)
        ->where('unit_property', $property[0])
        ->sum('amt_paid');
    
        $total_billings = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', $property[0])
        ->sum('billing_amt');
    
        $total_payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('unit_property', $property[0])
        ->sum('amt_paid');
    
        $uncollected_amount = $total_billings-$total_payments;
    
         $delinquent_accounts = DB::table('units')
        ->selectRaw('*,sum(billing_amt) as total_bills')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', $property[0])
        ->whereIn('billing_desc', ['Monthly Rent', 'Surcharge'])
        ->where('billing_status', 'unpaid')
        ->where('billing_date', '<', Carbon::now()->addDays(7))
        ->groupBy('tenant_id')
        ->orderBy('total_bills')
        ->get();
    
        $recent_payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('unit_property', $property[0])
        ->orderBy('payment_created', 'desc')
        ->get();
    
        $collection_rate_1 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(5)->endOfMonth())
        ->where('unit_property', $property[0])
       
        ->sum('amt_paid');
    
        $collection_rate_2 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(4)->endOfMonth())
        ->where('unit_property', $property[0])
        ->whereRaw("payment_note like '%Rent%' ")
        ->sum('amt_paid');
    
        $collection_rate_3 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(3)->endOfMonth())
        ->where('unit_property', $property[0])
        
        ->sum('amt_paid');
    
         $collection_rate_4 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonths(2)->endOfMonth())
        ->where('unit_property', $property[0])
        ->sum('amt_paid');
    
         $collection_rate_5 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->subMonth()->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->subMonth()->firstOfMonth())
        ->where('unit_property', $property[0])
        ->sum('amt_paid');
    
         $collection_rate_6 = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->where('payment_created', '>=', Carbon::now()->firstOfMonth())
        ->where('payment_created', '<=', Carbon::now()->endOfMonth())
        ->where('unit_property', $property[0])
        ->sum('amt_paid');

            //for treasury
        $payments = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('payments', 'tenant_id', 'payment_tenant_id')
        ->groupBy('tenant_id')
        ->where('unit_property', $property[0])
        ->where('payment_created', Carbon::today()->format('Y-m-d'))
        ->get();

         $posted_bills_this_month_for_rent = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->whereMonth('billing_date', Carbon::today()->month)
        ->where('billing_desc', 'Monthly Rent')
        ->where('unit_property', $property[0])
        ->count();

        $commercial_units = DB::table('units')
        ->where('unit_property', $property[0])
        ->where('type_of_units', 'commercial')
        ->orderBy('building')
        ->orderBy('floor_no')
        ->orderBy('unit_no')
        ->get();
    
        $leasing_units= DB::table('units')
        ->where('unit_property', $property[0])
        ->where('type_of_units', 'leasing')
        ->orderBy('building')
        ->orderBy('floor_no')
        ->orderBy('unit_no')
        ->get();

        $residential_units= DB::table('units')
        ->where('unit_property', $property[0])
        ->where('type_of_units', 'residential')
        ->orderBy('building')
        ->orderBy('floor_no')
        ->orderBy('unit_no')
        ->get();

        //for admin
       $users = DB::table('users')
       ->where('property', $property[0])
       ->orderBy('created_at')
       ->get();

   }
       
    $overall_contract_termination = $renewed_contracts->count() + $terminated_contracts->count();

    $renewed_chart = new DashboardChart;
    $renewed_chart->title('Retention Rate'.' ('.number_format(($overall_contract_termination == 0 ? 0 : $renewed_contracts->count()/$overall_contract_termination) * 100,1).'%)');
    $renewed_chart->displayAxes(false);
    $renewed_chart->labels([ 'Renewal'.' ('.$renewed_contracts->count(). ')', 'Termination'.' ('.$terminated_contracts->count(). ')', 'Total'.' ('.$overall_contract_termination. ')']);
    $renewed_chart->dataset('', 'pie', [number_format(($overall_contract_termination == 0 ? 0 : $renewed_contracts->count()/$overall_contract_termination) * 100,1),number_format(($overall_contract_termination == 0 ? 0 :$terminated_contracts->count()/$overall_contract_termination) * 100,1)  ])
    ->backgroundColor(['#008000', '#FF0000']);

    $movein_rate = new DashboardChart;
    $movein_rate->title('Occupancy Rate');
    $movein_rate->title('Occupancy Rate'.'('.number_format($active_tenants->count()/$leasing_units->count() * 100,2).'%)');
    $movein_rate->barwidth(0.0);
    $movein_rate->displaylegend(false);
    $movein_rate->labels([Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
    $movein_rate->dataset('', 'line', [
        number_format(($all_active_tenants->count()-($movein_rate_2 + $movein_rate_3 + $movein_rate_4 + $movein_rate_5 + $movein_rate_6))/$leasing_units->count() * 100,2),
                                        number_format(($all_active_tenants->count()-($movein_rate_3 + $movein_rate_4 + $movein_rate_5 + $movein_rate_6))/$leasing_units->count() * 100,2),
                                        number_format(($all_active_tenants->count()-($movein_rate_4 + $movein_rate_5 + $movein_rate_6))/$leasing_units->count() * 100,2),
                                        number_format(($all_active_tenants->count()-($movein_rate_5 + $movein_rate_6))/$leasing_units->count() * 100,2),
                                        number_format(($all_active_tenants->count()-($movein_rate_6))/$leasing_units->count() * 100,2),
                                        number_format(($active_tenants->count()/$leasing_units->count()) * 100,2)
                                        ])
    ->color("rgb(0, 0, 0)")
    ->backgroundcolor("rgb(169, 169, 169)")
    ->fill(false)
    ->linetension(0.1)
    ->dashed([5]);


    $moveout_rate = new DashboardChart;
    $moveout_rate->title('Number of moveouts ('.$moveout_rate_6.')');
    $moveout_rate->barwidth(0.0);
    $moveout_rate->displaylegend(false);
    $moveout_rate->labels([Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
    $moveout_rate->dataset('number of moveouts', 'line', [$moveout_rate_1,$moveout_rate_2,$moveout_rate_3,$moveout_rate_4,$moveout_rate_5,$moveout_rate_6])
    ->color("rgb(0, 0, 0)")
    ->backgroundcolor("rgb(169, 169, 169)")
    ->fill(false)
    ->linetension(0.1)
    ->dashed([5]);

    $collection_rate = new DashboardChart;
    $collection_rate->title('Total Collection'.' ('.number_format($collection_rate_6,2).')');
    $collection_rate->barwidth(0.0);
    $collection_rate->displaylegend(false);
    $collection_rate->labels([Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
    $collection_rate->dataset('Total collection', 'line', [
                                                           number_format($collection_rate_1,2),
                                                           number_format($collection_rate_2,2),
                                                           number_format($collection_rate_3,2),
                                                           number_format($collection_rate_4,2),
                                                           number_format($collection_rate_5,2),
                                                           number_format($collection_rate_6,2),
                                                          ])
    ->color("rgb(0, 0, 0)")
    ->backgroundcolor("rgb(169, 169, 169)")
    ->fill(false)
    ->linetension(0.1)
    ->dashed([5]);

    return view('dashboard', compact('tenants_to_watch_out','active_tenants','reservations','occupied_units','units', 'investors', 'tenants', 'movein_rate','moveout_rate','recent_movein', 'units_per_status', 'units_per_building',
    'expected_collection', 'actual_collection', 'uncollected_amount', 'delinquent_accounts','posted_bills_this_month_for_rent','collection_rate', 'payments', 'recent_payments', 'renewed_contracts', 'renewed_chart', 'terminated_contracts',
    'users','commercial_units','leasing_units','residential_units','pending_tenants','units_per_status_residential','units_per_building_residential'));

});


//routes for units
Route::get('units/{unit_id}', 'UnitsController@show')->middleware('auth');
Route::put('units/{unit_id}', 'UnitsController@update')->middleware('auth');
Route::post('units/add', 'UnitsController@add_unit')->middleware('auth');
Route::post('units/add-multiple', 'UnitsController@add_multiple_rooms')->middleware('auth');

//routes for payments
Route::get('units/{unit_id}/tenants/{tenant_id}/payments/{payment_id}', 'PaymentController@show')->name('show-payment')->middleware('auth');
Route::post('/payments', 'PaymentController@store')->middleware('auth');
Route::get('/payments/all', 'PaymentController@index')->name('show-all-payments')->middleware('auth');
Route::get('/payments/search', 'PaymentController@index')->middleware('auth');
Route::delete('/payments/{payment_id}', 'PaymentController@destroy')->middleware('auth');

//routes for tenants
Route::get('/units/{unit_id}/tenants/{tenant_id}', 'TenantController@show')->name('show-tenant')->middleware('auth');
Route::post('/tenants', 'TenantController@store')->middleware('auth');
Route::get('/units/{unit_id}/tenants/{tenant_id}/edit', 'TenantController@edit')->middleware('auth');
Route::put('/units/{unit_id}/tenants/{tenant_id}/', 'TenantController@update')->middleware('auth');
Route::post('/units/{unit_id}/tenants/{tenant_id}', 'TenantController@moveout')->middleware('auth');
Route::post('/units/{unit_id}/tenants/{tenant_id}/renew', 'TenantController@renew')->middleware('auth');
Route::delete('/tenants/{tenant_id}', 'TenantController@destroy')->middleware('auth');


//step1
Route::get('/units/{unit_id}/tenant-step1', 'TenantController@createTenantStep1')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step1', 'TenantController@postTenantStep1')->middleware('auth');

//step2
Route::get('/units/{unit_id}/tenant-step2', 'TenantController@createTenantStep2')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step2', 'TenantController@postTenantStep2')->middleware('auth');

//step3
Route::get('/units/{unit_id}/tenant-step3', 'TenantController@createTenantStep3')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step3', 'TenantController@postTenantStep3')->middleware('auth');

//step-4
Route::get('/units/{unit_id}/tenant-step4', 'TenantController@createTenantStep4')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step4', 'TenantController@postTenantStep4')->middleware('auth');

//routes for billings
Route::get('/units/{unit_id}/tenants/{tenant_id}/billings', 'TenantController@show_billings')->name('show-billings')->middleware('auth');
Route::post('/tenants/billings', 'TenantController@add_billings')->name("add-billings")->middleware('auth');
Route::post('/tenants/billings-post', 'TenantController@post_billings')->middleware('auth');
Route::get('/tenants/posted-bills', 'TenantController@show_posted_bills')->name('show-posted-bills')->middleware('auth');


Route::get('/units/{unit_id}/tenants/{tenant_id}/payments', 'TenantController@show_payments')->name('show-payments')->middleware('auth');

//route for searching tenant
Route::get('/tenants/search', 'TenantController@search')->middleware('auth');

//routes for investors
Route::get('/units/{unit_id}/unit_owners/{unit_owner_id}', 'UnitOwnersController@show')->name('show-investor')->middleware('auth');
Route::post('/units', 'UnitsController@store')->middleware('auth');

//route for searching investors
Route::get('/unit_owners/{unit_owner_id}', 'UnitOwnersController@search')->middleware('auth');

//route for users
Route::get('/users/search', 'UserController@search')->middleware('auth');
Route::get('/users/{user_id}', 'UserController@show')->middleware('auth');
Route::post('/users', 'UserController@store')->middleware('auth');
Route::get('/users/{user_id}/edit', 'UserController@edit')->middleware('auth');
Route::put('users/{user_id}', 'UserController@update')->middleware('auth');
Route::delete('/users/{user_id}', 'UserController@destroy')->middleware('auth');

Route::get('/faq', function(){
    return view('faq');
});


//step1
Route::get('/units/{unit_id}/tenant-step1', 'TenantController@createTenantStep1')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step1', 'TenantController@postTenantStep1')->middleware('auth');

//step2
Route::get('/units/{unit_id}/tenant-step2', 'TenantController@createTenantStep2')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step2', 'TenantController@postTenantStep2')->middleware('auth');

//step3
Route::get('/units/{unit_id}/tenant-step3', 'TenantController@createTenantStep3')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step3', 'TenantController@postTenantStep3')->middleware('auth');

//step-4
Route::get('/units/{unit_id}/tenant-step4', 'TenantController@createTenantStep4')->middleware('auth');
Route::post('/units/{unit_id}/tenant-step4', 'TenantController@postTenantStep4')->middleware('auth');


//tenant's online reservation
Route::post('/reservation','TenantController@post_reservation');
Route::get('/properties','UnitsController@show_property');
Route::get('/{properties}/units','UnitsController@show_vacant_units');
Route::get('/{properties}/units/{unit_id}', 'UnitsController@show_reservation_form');
Route::get('/{properties}/units/{unit_id}/tenants/{tenant_id}/reserved', 'TenantController@get_reservation');

