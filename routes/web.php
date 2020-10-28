<?php

use App\Unit, App\UnitOwner, App\Tenant, App\User, App\Billing, App\Property;
use Carbon\Carbon;
use App\Charts\DashboardChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TenantRegisteredMail;
use App\Mail\SendContractAlertEmail;
use App\Concern;
use App\Session;

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

Route::get('/blogs', 'BlogController@index');

Route::post('/event', 'CalendarController@store')->middleware(['auth', 'verified']);

Route::post('ckeditor/image_upload', 'BlogController@upload')->name('upload');

Route::get('property/{property_id}/system-updates', function($property_id){
    $property = Property::findOrFail($property_id);

    return view('webapp.properties.system-updates',compact('property'));
});

Route::get('property/{property_id}/getting-started', function($property_id){
    $property = Property::findOrFail($property_id);

    return view('webapp.properties.getting-started',compact('property'));
});


Route::get('property/{property_id}/announcements', function($property_id){
    $property = Property::findOrFail($property_id);

    return view('webapp.properties.announcements',compact('property'));
});


//routes for blogs
Route::get('/property/{property_id}/blogs', 'BlogController@index');
Route::post('/property/{property_id}/blog', 'BlogController@store')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/blog/{blog_id}', 'BlogController@show')->middleware(['auth', 'verified']);

//routes for system-users
Route::get('/property/{property_id}/user/all', 'UserController@index_system_user')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/user/create', 'UserController@create_system_user')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/system-user/{user_id}', 'UserController@show_system_user')->middleware(['auth', 'verified']);
Route::post('/system-user/', 'UserController@store_system_user')->middleware(['auth', 'verified']);

//routes for properties 
Route::get('/property/all', 'PropertyController@index')->middleware(['auth', 'verified']);
Route::get('/property/create', 'PropertyController@create')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}', 'PropertyController@show')->middleware(['auth', 'verified']);
Route::post('/property/', 'PropertyController@store')->middleware(['auth', 'verified']);
Route::post('/property/select', 'PropertyController@select')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/search', 'PropertyController@search')->middleware(['auth', 'verified']);

//routes for dashboard
Route::get('/property/{property_id}/dashboard', 'DashboardController@index')->middleware(['auth', 'verified']);

//routes for home
Route::get('/property/{property_id}/home', 'HomeController@index')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/home/{unit_id}', 'HomeController@show')->middleware(['auth', 'verified']);

//routes for tenants
Route::get('/property/{property_id}/tenants', 'TenantController@index')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}', 'TenantController@show')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/edit', 'TenantController@edit')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}', 'TenantController@update')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/home/{unit_id}/tenant', 'TenantController@create')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/tenants/search', 'TenantController@search')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/extend', 'TenantController@extend')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/request', 'TenantController@request')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/approve', 'TenantController@approve')->middleware(['auth', 'verified']);

//routes for owners
Route::get('/property/{property_id}/owners', 'OwnerController@index')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/owner/{owner_id}/edit', 'OwnerController@edit')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/owner/{owner_id}', 'OwnerController@show')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/owner/{owner_id}', 'OwnerController@update')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/home/{unit_id}/owner', 'OwnerController@store')->middleware(['auth', 'verified']);

//routes for calendar
Route::get('/property/{property_id}/calendar', 'CalendarController@index')->middleware(['auth', 'verified']);

Route::get('/asa', function(){

 

//    return DB::table('units')

//     ->join('unit_owners', 'unit_id', 'unit_id_foreign')
 
//     ->where('unit_property', Auth::user()->property)
//     ->update([
//         'unit_unit_owner_id' => 'unit_id_foreign'
//     ]);

    // DB::table('users')
    //  ->where('property', Auth::user()->property)
    //  ->where('id','<>',Auth::user()->id )
    // ->update([
    //     'lower_access_user_id' => Auth::user()->id
    // ]);

//     DB::table('users')
//    ->update([
//        'trial_ends_at' => Carbon::now()->addMonths(2)
//    ]);

        // return back()->with('success','all existing users have been imported!');
});

//routes for concerns
Route::get('/property/{property_id}/concerns', 'ConcernController@index')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/tenant/{tenant_id}/concern', 'ConcernController@store')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/concern/{concern_id}', 'ConcernController@show')->middleware(['auth', 'verified']);

//routes for job orders
Route::get('/property/{property_id}/joborders', 'JobOrderController@index')->middleware(['auth', 'verified']);

//routes for personnels
Route::get('/property/{property_id}/personnels', 'PersonnelController@index')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/personnel', 'PersonnelController@store')->middleware(['auth', 'verified']);

//routes for bills
Route::get('/property/{property_id}/bills', 'BillController@index')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/bills/edit', 'BillController@edit')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/home/{unit_id}/tenant/{tenant_id}/bills/edit', 'BillController@post_edited_bills')->middleware(['auth', 'verified']);
Route::post('property/{property_id}/bills/rent/{date}', 'BillController@post_bills_rent')->middleware(['auth', 'verified']);
Route::post('property/{property_id}/bills/electric/{date}', 'BillController@post_bills_electric')->middleware(['auth', 'verified']);
Route::post('property/{property_id}/bills/water/{date}', 'BillController@post_bills_water')->middleware(['auth', 'verified']);

//routes for collections
Route::get('/property/{property_id}/collections', 'CollectionController@index')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/tenant/{tenant_id}/collection', 'CollectionController@store')->middleware(['auth', 'verified']);

//routes for financials
Route::get('/property/{property_id}/financials', 'FinancialController@index')->middleware(['auth', 'verified']);

//routes for payables
Route::get('/property/{property_id}/payables', 'PayableController@index')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/payable', 'PayableController@store')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/payable/request', 'PayableController@request')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/payable/{payable_id}/approve', 'PayableController@approve')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/payable/{payable_id}/decline', 'PayableController@decline')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/payable/{payable_id}/release', 'PayableController@release')->middleware(['auth', 'verified']);

//routes for users
Route::get('/property/{property_id}/users', 'UserController@index')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/user/{user_id}', 'UserController@show')->middleware(['auth', 'verified']);

//routes for responses
Route::post('concern/{concern_id}/response', 'ResponseController@store')->middleware(['auth', 'verified']);


//routes for the dashboard
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

    return view('website.index', compact('clients','properties', 'buildings', 'rooms', 'tenants'));
});

Route::get('/board', function(Request $request){
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
        ->where('status','<>','deleted')
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

        $owners = DB::table('unit_owners')
        ->join('units', 'unit_id_foreign', 'unit_id')
        ->where('unit_property', Auth::user()->property)
        ->get();

         $current_occupancy_rate = DB::table('occupancy_rate')
        ->where('occupancy_property', Auth::user()->property)
        ->latest('id')
        ->limit(1)
        ->pluck('occupancy_rate');

        $movein_rate = new DashboardChart;
        $movein_rate->barwidth(0.0);
        $movein_rate->displaylegend(false);
        $movein_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
        $movein_rate->dataset('Occupancy Rate: ', 'line',
                                                [
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(11)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(10)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(9)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(8)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(7)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(6)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(5)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(4)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(3)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonths(2)->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    DB::table('occupancy_rate')->where('occupancy_property', Auth::user()->property)->whereMonth('occupancy_date', Carbon::today()->subMonth()->month)->whereYear('occupancy_date', Carbon::today()->year)->orderBy('id','desc')->limit(1)->pluck('occupancy_rate'),
                                                    $current_occupancy_rate,
                                                ]
                                )
            ->color("#858796")
            ->backgroundcolor("rgba(78, 115, 223, 0.05)")
            ->fill(false)
            ->linetension(0.3);


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
        $renewed_chart->dataset('', 'doughnut', [number_format(($overall_contract_termination == 0 ? 0 : $renewed_contracts->count()/$overall_contract_termination) * 100,1),number_format(($overall_contract_termination == 0 ? 0 :$terminated_contracts->count()/$overall_contract_termination) * 100,1)  ])
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
         ->where('payment_created', '<=', Carbon::now()->firstOfMonth())
         ->where('unit_property', Auth::user()->property)
         ->sum('amt_paid');

        $expenses_1 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(11)->endOfMonth())
        ->sum('amt');

        $expenses_2 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(10)->endOfMonth())
        ->sum('amt');

        $expenses_3 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(9)->endOfMonth())
        ->sum('amt');

        $expenses_4 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(8)->endOfMonth())
        ->sum('amt');

        $expenses_5 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(7)->endOfMonth())
        ->sum('amt');

        $expenses_6 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(6)->endOfMonth())
        ->sum('amt');

        $expenses_7 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(5)->endOfMonth())
        ->sum('amt');

        $expenses_8 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(4)->endOfMonth())
        ->sum('amt');

        $expenses_9 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(3)->endOfMonth())
        ->sum('amt');

         $expenses_10 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonths(2)->endOfMonth())
        ->sum('amt');

         $expenses_11 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
        ->where('status', 'released')
        ->where('updated_at', '>=', Carbon::now()->subMonth()->firstOfMonth())
        ->where('updated_at', '<=', Carbon::now()->subMonth()->endOfMonth())
        ->sum('amt');

        $expenses_12 = DB::table('payable_request')
        ->where('property', Auth::user()->property)
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
        ->get();

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
        ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
        ->leftJoin('unit_owners', 'unit_id', 'unit_id_foreign')
        ->leftJoin('billings', 'tenant_id', 'billing_tenant_id')
        ->leftJoin('payments', 'payment_billing_id', 'billing_id')
       ->where('unit_property', Auth::user()->property)
       ->whereDate('payment_created', Carbon::now())
       ->orderBy('payment_created', 'desc')
       ->orderBy('ar_no', 'desc')
       ->groupBy('payment_id')
       ->get();

        // if(Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory'){
            return view('webapp.home.dashboard',
            compact(
            'units', 'units_occupied','units_vacant', 'units_reserved',
            'active_tenants', 'pending_tenants', 'owners',
            'movein_rate','moveout_rate', 'renewed_chart','expenses_rate', 'reason_for_moving_out_chart',
            'delinquent_accounts','tenants_to_watch_out',
            'collections_for_the_day','pending_concerns','active_concerns','concerns',
            'current_occupancy_rate'
                    )
            );

})->middleware(['auth', 'verified']);

//routes for units
Route::get('units/{unit_id}', 'UnitController@show')->middleware(['auth', 'verified']);
Route::put('units/{unit_id}', 'UnitController@update')->middleware(['auth', 'verified']);
Route::post('units/add', 'Unitsontroller@add_unit')->middleware(['auth', 'verified']);
Route::post('units/add-multiple', 'UnitController@add_multiple_rooms')->middleware(['auth', 'verified']);


//routes for payments
Route::get('units/{unit_id}/tenants/{tenant_id}/payments/{payment_id}', 'CollectionController@show')->name('show-payment')->middleware(['auth', 'verified']);
Route::post('/payments', 'CollectionController@store')->middleware(['auth', 'verified']);
Route::get('/payments/all', 'CollectionController@index')->name('show-all-payments')->middleware(['auth', 'verified']);
Route::get('/payments/search', 'CollectionController@index')->middleware(['auth', 'verified']);
Route::delete('tenants/{tenant_id}/payments/{payment_id}', 'CollectionController@destroy')->middleware(['auth', 'verified']);

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

$pdf = \PDF::loadView('webapp.collections.export-collections-for-today', $data)->setPaper('a5', 'portrait');

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
    $pdf = \PDF::loadView('webapp.bills.soa', $data)->setPaper('a5', 'portrait');
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
    $pdf = \PDF::loadView('webapp.bills.soa', $data)->setPaper('a5', 'portrait');
    $pdf->download(Carbon::now().'-'.$tenant->first_name.'-'.$tenant->last_name.'-soa'.'.pdf');
   $pdf->save(storage_path().'_filename.pdf');
})->middleware(['auth', 'verified']);

//routes for tenants
Route::get('/units/{unit_id}/tenants/{tenant_id}', 'TenantController@show')->name('show-tenant')->middleware(['auth', 'verified']);
Route::post('/tenants', 'TenantController@store')->middleware(['auth', 'verified']);
Route::get('/units/{unit_id}/tenants/{tenant_id}/edit', 'TenantController@edit')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/', 'TenantController@update')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/moveout', 'TenantController@moveout')->middleware(['auth', 'verified']);

Route::delete('/tenants/{tenant_id}', 'TenantController@destroy')->middleware(['auth', 'verified']);

Route::get('/owners', function(){
    if( auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){


            $owners = DB::table('unit_owners')
            ->join('units', 'unit_id_foreign', 'unit_id')
            ->where('unit_property', Auth::user()->property)
            ->get();

            $count_owners = DB::table('unit_owners')
            ->join('units', 'unit_id_foreign', 'unit_id')
            ->where('unit_property', Auth::user()->property)
            ->count();

            return view('webapp.owners.owners', compact('owners', 'count_owners'));
    }else{
            return view('website.unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/collections', function(){
    if(auth()->user()->user_type === 'billing' || auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'treasury'){

             $collections = DB::table('units')
             ->leftJoin('tenants', 'unit_id', 'unit_tenant_id')
             ->leftJoin('billings', 'tenant_id', 'billing_tenant_id')
             ->leftJoin('payments', 'payment_billing_id', 'billing_id')
            ->where('unit_property', Auth::user()->property)
            ->orderBy('payment_created', 'desc')
            ->orderBy('ar_no', 'desc')
            ->groupBy('payment_id')
            ->get()
            ->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->payment_created)->timestamp;
            });

        return view('webapp.collections.collections', compact('collections'));
    }else{
        return view('website.unregistered');
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
            return \Carbon\Carbon::parse($item->billing_start)->timestamp;
        });

        return view('webapp.bills.bills', compact('bills'));
    }else{
        return view('website.unregistered');
    }

})->middleware(['auth', 'verified']);



Route::get('/housekeeping', function(){
    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

        $housekeeping = DB::table('personnels')
        ->where('personnel_property', Auth::user()->property)
        ->where('personnel_type', 'housekeeping')
        ->get();

        return view('webapp.hose.housekeeping', compact('housekeeping'));
    }else{
        return view('website.unregistered');
    }

})->middleware(['auth', 'verified']);

Route::get('/maintenance', function(){
    if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){

         $maintenance = DB::table('personnels')
        ->where('personnel_property', Auth::user()->property)
        ->where('personnel_type', 'maintenance')
        ->get();

        return view('webapp.personnels.maintenance', compact('maintenance'));
    }else{
        return view('website.unregistered');
    }

})->middleware(['auth', 'verified']);


//step1
Route::get('/units/{unit_id}/tenants-create', 'TenantController@create')->middleware(['auth', 'verified']);
Route::post('/units/{unit_id}/tenants/add', 'TenantController@store')->middleware(['auth', 'verified']);

//routes for billings
Route::get('/units/{unit_id}/tenants/{tenant_id}/billings', 'TenantController@show_billings')->name('show-billings')->middleware(['auth', 'verified']);
Route::get('/units/{unit_id}/tenants/{tenant_id}/billings/edit', 'TenantController@edit_billings')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/tenants/{tenant_id}/billings/edit', 'TenantController@post_edited_billings')->middleware(['auth', 'verified']);
Route::post('/tenants/billings', 'TenantController@add_billings')->name("add-billings")->middleware(['auth', 'verified']);
Route::post('/tenants/billings-post', 'TenantController@post_billings')->middleware(['auth', 'verified']);
Route::delete('tenants/{tenant_id}/billings/{billing_id}', 'BillController@destroy')->middleware(['auth', 'verified']);

//delete owners
Route::delete('owners/{owner_id}', 'OwnerController@destroy')->middleware(['auth', 'verified']);

//route for searching tenant


Route::get('/owners/search', 'OwnerController@search')->middleware(['auth', 'verified']);

Route::get('units/{unit_id}/owners/{unit_owner_id}/edit', 'OwnerController@edit')->middleware(['auth', 'verified']);

//routes for investors
Route::get('/units/{unit_id}/owners/{unit_owner_id}', 'OwnerController@show')->name('show-investor')->middleware(['auth', 'verified']);
Route::post('/units', 'UnitController@store')->middleware(['auth', 'verified']);
Route::delete('/units/{unit_id}', 'UnitController@destroy')->middleware(['auth', 'verified']);

//route for searching investors
Route::get('/owners/{unit_owner_id}', 'OwnerController@search')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/owners/{unit_owner_id}', 'OwnerController@update')->middleware(['auth', 'verified']);


//route for users
Route::get('/users/search', 'UserController@search')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}', 'UserController@show')->middleware('auth');
Route::post('/users', 'UserController@store')->middleware(['auth', 'verified']);
Route::get('/users/{user_id}/edit', 'UserController@edit')->middleware(['auth', 'verified']);
Route::put('/users/{user_id}', 'UserController@update')->middleware(['auth', 'verified']);
Route::delete('/users/{user_id}', 'UserController@destroy')->middleware(['auth', 'verified']);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware(['auth', 'verified']);

//concerns
Route::post('/concerns', 'ConcernController@store')->middleware(['auth', 'verified']);

//show concerns
Route::get('/units/{unit_id}/tenants/{tenant_id}/concerns/{concern_id}', 'ConcernController@show')->middleware(['auth', 'verified']);

//update concerns
Route::put('/concerns/{concern_id}', 'ConcernController@update')->middleware(['auth', 'verified']);

Route::post('/billings', 'BillController@store')->middleware(['auth', 'verified']);


//routes for personnels
Route::post('/personnels', 'PersonnelController@store')->middleware(['auth', 'verified']);

//routes for logging in using facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

//routes for loggin in using google
Route::get('sign-in/google', 'Auth\LoginController@google');
Route::get('sign-in/google/redirect', 'Auth\LoginController@googleRedirect');


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

//routes for registration

//post the desired plan
Route::post('/users/{user_id}/charge', function(Request $request){

    if(Auth::user()->account_type === 'Free'){
         Mail::to(Auth::user()->email)->send(new TenantRegisteredMail());

         return back();
    }else{



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
       

        Mail::to(Auth::user()->email)->send(new TenantRegisteredMail());

        return back();

       }catch(\Exception $e){
           return back()->with('danger', $e->getMessage());
       }
    }

});

//routes for bills



// routes for tenants

//send notice for contract extension
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

    Mail::send('webapp.tenants.send-contract-alert-mail', $data, function($message) use ($data){

        $message->to($data['email']);
        $message->subject('Contract Alert');
    });

    DB::table('tenants')
    ->where('tenant_id', $tenant->tenant_id)
    ->update([
        'tenants_note' => 'email has been sent!'
    ]);

    return back()->with('success', 'email  has been sent to '. $tenant->first_name.' of '. $unit->building.' '.$unit->unit_no);

})->middleware(['auth', 'verified']);

//post tenant image
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

    return back()->with('success', 'changes have been saved!');
})->middleware(['auth', 'verified']);


//routes for rooms/units


//show multiple units for editing
Route::get('/property/{property_id}/home/{date}/edit', 'UnitController@show_edit_multiple_rooms')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/home/{date}', 'UnitController@post_edit_multiple_rooms')->middleware(['auth', 'verified']);

//post changes to multiple units
Route::put('/units/edit/{property}/{date}', 'UnitController@post_edit_multiple_rooms')->middleware(['auth', 'verified']);


//routes for resources in landing page

//show privacy policy
Route::get('/privacy-policy', function(){
    return view('website.privacy-policy');
});

//show terms of service
Route::get('/terms-of-service', function(){
    return view('website.terms-of-service');
});


//show acceptable use policy
Route::get('/acceptable-use-policy', function(){
    return view('website.acceptable-use-policy');
});


//close concern 
Route::put('/concerns/{concern_id}/closed', function(Request $request){

    if($request->rating === null && $request->feedback === null){
        return back()->with('danger', 'Please provide a rating and feedback for the employee.');
    }else{
        DB::table('concerns')
        ->where('concern_id', $request->concern_id)
        ->update(
            [
                'concern_status' => 'closed',
                'rating' => $request->rating,
                'feedback' => $request->feedback
            ]
        );

    return back()->with('success', 'concern has been closed!');
    }
   
})->middleware(['auth', 'verified']);
