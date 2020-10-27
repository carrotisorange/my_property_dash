<?php

namespace App\Http\Controllers;

use App\Property;
use DB;
use Auth;
use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Billing;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenantRegisteredMail;
use App\Mail\SendContractAlertEmail;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {

$pending_concerns = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->join('concerns', 'tenant_id', 'concern_tenant_id')
->where('concern_status', 'pending')
->where('property_id_foreign', $property_id)
->get();

$concerns = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->join('concerns', 'tenant_id', 'concern_tenant_id')
->where('property_id_foreign', $property_id)
->where('concern_status', 'active')
->orderBy('date_reported', 'desc')
->orderBy('concern_urgency', 'desc')
->orderBy('concern_status', 'desc')
->paginate(10);

$active_concerns = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->join('concerns', 'tenant_id', 'concern_tenant_id')
->where('concern_status', 'active')
->where('property_id_foreign', $property_id)
->get();

$all_tenants = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('property_id_foreign', $property_id)
 ->whereIn('tenant_status',['active', 'inactive'])

->orderBy('movein_date', 'desc')
->get();

$units = DB::table('units')
->where('property_id_foreign', $property_id)
->where('status','<>','deleted')
->orderBy('building')
->orderBy('floor_no')
->orderBy('unit_no')
->get();

$units_occupied = DB::table('units')
->where('property_id_foreign', $property_id)
->where('status','occupied')
->orderBy('building')
->orderBy('floor_no')
->orderBy('unit_no')
->get();

$units_vacant = DB::table('units')
 ->where('property_id_foreign', $property_id)
->where('status','vacant')
->orderBy('building')
->orderBy('floor_no')
->orderBy('unit_no')
->get();

$units_reserved = DB::table('units')
 ->where('property_id_foreign', $property_id)
->where('status','reserved')
->orderBy('building')
->orderBy('floor_no')
->orderBy('unit_no')
->get();

$active_tenants = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->where('tenant_status', 'active')
->orderBy('movein_date', 'desc')
->get();


$inactive_tenants = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->where('tenant_status', 'inactive')
->orderBy('movein_date', 'desc')
->get();

$pending_tenants = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->where('tenant_status', 'pending')
->orderBy('movein_date', 'desc')
->get();

$owners = DB::table('unit_owners')
->join('units', 'unit_id_foreign', 'unit_id')
 ->where('property_id_foreign', $property_id)
->get();

  $current_occupancy_rate = DB::table('occupancy_rate')
->where('property_id_foreign', $property_id)
->latest('id')
->limit(1)
->pluck('occupancy_rate');

$movein_rate = new DashboardChart;
$movein_rate->barwidth(0.0);
$movein_rate->displaylegend(false);
$movein_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
$movein_rate->dataset('Occupancy Rate: ', 'line',
                                        [
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(11)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(10)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(9)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(8)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(7)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(6)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(5)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(4)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(3)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonths(2)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            DB::table('occupancy_rate')->where('property_id_foreign', $property_id)->whereMonth('occupancy_date', Carbon::today()->subMonth()->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                            $current_occupancy_rate,
                                        ]
                        )
    ->color("#858796")
    ->backgroundcolor("rgba(78, 115, 223, 0.05)")
    ->fill(false)
    ->linetension(0.3);


$renewed_contracts = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('has_extended', 'renewed')
->where('tenant_status', '!=', 'inactive')
->get();

$terminated_contracts = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('tenant_status', 'inactive')
->get();

$overall_contract_termination = $renewed_contracts->count() + $terminated_contracts->count();

$renewed_chart = new DashboardChart;
$renewed_chart->displayAxes(false);
$renewed_chart->labels([ 'Renewed'.' ('.$renewed_contracts->count(). ')', 'Terminated'.' ('.$terminated_contracts->count(). ')', 'Total'.' ('.$overall_contract_termination. ')']);
$renewed_chart->dataset('', 'doughnut', [number_format(($overall_contract_termination == 0 ? 0 : $renewed_contracts->count()/$overall_contract_termination) * 100,1),number_format(($overall_contract_termination == 0 ? 0 :$terminated_contracts->count()/$overall_contract_termination) * 100,1)  ])
->backgroundColor(['#008000', '#FF0000']);

$collection_rate_1 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(11)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->sum('amt_paid');

$collection_rate_2 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(10)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->sum('amt_paid');

$collection_rate_3 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(9)->endOfMonth())
 ->where('property_id_foreign', $property_id)

->sum('amt_paid');

$collection_rate_4 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(8)->endOfMonth())
 ->where('property_id_foreign', $property_id)

->sum('amt_paid');

$collection_rate_5 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(7)->endOfMonth())
 ->where('property_id_foreign', $property_id)

->sum('amt_paid');

$collection_rate_6 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(6)->endOfMonth())
 ->where('property_id_foreign', $property_id)

->sum('amt_paid');

$collection_rate_7 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(5)->endOfMonth())
 ->where('property_id_foreign', $property_id)

->sum('amt_paid');

$collection_rate_8 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(4)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->whereRaw("payment_note like '%Rent%' ")
->sum('amt_paid');

$collection_rate_9 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(3)->endOfMonth())
 ->where('property_id_foreign', $property_id)

->sum('amt_paid');

 $collection_rate_10 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonths(2)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->sum('amt_paid');

 $collection_rate_11 = DB::table('units')
->join('tenants', 'unit_id', 'unit_tenant_id')
->join('payments', 'tenant_id', 'payment_tenant_id')
->where('payment_created', '>=', Carbon::now()->subMonth()->firstOfMonth())
->where('payment_created', '<=', Carbon::now()->subMonth()->firstOfMonth())
 ->where('property_id_foreign', $property_id)
->sum('amt_paid');

 $collection_rate_12 = DB::table('units')
 ->join('tenants', 'unit_id', 'unit_tenant_id')
 ->join('payments', 'tenant_id', 'payment_tenant_id')
 ->where('payment_created', '>=', Carbon::now()->firstOfMonth())
 ->where('payment_created', '<=', Carbon::now()->firstOfMonth())
  ->where('property_id_foreign', $property_id)
 ->sum('amt_paid');

$expenses_1 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(11)->endOfMonth())
->sum('amt');

$expenses_2 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(10)->endOfMonth())
->sum('amt');

$expenses_3 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(9)->endOfMonth())
->sum('amt');

$expenses_4 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(8)->endOfMonth())
->sum('amt');

$expenses_5 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(7)->endOfMonth())
->sum('amt');

$expenses_6 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(6)->endOfMonth())
->sum('amt');

$expenses_7 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(5)->endOfMonth())
->sum('amt');

$expenses_8 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(4)->endOfMonth())
->sum('amt');

$expenses_9 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(3)->endOfMonth())
->sum('amt');

 $expenses_10 = DB::table('payable_request')
 ->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonths(2)->endOfMonth())
->sum('amt');

 $expenses_11 = DB::table('payable_request')
 ->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->subMonth()->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->subMonth()->endOfMonth())
->sum('amt');

$expenses_12 = DB::table('payable_request')
->where('property_id_foreign', $property_id)
->where('status', 'released')
->where('updated_at', '>=', Carbon::now()->firstOfMonth())
->where('updated_at', '<=', Carbon::now()->endOfMonth())
->sum('amt');

$expenses_rate = new DashboardChart;

$expenses_rate->barwidth(4.0);
$expenses_rate->displaylegend(true);
$expenses_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
$expenses_rate->dataset
                        (
                            'Collection', 'line',
                                                            [
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

                                                            ]
                        )
->color("#0000FF")
->fill(false)
->backgroundcolor("#0000FF");

$expenses_rate->dataset
                        (
                            'Expenses', 'line',
                                                            [
                                                                $expenses_1,
                                                                $expenses_2,
                                                                $expenses_3,
                                                                $expenses_4,
                                                                $expenses_5,
                                                                $expenses_6,
                                                                $expenses_7,
                                                                $expenses_8,
                                                                $expenses_9,
                                                                $expenses_10,
                                                                $expenses_11,
                                                                $expenses_12
                                                            ]
                        )
->color("#ff0000")
->fill(false)
->backgroundcolor("#ff0000");

$expenses_rate->dataset
                        (
                            'Income', 'line',
                                                            [
                                                                $collection_rate_1 -  $expenses_1,
                                                                $collection_rate_2 -  $expenses_2,
                                                                $collection_rate_3 -  $expenses_3,
                                                                $collection_rate_4 - $expenses_4,
                                                                $collection_rate_5 -  $expenses_5,
                                                                $collection_rate_6 - $expenses_6,
                                                                $collection_rate_7 -  $expenses_7,
                                                                $collection_rate_8 -  $expenses_8,
                                                                $collection_rate_9 - $expenses_9,
                                                                $collection_rate_10 -$expenses_10,
                                                                $collection_rate_11-  $expenses_11,
                                                                $collection_rate_12 - $expenses_12
                                                            ],

                            )

->color("#008000")
->backgroundcolor("#008000")
->fill(false)
->linetension(0.4);

$delinquent_accounts = Billing::leftJoin('payments', 'billings.billing_id', 'payments.payment_billing_id')
->leftJoin('tenants', 'billing_tenant_id', 'tenant_id')
->leftJoin('units', 'tenant_id', 'unit_tenant_id')
->selectRaw('*, billing_amt - IFNULL(sum(amt_paid),0) as balance')
 ->where('property_id_foreign', $property_id)
->where('billing_date', '<', Carbon::now()->startOfMonth()->addDays(7))
->groupBy('tenant_id')
->orderBy('balance', 'desc')
->havingRaw('balance > 0')
->get();

$tenants_to_watch_out = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('moveout_date')
->where('tenant_status', 'active')
->where('moveout_date', '<=', Carbon::now()->addMonth())
->get();

$moveout_rate_1 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(11)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')
->count();

$moveout_rate_2 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(10)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')

->count();

$moveout_rate_3 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(9)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')

->count();

$moveout_rate_4 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(8)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')

->count();

$moveout_rate_5 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(7)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')

->count();

$moveout_rate_6 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(6)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')

->count();

$moveout_rate_7 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(5)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')

->count();

$moveout_rate_8 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(4)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')
->count();

$moveout_rate_9= DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(3)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')
->count();

$moveout_rate_10= DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonths(2)->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')
->count();

$moveout_rate_11 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->subMonth()->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->subMonth()->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')
->count();

$moveout_rate_12 = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
->where('actual_move_out_date', '>=', Carbon::now()->firstOfMonth())
->where('actual_move_out_date', '<=', Carbon::now()->endOfMonth())
 ->where('property_id_foreign', $property_id)
->where('tenant_status','inactive')
->count();

$moveout_rate = new DashboardChart;

$moveout_rate->displaylegend(false);
$moveout_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
$moveout_rate->dataset('Moveouts', 'bar', [
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
->fill(false)
->linetension(0.1);

$end_of_contract = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('tenant_status', 'inactive')
->where('reason_for_moving_out','end of contract')
->get();

$delinquent = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('tenant_status', 'inactive')
->where('reason_for_moving_out','delinquent')
->get();

$force_majeure = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('tenant_status', 'inactive')
->where('reason_for_moving_out','force majeure')
->get();

$run_away = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('tenant_status', 'inactive')
->where('reason_for_moving_out','run away')
->get();

$force_majeure = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
->orderBy('movein_date', 'desc')
->where('tenant_status', 'inactive')
->where('reason_for_moving_out','force majeure')
->get();

$unruly = DB::table('tenants')
->join('units', 'unit_id', 'unit_tenant_id')
 ->where('property_id_foreign', $property_id)
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
->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
->leftJoin('unit_owners', 'unit_id', 'unit_id_foreign')
->leftJoin('billings', 'tenant_id', 'billing_tenant_id')
->leftJoin('payments', 'payment_billing_id', 'billing_id')
->where('property_id_foreign', $property_id)
->whereDate('payment_created', Carbon::now())
->orderBy('payment_created', 'desc')
->orderBy('ar_no', 'desc')
->groupBy('payment_id')
->get();

$property = Property::findOrFail($property_id);

    return view('webapp.properties.show',
    compact(
    'units', 'units_occupied','units_vacant', 'units_reserved',
    'active_tenants', 'pending_tenants', 'owners',
    'movein_rate','moveout_rate', 'renewed_chart','expenses_rate', 'reason_for_moving_out_chart',
    'delinquent_accounts','tenants_to_watch_out',
    'collections_for_the_day','pending_concerns','active_concerns','concerns',
    'current_occupancy_rate', 'property','collection_rate_12'
            )
    );

// if(Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory'){
   
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
