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

Auth::routes(['verify'=> true]);

Route::get('/resources', function(){
    return view('landing-page.resources');
});

Route::get('/', function(){
    $clients = DB::table('users')
    ->where('user_type', 'admin')
    ->count();

    $properties = Unit::distinct()
    ->count('unit_property');
      
    $buildings = Unit::distinct()
    ->count('building');

    $rooms = Unit::distinct()
    ->count('unit_no');

    $tenants = DB::table('tenants')
    ->where('tenant_status', 'active')
    ->count();

    return view('landing-page.index', compact('clients','properties', 'buildings', 'rooms', 'tenants'));
}); 

Route::get('/board', function(Request $request){

    if(auth()->user()->status === 'unregistered'){
        return view('unregistered');
    }

            $pending_concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('concern_status', 'pending')
            ->where('unit_property', Auth::user()->property)
            ->get();

            $concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('concern_status', 'active')
            ->orderBy('date_reported', 'desc')
            ->orderBy('concern_urgency', 'desc')
            ->orderBy('concern_status', 'desc')
            ->paginate(10);

            $active_concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('concern_status', 'active')
            ->where('unit_property', Auth::user()->property)
            ->get();

            $all_tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->orderBy('movein_date', 'desc')
            ->get();

            $units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','!=', 'pulled out')
            ->orderBy('building')
            ->orderBy('floor_no')
            ->orderBy('unit_no')
            ->get();

            $units_occupied = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','occupied')
            ->orderBy('building')
            ->orderBy('floor_no')
            ->orderBy('unit_no')
            ->get();

            $units_vacant = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','vacant')
            ->orderBy('building')
            ->orderBy('floor_no')
            ->orderBy('unit_no')
            ->get();

            $units_reserved = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','reserved')
            ->orderBy('building')
            ->orderBy('floor_no')
            ->orderBy('unit_no')
            ->get();

            $active_tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status', 'active')
            ->orderBy('movein_date', 'desc')
            ->get();

                    
            $inactive_tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status', 'inactive')
            ->orderBy('movein_date', 'desc')
            ->get();

            $pending_tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status', 'pending')
            ->orderBy('movein_date', 'desc')
            ->get();

            $owners = DB::table('units')
            ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
            ->where('unit_property', Auth::user()->property)
            ->where('status', '!=', 'pulled out')
            ->get();

            $movein_rate_1 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(11)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            
            ->count();
    
            $movein_rate_2 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(10)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_3 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(9)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_4 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(8)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_5 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(7)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
    
            $movein_rate_6 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(6)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_7 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_8 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
            
            $movein_rate_9 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('unit_property', Auth::user()->property)
            ->where('status','!=', 'pulled out')
            ->where('type_of_units', 'leasing')
            ->count();
    
            $movein_rate_10 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_11 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->subMonth()->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();
    
            $movein_rate_12 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('movein_date', '>=', Carbon::now()->firstOfMonth())
            ->where('movein_date', '<=', Carbon::now()->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereIn('tenant_status',['active', 'inactive'])
            ->where('status','!=', 'pulled out')
            ->count();

            if($units->count() <= 0){
                $movein_rate = new DashboardChart;
                $movein_rate->barwidth(0.0);
                $movein_rate->displaylegend(false);
                $movein_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
                $movein_rate->dataset('Occupancy Rate: ', 'line', [
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    number_format(1,2),
                                                    ])
                ->color("#858796")
                ->backgroundcolor("rgba(78, 115, 223, 0.05)")
                ->fill(true)
                ->linetension(0.3);
            }else{
                $movein_rate = new DashboardChart;
                $movein_rate->barwidth(0.0);
                $movein_rate->displaylegend(false);
                $movein_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
                $movein_rate->dataset('Occupancy Rate: ', 'line', [
                                                    number_format(($all_tenants->count()-($movein_rate_2 + $movein_rate_3 + $movein_rate_4 + $movein_rate_5 + $movein_rate_6 + $movein_rate_7 + $movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_3 + $movein_rate_4 + $movein_rate_5 + $movein_rate_6 + $movein_rate_7 + $movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_4 + $movein_rate_5 + $movein_rate_6 + $movein_rate_7 + $movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_5 + $movein_rate_6 + $movein_rate_7 + $movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_6 + $movein_rate_7 + $movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_7 + $movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_8 + $movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_9 + $movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_10 + $movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_11 + $movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($all_tenants->count()-($movein_rate_12))/$units->count() * 100,2),
                                                    number_format(($active_tenants->count()/$units->count()) * 100,2)
                                                    ])
                ->color("#858796")
                ->backgroundcolor("rgba(78, 115, 223, 0.05)")
                ->fill(true)
                ->linetension(0.3);
            }

            $renewed_contracts = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('has_extended', 'renewed')
            ->where('tenant_status', '!=', 'inactive')
            ->get();
        
            $terminated_contracts = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->get();

            $overall_contract_termination = $renewed_contracts->count() + $terminated_contracts->count();

            $renewed_chart = new DashboardChart;
            $renewed_chart->displayAxes(false);
            $renewed_chart->labels([ 'Renewed'.' ('.$renewed_contracts->count(). ')', 'Terminated'.' ('.$terminated_contracts->count(). ')', 'Total'.' ('.$overall_contract_termination. ')']);
            $renewed_chart->dataset('', 'pie', [number_format(($overall_contract_termination == 0 ? 0 : $renewed_contracts->count()/$overall_contract_termination) * 100,1),number_format(($overall_contract_termination == 0 ? 0 :$terminated_contracts->count()/$overall_contract_termination) * 100,1)  ])
            ->backgroundColor(['#008000', '#FF0000']);

            $collection_rate_1 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(11)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
    
            $collection_rate_2 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(10)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
    
            $collection_rate_3 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(9)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
    
            $collection_rate_4 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(8)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
    
            $collection_rate_5 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(7)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
    
            $collection_rate_6 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(6)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
        
            $collection_rate_7 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(5)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
           
            ->sum('amt_paid');
        
            $collection_rate_8 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(4)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->whereRaw("payment_note like '%Rent%' ")
            ->sum('amt_paid');
        
            $collection_rate_9 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(3)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            
            ->sum('amt_paid');
        
             $collection_rate_10 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonths(2)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->sum('amt_paid');
        
             $collection_rate_11 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->subMonth()->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->subMonth()->firstOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->sum('amt_paid');
        
             $collection_rate_12 = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('payment_created', '>=', Carbon::now()->firstOfMonth())
            ->where('payment_created', '<=', Carbon::now()->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->sum('amt_paid');

            $collection_rate = new DashboardChart;

            $collection_rate->barwidth(0.0);
            $collection_rate->displaylegend(false);
            $collection_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
            $collection_rate->dataset('Total collection', 'line', [
                $collection_rate_1,
                $collection_rate_2,
                $collection_rate_3,
                $collection_rate_4,
                $collection_rate_5,
                $collection_rate_6,
                $collection_rate_7,
                $collection_rate_8,
                $collection_rate_9,
                $collection_rate_10,
                $collection_rate_11,
                $collection_rate_12,
                                                                  ])
            ->color("#858796")
            ->backgroundcolor("rgba(78, 115, 223, 0.05)")
            ->fill(true)
            ->linetension(0.3);

            $delinquent_accounts = DB::table('units')
            ->selectRaw('*,sum(billing_amt) as total_bills')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('billings', 'tenant_id', 'billing_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('billing_status', 'unpaid')
            ->where('billing_date', '<', Carbon::now()->startOfMonth()->addDays(7))
            ->groupBy('tenant_id')
            ->where('billing_amt','>', 0)
            ->orderBy('total_bills', 'desc')
            ->paginate(10);
            
            $tenants_to_watch_out = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('moveout_date')
            ->where('tenant_status', 'active')
            ->where('moveout_date', '<=', Carbon::now()->addMonth())
            ->paginate(10);

            $moveout_rate_1 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(11)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
          
            ->count();
    
            $moveout_rate_2 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(10)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
           
            ->count();
    
            $moveout_rate_3 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(9)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
         
            ->count();
    
            $moveout_rate_4 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(8)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
          
            ->count();
    
            $moveout_rate_5 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(7)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
      
            ->count();
    
            $moveout_rate_6 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(6)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
          
            ->count();
    
            $moveout_rate_7 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
          
            ->count();
        
            $moveout_rate_8 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
            ->count();
        
            $moveout_rate_9= DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
            ->count();
        
            $moveout_rate_10= DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
            ->count();
        
            $moveout_rate_11 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->subMonth()->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
            ->count();
        
            $moveout_rate_12 = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('actual_move_out_date', '>=', Carbon::now()->firstOfMonth())
            ->where('actual_move_out_date', '<=', Carbon::now()->endOfMonth())
            ->where('unit_property', Auth::user()->property)
            ->where('tenant_status','inactive')
            ->count();

            $moveout_rate = new DashboardChart;
            $moveout_rate->barwidth(0.0);
            $moveout_rate->displaylegend(false);
            $moveout_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
            $moveout_rate->dataset('number of moveouts', 'line', [
                                                            $moveout_rate_1,
                                                            $moveout_rate_2,
                                                            $moveout_rate_3,
                                                            $moveout_rate_4,
                                                            $moveout_rate_5,
                                                            $moveout_rate_6,
                                                            $moveout_rate_7,
                                                            $moveout_rate_8,
                                                            $moveout_rate_9,
                                                            $moveout_rate_10,
                                                            $moveout_rate_11,
                                                            $moveout_rate_12
                                                          ]
                            )
            ->color("#858796")
            ->backgroundcolor("rgba(78, 115, 223, 0.05)")
            ->fill(true)
            ->linetension(0.3);

            $end_of_contract = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->where('reason_for_moving_out','end of contract')
            ->get();
    
            $delinquent = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->where('reason_for_moving_out','delinquent')
            ->get();
    
            $force_majeure = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->where('reason_for_moving_out','force majeure')
            ->get();
    
            $run_away = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->where('reason_for_moving_out','run away')
            ->get();
    
            $force_majeure = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->where('reason_for_moving_out','force majeure')
            ->get();
        
            $unruly = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('movein_date', 'desc')
            ->where('tenant_status', 'inactive')
            ->where('reason_for_moving_out','unruly')
            ->get();

            $reason_for_moving_out_chart = new DashboardChart;
            $reason_for_moving_out_chart->displayAxes(false);
            $reason_for_moving_out_chart->labels([ 'End Of Contract'.' ('.$end_of_contract->count(). ')', 'Delinquent'.' ('.$delinquent->count(). ')', 'Force Majeure'.' ('.$force_majeure->count(). ')', 'Run Away'.' ('.$run_away->count(). ')', 'Unruly'.' ('.$unruly->count(). ')','Total'.' ('.$inactive_tenants->count(). ')']);
            $reason_for_moving_out_chart->dataset('', 'pie', [number_format(($inactive_tenants->count() == 0 ? 0 : $end_of_contract->count()/$inactive_tenants->count()) * 100,1),number_format(($inactive_tenants->count() == 0 ? 0 : $delinquent->count()/$inactive_tenants->count()) * 100,1),number_format(($inactive_tenants->count() == 0 ? 0 : $force_majeure->count()/$inactive_tenants->count()) * 100,1),number_format(($inactive_tenants->count() == 0 ? 0 : $run_away->count()/$inactive_tenants->count()) * 100,1), number_format(($inactive_tenants->count() == 0 ? 0 : $unruly->count()/$inactive_tenants->count()) * 100,1),])
            ->backgroundColor(['#008000', '#FF0000','#0E0601','#DE7835','#211979']);

            $collections_for_the_day = DB::table('units')
            ->select('*', DB::raw('sum(amt_paid) as total'))
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->groupBy('tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->where('payment_created', Carbon::today())
            ->get();


            $notifications = DB::table('notifications')
            ->select('*','notifications.created_at as created_at', 'notifications.updated_at as updated_at')
            ->join('units', 'unit_id', 'notification_room_id')
            ->join('tenants', 'tenant_id', 'notification_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('notifications.created_at', 'desc')
            ->limit(5)
            ->get();

            $notifications_opened = DB::table('notifications')
            ->whereNull('updated_at')
            ->count();

          

            // $requested_moveouts = DB::table('tenants')
            // ->join('units', 'unit_id', 'unit_tenant_id')
            // ->where('unit_property', Auth::user()->property)
            // ->whereNotNull('tenants.created_at')
            // ->whereNull('tenants.updated_at')
            // ->whereNull('tenants.actual_move_out_date')
            // ->orderBy('tenants.created_at', 'desc')
            // ->limit(3)
            // ->get();

            // $approved_moveouts = DB::table('tenants')
            // ->join('units', 'unit_id', 'unit_tenant_id')
            // ->where('unit_property', Auth::user()->property)
            // ->whereNotNull('tenants.created_at')
            // ->whereNotNull('tenants.updated_at')
            // ->whereNull('tenants.actual_move_out_date')
            // ->orderBy('tenants.updated_at', 'desc')
            // ->limit(3)
            // ->get();

            // $processed_moveouts = DB::table('tenants')
            // ->join('units', 'unit_id', 'unit_tenant_id')
            // ->where('unit_property', Auth::user()->property)
            // ->whereNotNull('actual_move_out_date')
            // ->orderBy('tenants.actual_move_out_date', 'desc')
            // ->limit(3)
            // ->get();

            // $processed_moveouts = DB::table('tenants')
            // ->join('units', 'unit_id', 'unit_tenant_id')
            // ->where('unit_property', Auth::user()->property)
            // ->where('tenant_status','inactive')
            // ->orderBy('tenants.actual_move_out_date', 'desc')
            // ->limit(3)
            // ->get();
      
        return view('manager.dashboard', 
            compact(
            'units', 'units_occupied','units_vacant', 'units_reserved',
            'active_tenants', 'pending_tenants', 'owners', 
            'movein_rate','moveout_rate', 'renewed_chart', 'collection_rate', 'reason_for_moving_out_chart',
            'delinquent_accounts','tenants_to_watch_out',
            'collections_for_the_day','pending_concerns','active_concerns','concerns',
            'notifications','notifications_opened'
                    )
            );

    })->middleware(['auth', 'verified']);

//routes for units
Route::get('units/{unit_id}', 'UnitsController@show')->middleware(['auth', 'verified']);
Route::put('units/{unit_id}', 'UnitsController@update')->middleware(['auth', 'verified']);
Route::post('units/add', 'UnitsController@add_unit')->middleware(['auth', 'verified']);
Route::post('units/add-multiple', 'UnitsController@add_multiple_rooms')->middleware(['auth', 'verified']);

Route::get('/home', function(){

    if(auth()->user()->status === 'registered' && (auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'admin') ){

        $units_count = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','!=', 'pulled out')
            ->count();

        $units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->where('status','!=', 'pulled out')
            ->orderBy('floor_no', 'asc')
            ->orderBy('unit_no', 'asc')
            ->get()
            ->groupBy(function($item) {
            return $item->floor_no;
        });

        $buildings = DB::table('units')
            ->select('building', 'status', DB::raw('count(*) as count'))
            ->where('unit_property', Auth::user()->property)
            ->groupBy('building')
            ->where('status','!=', 'pulled out')
            ->get('building', 'status','count');   

            
        // $units_per_status = DB::table('units')
        //     ->select('status',DB::raw('count(*) as count'))
        //     ->where('unit_property', Auth::user()->property)
        //     ->where('status','!=', 'pulled out')
        //     ->groupBy('status')
        //     ->get();
        
        return view('admin.home',compact('units','buildings', 'units_count'));
        }else{
            return view('unregistered');
        }
   
})->middleware(['auth', 'verified']);

//routes for payments
Route::get('units/{unit_id}/tenants/{tenant_id}/payments/{payment_id}', 'PaymentController@show')->name('show-payment')->middleware(['auth', 'verified']);
Route::post('/payments', 'PaymentController@store')->middleware(['auth', 'verified']);
Route::get('/payments/all', 'PaymentController@index')->name('show-all-payments')->middleware(['auth', 'verified']);
Route::get('/payments/search', 'PaymentController@index')->middleware(['auth', 'verified']);
Route::delete('/payments/{payment_id}', 'PaymentController@destroy')->middleware(['auth', 'verified']);

Route::get('/units/{unit_id}/tenants/{tenant_id}/payments/{payment_id}/dates/{payment_created}/export', 'TenantController@export')->middleware(['auth', 'verified']);

Route::get('/units/{unit_id}/tenants/{tenant_id}/billings/export', 'TenantController@exportBills')->middleware(['auth', 'verified']);

//routes for tenants
Route::get('/units/{unit_id}/tenants/{tenant_id}', 'TenantController@show')->name('show-tenant')->middleware(['auth', 'verified']);
Route::post('/tenants', 'TenantController@store')->middleware(['auth', 'verified']);
Route::get('/units/{unit_id}/tenants/{tenant_id}/edit', 'TenantController@edit')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/', 'TenantController@update')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenants/{tenant_id}', 'TenantController@moveout')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenants/{tenant_id}/renew', 'TenantController@renew')->middleware(['auth', 'verified']);
Route::delete('/tenants/{tenant_id}', 'TenantController@destroy')->middleware(['auth', 'verified']);

Route::get('/notifications', function(){

    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury' || auth()->user()->user_type === 'billing'){
        
        $notifications = DB::table('notifications')
        ->select('*','notifications.updated_at as updated_at')
        ->join('units', 'unit_id', 'notification_room_id')
        ->join('tenants', 'tenant_id', 'notification_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->orderBy('notifications.created_at', 'desc')
        ->get();
       
        return view('all-notifications', compact('notifications'));
    }else{
        return view('unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/tenants', function(){

    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury' || auth()->user()->user_type === 'billing'){
        
            $tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('tenant_status', 'asc')
            ->orderBy('movein_date', 'desc')
            ->paginate(10);

            $count_tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->count();
       
        return view('admin.tenants', compact('tenants', 'count_tenants'));
    }else{
        return view('unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/concerns', function(){

    if(auth()->user()->status === 'registered'|| auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        
             $concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('date_reported', 'desc')
            ->orderBy('concern_urgency', 'desc')
            ->orderBy('concern_status', 'desc')
            ->paginate(10);
       
        return view('admin.concerns', compact('concerns'));
    }else{
        return view('unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/users', function(){

    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'manager'){
        
        if(Auth::user()->email === 'marthaleasingcourtyards@gmail.com'){
            $users = DB::table('users')
            ->orderBy('user_current_status', 'desc')
            ->orderBy('last_login_at', 'desc')
            ->get();
        }else{
            $users = DB::table('users')
            ->where('property', Auth::user()->property)
            ->orderBy('user_current_status', 'desc')
            ->orderBy('last_login_at', 'desc')
            ->get();
        }

        return view('users.users', compact('users'));

    }else{
        return view('unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/owners', function(){
    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        $property = explode(",", Auth::user()->property);
      
            $owners = DB::table('units')
            ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
            ->where('unit_property', Auth::user()->property)
            ->where('status','!=','pulled out')
            ->orderBy('contract_start', 'desc')
            ->paginate(10);
        
            return view('admin.owners', compact('owners'));
    }else{
            return view('unregistered');
    }
    
})->middleware(['auth', 'verified']);

Route::get('/collections', function(){
    if(auth()->user()->status === 'registered' && (auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury')){
        $property = explode(",", Auth::user()->property);

            $collections = DB::table('units')
            ->join('tenants', 'unit_id', 'unit_tenant_id')
            ->join('payments', 'tenant_id', 'payment_tenant_id')
            ->where('unit_property', Auth::user()->property)
            // ->whereIn('payment_note',['Rent', 'Electricity', 'Water', 'Surcharge'])
            ->orderBy('payment_created', 'desc')
          
            ->get()
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->payment_created)->timestamp;
            });

            // $collections = DB::table('units')
            // ->select('*','payments.created_at as created_at', DB::raw('sum(amt_paid) as total'))
            // ->join('tenants', 'unit_id', 'unit_tenant_id')
            // ->join('payments', 'tenant_id', 'payment_tenant_id')
            // ->groupBy('tenant_id')
            // ->groupBy('payment_created')
            // ->where('unit_property', Auth::user()->property)
            // ->whereIn('payment_note',['Rent', 'Electricity', 'Water', 'Surcharge'])
            // ->orderBy('ar_number', 'desc')
            // ->get();

        return view('billing.collections', compact('collections'));
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

Route::get('/bills', function(){
    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        
        $bills = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->where('billing_amt','>',0)
        ->whereIn('billing_desc',['Rent', 'Electricity', 'Water', 'Surcharge'])
        ->orderBy('billing_date', 'desc')
        ->orderBy('billing_no', 'desc')
        ->get()
        ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->billing_date)->timestamp;
        });
   
        return view('billing.bills', compact('bills'));
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

Route::get('/account-payables', function(){
    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        return view('account-payables.account-payables');
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

Route::get('/housekeeping', function(){
    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

        $housekeeping = DB::table('personnels')
        ->where('personnel_property', Auth::user()->property)
        ->where('personnel_type', 'housekeeping')
        ->get();

        return view('admin.housekeeping', compact('housekeeping'));
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

Route::get('/maintenance', function(){
    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

         $maintenance = DB::table('personnels')
        ->where('personnel_property', Auth::user()->property)
        ->where('personnel_type', 'maintenance')
        ->get();

        return view('admin.maintenance', compact('maintenance'));
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

Route::get('/job-orders', function(){
    if(auth()->user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

        return view('admin.job-orders');
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

//step1
Route::get('/units/{unit_id}/tenant-step1', 'TenantController@createTenantStep1')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step1', 'TenantController@postTenantStep1')->middleware(['auth', 'verified']);

//step2
Route::get('/units/{unit_id}/tenant-step2', 'TenantController@createTenantStep2')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step2', 'TenantController@postTenantStep2')->middleware(['auth', 'verified']);

//step3
Route::get('/units/{unit_id}/tenant-step3', 'TenantController@createTenantStep3')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step3', 'TenantController@postTenantStep3')->middleware(['auth', 'verified']);

//step-4
Route::get('/units/{unit_id}/tenant-step4', 'TenantController@createTenantStep4')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step4', 'TenantController@postTenantStep4')->middleware(['auth', 'verified']);

//routes for billings
Route::get('/units/{unit_id}/tenants/{tenant_id}/billings', 'TenantController@show_billings')->name('show-billings')->middleware(['auth', 'verified']);
Route::post('/tenants/billings', 'TenantController@add_billings')->name("add-billings")->middleware(['auth', 'verified']);
Route::post('/tenants/billings-post', 'TenantController@post_billings')->middleware(['auth', 'verified']);


Route::get('/units/{unit_id}/tenants/{tenant_id}/payments', 'TenantController@show_payments')->name('show-payments')->middleware(['auth', 'verified']);

//route for searching tenant
Route::get('/tenants/search', 'TenantController@search')->middleware(['auth', 'verified']);

//routes for investors
Route::get('/units/{unit_id}/unit_owners/{unit_owner_id}', 'UnitOwnersController@show')->name('show-investor')->middleware(['auth', 'verified']);
Route::post('/units', 'UnitsController@store')->middleware(['auth', 'verified']);
Route::delete('/units/{$unit_id}', 'UnitsController@destroy')->middleware(['auth', 'verified']);

//route for searching investors
Route::get('/unit_owners/{unit_owner_id}', 'UnitOwnersController@search')->middleware(['auth', 'verified']);

//route for users
Route::get('/users/search', 'UserController@search')->middleware(['auth', 'verified']);
Route::get('/users/{user_id}', 'UserController@show')->middleware('auth');
Route::post('/users', 'UserController@store')->middleware(['auth', 'verified']);
Route::get('/users/{user_id}/edit', 'UserController@edit')->middleware('auth');
Route::put('users/{user_id}', 'UserController@update')->middleware('auth');
Route::delete('/users/{user_id}', 'UserController@destroy')->middleware(['auth', 'verified']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware(['auth', 'verified']);

//step1
Route::get('/units/{unit_id}/tenant-step1', 'TenantController@createTenantStep1')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step1', 'TenantController@postTenantStep1')->middleware(['auth', 'verified']);

//step2
Route::get('/units/{unit_id}/tenant-step2', 'TenantController@createTenantStep2')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step2', 'TenantController@postTenantStep2')->middleware(['auth', 'verified']);

//step3
Route::get('/units/{unit_id}/tenant-step3', 'TenantController@createTenantStep3')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step3', 'TenantController@postTenantStep3')->middleware(['auth', 'verified']);

//step-4
Route::get('/units/{unit_id}/tenant-step4', 'TenantController@createTenantStep4')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenant-step4', 'TenantController@postTenantStep4')->middleware(['auth', 'verified']);

//concerns
Route::post('/concerns', 'ConcernController@store')->middleware(['auth', 'verified']);

//show concerns 
Route::get('/units/{unit_id}/tenants/{tenant_id}/concerns/{concern_id}', 'ConcernController@show')->middleware(['auth', 'verified']);

//update concerns
Route::put('/concerns/{concern_id}', 'ConcernController@update')->middleware(['auth', 'verified']);

Route::post('/billings', 'BillingController@store')->middleware(['auth', 'verified']);


//routes for personnels
Route::post('/personnels', 'PersonnelController@store')->middleware(['auth', 'verified']);

//tenant's online reservation
Route::post('/reservation','TenantController@post_reservation');
Route::get('/properties','UnitsController@show_property');
Route::get('/{properties}/units','UnitsController@show_vacant_units');
Route::get('/{properties}/units/{unit_id}', 'UnitsController@show_reservation_form');
Route::get('/{properties}/units/{unit_id}/tenants/{tenant_id}/reserved', 'TenantController@get_reservation');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/google', 'Auth\LoginController@google');
Route::get('login/google/callback', 'Auth\LoginController@googleCallback');


Route::get('/password/email', function(Request $request){
    return $request->all();
});


