<?php

use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Billing;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenantRegisteredMail;
use App\Mail\SendContractAlertEmail;


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

     $properties = User::where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->where('user_type', 'manager')
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->count();
      
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
    if(Auth::user()->property === null){
        return view('property-profile');
    }elseif(Auth::user()->property !== null &&  Auth::user()->account_type === null){
        return view('payment-info');
    }
      elseif(Auth::user()->property !== null && Auth::user()->account_type !== null && Auth::user()->trial_ends_at === null){
          return view('payment-info');
      }   
    else{
      
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
        
        ->get();

        // $movein_rate_1 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(11)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
       
        // ->count();

        // $movein_rate_2 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(10)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
        
        // ->count();

        // $movein_rate_3 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(9)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
      
        // ->count();

        // $movein_rate_4 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(8)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
       
        // ->count();

        // $movein_rate_5 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(7)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])

        // ->count();


        // $movein_rate_6 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(6)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
    
        // ->count();

        // $movein_rate_7 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])

        // ->count();

        // $movein_rate_8 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
        // ->count();
        
        // $movein_rate_9 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        // ->where('unit_property', Auth::user()->property)
        // ->count();

        // $movein_rate_10 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
        // ->count();

        // $movein_rate_11 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->subMonth()->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
        // ->count();

        // $movein_rate_12 = DB::table('tenants')
        // ->join('units', 'unit_id', 'unit_tenant_id')
        // ->where('movein_date', '>=', Carbon::now()->firstOfMonth())
        // ->where('movein_date', '<=', Carbon::now()->endOfMonth())
        // ->where('unit_property', Auth::user()->property)
        //  ->whereIn('tenant_status',['active', 'inactive'])
        // ->count();

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
            $movein_rate->dataset('Occupancy Rate: ', 'line', 
                                                [
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(11))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(10))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(9))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(8))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(7))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(6))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(5))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(4))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(3))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(2))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today()->subMonth(1))->max('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->where('occupancy_date', Carbon::today())->max('occupancy_rate'),
                                                ]
                                )
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

       $delinquent_accounts = Billing::leftJoin('payments', 'billings.billing_id', 'payments.payment_billing_id') 
       ->leftJoin('tenants', 'billing_tenant_id', 'tenant_id')
       ->leftJoin('units', 'tenant_id', 'unit_tenant_id')
        ->selectRaw('*, billing_amt - IFNULL(sum(amt_paid),0) as balance')
        ->where('unit_property', Auth::user()->property)
       ->where('billing_date', '<', Carbon::now()->startOfMonth()->addDays(7))
        ->groupBy('tenant_id')
        ->orderBy('balance', 'desc')
        ->havingRaw('balance > 0')
        ->get();
        
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
        ->join('units', 'unit_id', 'notification_room_id')
        ->join('tenants', 'tenant_id', 'notification_tenant_id')
        ->where('unit_property', Auth::user()->property)
        ->count();
  
        if(Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory'){
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
        }else{
            return view('manager.dashboard-condo', 
            compact(
            'units', 'units_occupied','units_vacant', 'units_reserved',
            'active_tenants', 'pending_tenants', 'owners', 
            'movein_rate','moveout_rate', 'renewed_chart', 'collection_rate', 'reason_for_moving_out_chart',
            'delinquent_accounts','tenants_to_watch_out',
            'collections_for_the_day','pending_concerns','active_concerns','concerns',
            'notifications','notifications_opened'
                    )
            );
        }
        

        
    }

})->middleware(['auth', 'verified']);

//routes for units
Route::get('units/{unit_id}', 'UnitsController@show')->middleware(['auth', 'verified']);
Route::put('units/{unit_id}', 'UnitsController@update')->middleware(['auth', 'verified']);
Route::post('units/add', 'UnitsController@add_unit')->middleware(['auth', 'verified']);
Route::post('units/add-multiple', 'UnitsController@add_multiple_rooms')->middleware(['auth', 'verified']);

Route::get('/home', function(){

    if(auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'admin' ){

        $units_count = DB::table('units')
            ->where('unit_property', Auth::user()->property)
            ->count();

        $units = DB::table('units')
            ->where('unit_property', Auth::user()->property)
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
            ->get('building', 'status','count');   

        if(Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory' ){
            return view('admin.home',compact('units','buildings', 'units_count'));
        }
        else{
            return view('admin.condo',compact('units','buildings', 'units_count'));
        }
        
      
    }
})->middleware(['auth', 'verified']);

//routes for payments
Route::get('units/{unit_id}/tenants/{tenant_id}/payments/{payment_id}', 'PaymentController@show')->name('show-payment')->middleware(['auth', 'verified']);
Route::post('/payments', 'PaymentController@store')->middleware(['auth', 'verified']);
Route::get('/payments/all', 'PaymentController@index')->name('show-all-payments')->middleware(['auth', 'verified']);
Route::get('/payments/search', 'PaymentController@index')->middleware(['auth', 'verified']);
Route::delete('tenants/{tenant_id}/payments/{payment_id}', 'PaymentController@destroy')->middleware(['auth', 'verified']);

Route::get('/units/{unit_id}/tenants/{tenant_id}/payments/{payment_id}/dates/{payment_created}/export', 'TenantController@export')->middleware(['auth', 'verified']);



Route::get('/property/{property}/export', function(Request $request){
    $collections = DB::table('units')
    ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
    ->leftJoin('payments', 'tenant_id', 'payment_tenant_id')
    ->leftJoin('billings', 'payment_billing_no', 'billing_no')
    ->where('unit_property', Auth::user()->property)
    ->whereDate('payment_created', Carbon::now())
    ->orderBy('payment_created', 'desc')
    ->orderBy('ar_no', 'desc')
    ->groupBy('payment_id')
    ->get();

    $data = [
        'collections' => $collections,
    ];

$pdf = \PDF::loadView('treasury.ar-all', $data)->setPaper('a5', 'portrait');

return $pdf->download(Carbon::now().'-'.Auth::user()->property.'-ar'.'.pdf');


})->middleware(['auth', 'verified']);


//print gate pass
Route::get('/units/{unit_id}/tenants/{tenant_id}/print/gatepass', 'TenantController@printGatePass')->middleware(['auth', 'verified']);

Route::get('/units/{unit_id}/tenants/{tenant_id}/bills/download', function($unit_id, $tenant_id){
    $tenant = Tenant::findOrFail($tenant_id);
    $unit = Unit::findOrFail($unit_id);
    $bills = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
    ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
    ->where('billing_tenant_id', $tenant_id)
    ->groupBy('billing_id')
    ->orderBy('billing_no', 'desc')
    ->havingRaw('balance > 0')
    ->get();
    $data = [
        'tenant' => $tenant->first_name.' '.$tenant->last_name ,
        'tenant_status' => $tenant->tenant_status,
        'unit' => $unit->building.' '.$unit->unit_no,
        'bills' => $bills,
];
    $pdf = \PDF::loadView('billing.soa', $data)->setPaper('a5', 'portrait');
    return $pdf->download(Carbon::now().'-'.$tenant->first_name.'-'.$tenant->last_name.'-soa'.'.pdf');
})->middleware(['auth', 'verified']);

Route::get('/units/{unit_id}/tenants/{tenant_id}/bills/send', function($unit_id,$tenant_id){
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
    $pdf = \PDF::loadView('billing.soa', $data)->setPaper('a5', 'portrait');
    $pdf->download(Carbon::now().'-'.$tenant->first_name.'-'.$tenant->last_name.'-soa'.'.pdf');
   $pdf->save(storage_path().'_filename.pdf');
})->middleware(['auth', 'verified']);

//routes for tenants
Route::get('/units/{unit_id}/tenants/{tenant_id}', 'TenantController@show')->name('show-tenant')->middleware(['auth', 'verified']);
Route::post('/tenants', 'TenantController@store')->middleware(['auth', 'verified']);
Route::get('/units/{unit_id}/tenants/{tenant_id}/edit', 'TenantController@edit')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/', 'TenantController@update')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/moveout', 'TenantController@moveout')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenants/{tenant_id}/renew', 'TenantController@renew')->middleware(['auth', 'verified']);
Route::delete('/tenants/{tenant_id}', 'TenantController@destroy')->middleware(['auth', 'verified']);

Route::get('/notifications', function(){

    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury' || auth()->user()->user_type === 'billing'){
        
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

    if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury' && (Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory')){
        
            $tenants = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('tenant_status', 'asc')
            ->orderBy('movein_date', 'desc')
            ->get();

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

    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        
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

    $properties = User::where('user_type', 'manager')
    ->leftJoin('units', 'property','unit_property')
    ->select('*','users.created_at as created_at')
    ->selectRaw("count(unit_id) as count_units")
   
    ->selectRaw("count(case when units.status = 'occupied' then 1 end) as occupied_units")
    ->selectRaw("count(case when units.status = 'vacant' then 1 end) as vacant_units")
    
    ->whereNotNull('account_type')
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->groupBy('property')
    ->orderBy('users.created_at','desc')
    ->get();

    $paying_users = DB::table('users')
    ->where('account_type','!=','Free')
    ->whereNotNull('account_type')
    ->whereNotNull('trial_ends_at')
    ->get();

    $unverified_users = DB::table('users')
    ->whereNull('email_verified_at')
    ->orderBy('users.created_at', 'desc')
    ->get();
    
    // $users_created = DB::table('users')
    // ->where('property', Auth::user()->property)
    // ->groupBy('id')
    // ->get()
    // ->groupBy(function($item) {
    //     return \Carbon\Carbon::parse($item->created_at)->timestamp;
    // });;

    $signup_rate_1 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(11)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_2 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(10)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
  
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_3 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(9)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_4 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(8)->endOfMonth())
 
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_5 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(7)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
   
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_6 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(6)->endOfMonth())
 
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_7 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(5)->endOfMonth())
 
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_8 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(4)->endOfMonth())
 
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_9 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(3)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
   
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_10 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(2)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate_11 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(1)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(1)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

     $signup_rate_12 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate = new DashboardChart;
    $signup_rate->barwidth(0.0);
    $signup_rate->displaylegend(false);
    $signup_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
    $signup_rate->dataset('number of signups', 'line', [
                                                           $signup_rate_1,
                                                           $signup_rate_2,
                                                           $signup_rate_3,
                                                           $signup_rate_4,
                                                           $signup_rate_5,
                                                           $signup_rate_6,
                                                           $signup_rate_7,                                         
                                                           $signup_rate_8,
                                                           $signup_rate_9,
                                                           $signup_rate_10,
                                                           $signup_rate_11,
                                                           $signup_rate_12,
                                                        ]
                         )
                        
    ->color("#858796")
    ->backgroundcolor("rgba(78, 115, 223, 0.05)")
    ->fill(true)
    ->linetension(0.3);

    $active_users = DB::table('users')
    ->orderBy('user_current_status', 'desc')
    ->orderBy('last_login_at', 'desc')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    
    ->get();


    if(auth()->user()->user_type === 'manager'){
        
        if(Auth::user()->email === 'thepropertymanager2020@gmail.com' || Auth::user()->email === 'tecson.pamela@gmail.com'){

          

            $users = DB::table('users')
            ->orderBy('user_current_status', 'desc')
            ->orderBy('last_login_at', 'desc')
            ->get();

        

             $sessions = DB::table('users')
            ->join('sessions', 'id', 'session_user_id')
            ->whereNotNull('session_last_login_at')
            ->whereDay('session_last_login_at', now()->day)
            ->get();

          
        }else{
            $users = DB::table('users')
            ->where('property', Auth::user()->property)
            ->orderBy('user_current_status', 'desc')
            ->orderBy('last_login_at', 'desc')
            ->get();

            $sessions = DB::table('users')
            ->join('sessions', 'id', 'session_user_id')
            ->where('property', Auth::user()->property)
            ->whereNotNull('session_last_login_at')
            ->whereDay('session_last_login_at', now()->day)
            ->get();


        }

        return view('users.users', compact('users', 'sessions', 'paying_users', 'unverified_users', 'properties','signup_rate','active_users'));

    }else{
        return view('unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/owners', function(){
    if( auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        
      
            $owners = DB::table('units')
            ->join('unit_owners', 'unit_unit_owner_id', 'unit_owner_id')
            ->where('unit_property', Auth::user()->property)
            ->get();

            $count_owners = DB::table('units')
            ->join('unit_owners', 'unit_owner_id', 'unit_unit_owner_id')
            ->where('unit_property', Auth::user()->property)
            ->count();
        
            return view('admin.owners', compact('owners', 'count_owners'));
    }else{
            return view('unregistered');
    }
    
})->middleware(['auth', 'verified']);

Route::get('/collections', function(){
    if(auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury'){

             $collections = DB::table('units')
            ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
           
            ->leftJoin('payments', 'tenant_id', 'payment_tenant_id')
            ->leftJoin('billings', 'payment_billing_no', 'billing_no')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('payment_created', 'desc')
            ->orderBy('ar_no', 'desc')
            ->groupBy('payment_id')
            ->get()
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->payment_created)->timestamp;
            });

            
           
            
            // $collections = DB::table('units')
            // ->select('*','payments.created_at as created_at', DB::raw('sum(amt_paid) as total'))
            // ->join('tenants', 'unit_id', 'unit_tenant_id')
            // ->join('payments', 'tenant_id', 'payment_tenant_id')
            // ->where('unit_property', Auth::user()->property)
            // ->groupBy('payment_created')
            // ->orderBy('ar_number', 'desc')
            // ->get()
            
            // ->groupBy(function($item) {
            //     return \Carbon\Carbon::parse($item->payment_created)->timestamp;
            // });

        return view('billing.collections', compact('collections'));
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

Route::get('/bills', function(){
    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'billing'){


        $bills = DB::table('units')
        ->join('tenants', 'unit_id', 'unit_tenant_id')
        ->join('billings', 'tenant_id', 'billing_tenant_id')
        ->where('unit_property', Auth::user()->property)
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
    if( auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
        return view('account-payables.account-payables');
    }else{
        return view('unregistered');
    }
})->middleware(['auth', 'verified']);

Route::get('/housekeeping', function(){
    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

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
    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

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
    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

        return view('admin.job-orders');
    }else{
        return view('unregistered');
    }
   
})->middleware(['auth', 'verified']);

//step1
Route::get('/units/{unit_id}/tenants-create', 'TenantController@create')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenants/add', 'TenantController@store')->middleware(['auth', 'verified']);

// //step2
// Route::get('/units/{unit_id}/tenant-step2', 'TenantController@createTenantStep2')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step2', 'TenantController@postTenantStep2')->middleware(['auth', 'verified']);

// //step3
// Route::get('/units/{unit_id}/tenant-step3', 'TenantController@createTenantStep3')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step3', 'TenantController@postTenantStep3')->middleware(['auth', 'verified']);

// //step-4
// Route::get('/units/{unit_id}/tenant-step4', 'TenantController@createTenantStep4')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step4', 'TenantController@postTenantStep4')->middleware(['auth', 'verified']);

//routes for billings
Route::get('/units/{unit_id}/tenants/{tenant_id}/billings', 'TenantController@show_billings')->name('show-billings')->middleware(['auth', 'verified']);
Route::get('/units/{unit_id}/tenants/{tenant_id}/billings/edit', 'TenantController@edit_billings')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/billings/edit', 'TenantController@post_edited_billings')->middleware(['auth', 'verified']);
Route::post('/tenants/billings', 'TenantController@add_billings')->name("add-billings")->middleware(['auth', 'verified']);
Route::post('/tenants/billings-post', 'TenantController@post_billings')->middleware(['auth', 'verified']);
Route::delete('tenants/{tenant_id}/billings/{billing_id}', 'BillingController@destroy')->middleware(['auth', 'verified']);


Route::get('/units/{unit_id}/tenants/{tenant_id}/payments', 'TenantController@show_payments')->name('show-payments')->middleware(['auth', 'verified']);

//route for searching tenant
Route::get('/tenants/search', 'TenantController@search')->middleware(['auth', 'verified']);

Route::get('/owners/search', 'UnitOwnersController@search')->middleware(['auth', 'verified']);

Route::get('units/{unit_id}/owners/{unit_owner_id}/edit', 'UnitOwnersController@edit')->middleware(['auth', 'verified']);

//routes for investors
Route::get('/units/{unit_id}/owners/{unit_owner_id}', 'UnitOwnersController@show')->name('show-investor')->middleware(['auth', 'verified']);
Route::post('/units', 'UnitsController@store')->middleware(['auth', 'verified']);
Route::delete('/units/{unit_id}', 'UnitsController@destroy')->middleware(['auth', 'verified']);

//route for searching investors
Route::get('/owners/{unit_owner_id}', 'UnitOwnersController@search')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/owners/{unit_owner_id}', 'UnitOwnersController@update')->middleware(['auth', 'verified']);


//route for users
Route::get('/users/search', 'UserController@search')->middleware(['auth', 'verified']);
Route::get('/users/{user_id}', 'UserController@show')->middleware('auth');
Route::post('/users', 'UserController@store')->middleware(['auth', 'verified']);
Route::get('/users/{user_id}/edit', 'UserController@edit')->middleware(['auth', 'verified']);
Route::put('/users/{user_id}', 'UserController@update')->middleware(['auth', 'verified']);
Route::delete('/users/{user_id}', 'UserController@destroy')->middleware(['auth', 'verified']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware(['auth', 'verified']);

// //step1
// Route::get('/units/{unit_id}/tenant-step1', 'TenantController@createTenantStep1')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step1', 'TenantController@postTenantStep1')->middleware(['auth', 'verified']);

// //step2
// Route::get('/units/{unit_id}/tenant-step2', 'TenantController@createTenantStep2')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step2', 'TenantController@postTenantStep2')->middleware(['auth', 'verified']);

// //step3
// Route::get('/units/{unit_id}/tenant-step3', 'TenantController@createTenantStep3')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step3', 'TenantController@postTenantStep3')->middleware(['auth', 'verified']);

// //step-4
// Route::get('/units/{unit_id}/tenant-step4', 'TenantController@createTenantStep4')->middleware(['auth', 'verified']);
// Route::post('/units/{unit_id}/tenant-step4', 'TenantController@postTenantStep4')->middleware(['auth', 'verified']);

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

Route::get('/property', function(){


    return view('properties.properties');
});
Route::get('/{properties}/units','UnitsController@show_vacant_units');
Route::get('/{properties}/units/{unit_id}', 'UnitsController@show_reservation_form');
Route::get('/{properties}/units/{unit_id}/tenants/{tenant_id}/reserved', 'TenantController@get_reservation');


//routes for logging in using facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

//routes for loggin in using google
Route::get('sign-in/google', 'Auth\LoginController@google');
Route::get('sign-in/google/redirect', 'Auth\LoginController@googleRedirect');

Route::get('/board/search', function(Request $request){
    return 'to be constructed';

    // $search_item = $request->search;

    // $search = DB::table('units')
    // ->join('tenants', 'unit_tenant_id', 'tenant_id')
    // ->join('unit_owners', 'unit_owner_id', 'unit_id')
    // ->where('unit_property', Auth::user()->property)

    // ->orWhere(function ($query) {
    //     $query->where('unit_no', 1)
    //           ->where('first_name', 'Krisha');
    // })
    // ->get();

    // return view('search.search-board', compact('search'));

})->middleware(['auth', 'verified']);

Route::put('/users/{user_id}/property', function(Request $request){

    $request->validate([
        'property' => 'required|unique:users|max:255',
        'property_ownership' => 'required',
        'property_type' => 'required',
    ]);

    DB::table('users')
    ->where('id', Auth::user()->id)
    ->update([
        'property' => $request->property,
        'property_type' => $request->property_type,
        'property_ownership' => $request->property_ownership 
    ]);

    return back();

});

Route::put('/users/{user_id}/plan', function(Request $request){
    DB::table('users')
    ->where('id', Auth::user()->id)
    ->update([
        'account_type' => $request->account_type,
    ]);

    return back();

});

Route::post('/users/{user_id}/charge', function(Request $request){

    if(Auth::user()->account_type === 'Free'){
        DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'trial_ends_at'=> Carbon::now()->addMonth(),
         ]);
     
         Mail::to(Auth::user()->email)->send(new TenantRegisteredMail());
     
         return back();
    }else{
        
        Stripe\Stripe::setApiKey('sk_test_51HJukYJRwyQ1aYnq47AXjpdfByCMtKxJJqcsORmKtMmSvliAuxnYuGTLRpTQVmuKAbPvMW7KdBn361qSNR13HTH700pQjYbkVO');

        $charge = 0;

        if(Auth::user()->account_type === 'Medium'){
            $charge = 95000;
        }elseif(Auth::user()->account_type === 'Large'){
            $charge = 180000;
        }elseif(Auth::user()->account_type === 'Enterprise'){
            $charge = 240000;
        }elseif(Auth::user()->account_type === 'Corporate'){
            $charge = 480000;
        }
    
       try{
        Stripe\Charge::create(array(
            "amount" => $charge,
            "currency" => "php",
            'source' => $request->stripeToken,
            'description' => Auth::user()->name.' | '.Auth::user()->property.' | ' . Auth::user()->property_type.' | '.Auth::user()->property_ownership.' | '.Auth::user()->account_type.' | '.$charge,
        ));
    
        DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
           'trial_ends_at'=> Carbon::now()->addMonth(),
        ]);
    
        Mail::to(Auth::user()->email)->send(new TenantRegisteredMail());
    
        return back();
    
       }catch(\Exception $e){
           return back()->with('danger', $e->getMessage());
       }
    }

});

//sending tenant for contract extension
Route::get('/units/{unit_id}/tenants/{tenant_id}/alert/contract', function(Request $request, $unit_id, $tenant_id){

    $tenant = Tenant::findOrFail($tenant_id);
    $unit  = Unit::findOrFail($unit_id);

    $diffInDays =  number_format(Carbon::now()->DiffInDays(Carbon::parse($tenant->moveout_date), false));

    $data = array(
        'email' => $tenant->email_address,
        'name' => $tenant->first_name,
        'unit' => $unit->building.' '.$unit->unit_no,
        'contract_ends_at'  => $tenant->moveout_date,
        'days_before_moveout' => $diffInDays
    );

    Mail::send('emails.send-contract-alert-mail', $data, function($message) use ($data){
        
        $message->to($data['email']);
        $message->subject('Contract Alert');
    });

    DB::table('tenants')
    ->where('tenant_id', $tenant->tenant_id)
    ->update([
        'tenants_note' => 'Email has been sent!'
    ]);
    
    return back()->with('success', 'Email  has been sent to '. $tenant->first_name.' of '. $unit->building.' '.$unit->unit_no);

})->middleware(['auth', 'verified']);

//sending tenant for contract extension
Route::get('/units/{unit_id}/tenants/{tenant_id}/alert/contract', function(Request $request, $unit_id, $tenant_id){

    $tenant = Tenant::findOrFail($tenant_id);
    $unit  = Unit::findOrFail($unit_id);

    $diffInDays =  number_format(Carbon::now()->DiffInDays(Carbon::parse($tenant->moveout_date), false));

    $data = array(
        'email' => $tenant->email_address,
        'name' => $tenant->first_name,
        'unit' => $unit->building.' '.$unit->unit_no,
        'contract_ends_at'  => $tenant->moveout_date,
        'days_before_moveout' => $diffInDays
    );

    Mail::send('emails.send-contract-alert-mail', $data, function($message) use ($data){
        
        $message->to($data['email']);
        $message->subject('Contract Alert');
    });

    DB::table('tenants')
    ->where('tenant_id', $tenant->tenant_id)
    ->update([
        'tenants_note' => 'Email has been sent!'
    ]);
    
    return back()->with('success', 'Email  has been sent to '. $tenant->first_name.' of '. $unit->building.' '.$unit->unit_no);

})->middleware(['auth', 'verified']);

Route::post('/send/inquiry', function(Request $request){

    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'subject' => 'required',
        'message' => 'required',
    ]);

    return $request->all();
    
    return redirect('/#contact');
 
});

Route::get('/privacy-policy', function(){
    return view('privacy-policy');
});

Route::get('/terms-of-service', function(){
    return view('terms-of-service');
});

Route::get('/acceptable-use-policy', function(){
    return view('acceptable-use-policy');
});

Route::get('/logins', function(){
    $sessions = DB::table('users')
    ->join('sessions', 'id', 'session_user_id')
    ->whereNotNull('session_last_login_at')
    ->groupBy('session_id')
    ->orderBy('session_last_login_at', 'desc')
    ->get()
    ->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->session_last_login_at)->timestamp;
     });

    return view('logins', compact('sessions'));
})->middleware(['auth', 'verified']);

//mass update the period covered in add monthly rent
Route::post('/bills/rent/{date}', function(Request $request){

    $updated_billing_start = $request->billing_start;
    $updated_billing_end = $request->billing_end;

  $active_tenants = DB::table('tenants')
  ->join('units', 'unit_id', 'unit_tenant_id')
  ->where('unit_property', Auth::user()->property)
  ->where('tenant_status', 'active')
  ->get();

   //get the number of last added bills
   $current_bill_no = DB::table('units')
   ->join('tenants', 'unit_id', 'unit_tenant_id')
   ->join('billings', 'tenant_id', 'billing_tenant_id')
   ->where('unit_property', Auth::user()->property)
   ->max('billing_no') + 1;

    return view('billing.add-rental-bill', compact('active_tenants','current_bill_no', 'updated_billing_start', 'updated_billing_end'))->with('success', 'Period covered has been changed!');

})->middleware(['auth', 'verified']);

//mass update the period covered in add electric bill
Route::post('/bills/electric/{date}', function(Request $request){

    $updated_billing_start = $request->billing_start;
    $updated_billing_end = $request->billing_end;
    $electric_rate_kwh = $request->electric_rate_kwh;


  $active_tenants = DB::table('tenants')
  ->join('units', 'unit_id', 'unit_tenant_id')
  ->where('unit_property', Auth::user()->property)
  ->where('tenant_status', 'active')
  ->get();

   //get the number of last added bills
   $current_bill_no = DB::table('units')
   ->join('tenants', 'unit_id', 'unit_tenant_id')
   ->join('billings', 'tenant_id', 'billing_tenant_id')
   ->where('unit_property', Auth::user()->property)
   ->max('billing_no') + 1;

   DB::table('users')
   ->where('id', Auth::user()->id)
   ->update([
        'electric_rate_kwh' => $request->electric_rate_kwh
   ]);

    return view('billing.add-electric-bill', compact('active_tenants','current_bill_no', 'updated_billing_start', 'updated_billing_end', 'electric_rate_kwh'))->with('success', 'Period covered has been changed!');

})->middleware(['auth', 'verified']);

//mass update the period covered in add water bill
Route::post('/bills/water/{date}', function(Request $request){

    $updated_billing_start = $request->billing_start;
    $updated_billing_end = $request->billing_end;
    $water_rate_cum = $request->water_rate_cum;


  $active_tenants = DB::table('tenants')
  ->join('units', 'unit_id', 'unit_tenant_id')
  ->where('unit_property', Auth::user()->property)
  ->where('tenant_status', 'active')
  ->get();

   //get the number of last added bills
   $current_bill_no = DB::table('units')
   ->join('tenants', 'unit_id', 'unit_tenant_id')
   ->join('billings', 'tenant_id', 'billing_tenant_id')
   ->where('unit_property', Auth::user()->property)
   ->max('billing_no') + 1;

   DB::table('users')
   ->where('id', Auth::user()->id)
   ->update([
        'water_rate_cum' => $request->water_rate_cum
   ]);

    return view('billing.add-water-bill', compact('active_tenants','current_bill_no', 'updated_billing_start', 'updated_billing_end', 'water_rate_cum'))->with('success', 'Period covered has been changed!');

})->middleware(['auth', 'verified']);

Route::put('/units/{unit_id}/tenants/{tenant_id}/edit/img', function(Request $request, $unit_id,$tenant_id){

    $request->validate([
        'tenant_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

  $filename = Auth::user()->property.''.Carbon::now()->getPreciseTimestamp(4).'.png';

  $request->tenant_img->storeAs('public/tenants', $filename);

    DB::table('tenants')
    ->where('tenant_id', $tenant_id)
    ->update(
            [
                'tenant_img' => $filename
            ]   
        );

    return back()->with('success', 'Tenant image has been updated!');
})->middleware(['auth', 'verified']);

Route::get('/units/edit/{property}/{date}', 'UnitsController@show_edit_multiple_rooms')->middleware(['auth', 'verified']);
Route::put('/units/edit/{property}/{date}', 'UnitsController@post_edit_multiple_rooms')->middleware(['auth', 'verified']);






