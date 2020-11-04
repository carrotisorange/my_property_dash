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
Route::get('/user/all', 'UserController@index_system_user')->middleware(['auth', 'verified']);
Route::get('/user/create', 'UserController@create_system_user')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}', 'UserController@show_system_user')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/edit', 'UserController@edit_system_user')->middleware(['auth', 'verified']);
Route::put('/user/{user_id}', 'UserController@update_system_user')->middleware(['auth', 'verified']);
Route::post('/user/store', 'UserController@store_system_user')->middleware(['auth', 'verified']);

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

Route::post('/tenant/{tenant_id}/user/create', 'TenantController@create_user_access')->middleware(['auth', 'verified']);

//routes for owners
Route::get('/property/{property_id}/owners', 'OwnerController@index')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/owner/{owner_id}/edit', 'OwnerController@edit')->middleware(['auth', 'verified']);
Route::get('/property/{property_id}/owner/{owner_id}', 'OwnerController@show')->middleware(['auth', 'verified']);
Route::put('/property/{property_id}/owner/{owner_id}', 'OwnerController@update')->middleware(['auth', 'verified']);
Route::post('/property/{property_id}/home/{unit_id}/owner', 'OwnerController@store')->middleware(['auth', 'verified']);

//routes for calendar
Route::get('/property/{property_id}/calendar', 'CalendarController@index')->middleware(['auth', 'verified']);

Route::get('/asa', function(){

    // $sessions = User::findOrFail(Auth::user()->id)->sessions;

    //  $sessions->count();
    // if($sessions->count() <= 0){
    //     return 'isnert';
    // }else{
    //     return 'dont insert';
    // }

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

    DB::table('users')
   ->update([
       'trial_ends_at' => Carbon::now()->addMonth()
   ]);

//     DB::table('users')
//    ->update([
//        'trial_ends_at' => Carbon::now()->addMonths(2)
//    ]);

        return back()->with('success','all existing users have been imported!');
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
Route::put('/property/{property_id}/user/{user_id}', 'UserController@update')->middleware(['auth', 'verified']);
Route::get('/user/upgrade', 'UserController@upgrade')->middleware(['auth', 'verified']);

Route::post('/user/{user_id}/tenant/{tenant_id}/dashboard', 'UserController@show_user_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/tenant/{tenant_id}/dashboard', 'UserController@show_user_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/tenant/{tenant_id}/rooms', 'UserController@show_room_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/tenant/{tenant_id}/bills', 'UserController@show_bill_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/tenant/{tenant_id}/payments', 'UserController@show_payment_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/tenant/{tenant_id}/concerns', 'UserController@show_concern_tenant')->middleware(['auth', 'verified']);
Route::post('/user/{user_id}/tenant/{tenant_id}/concerns', 'UserController@store_concern_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/tenant/{tenant_id}/profile', 'UserController@show_profile_tenant')->middleware(['auth', 'verified']);
Route::put('/user/{user_id}/tenant/{tenant_id}/profile', 'UserController@show_update_tenant')->middleware(['auth', 'verified']);
Route::get('/user/{user_id}/portal', 'UserController@show_portal_tenant')->middleware(['auth', 'verified']);


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


//route for searching investors
Route::get('/owners/{unit_owner_id}', 'OwnerController@search')->middleware(['auth', 'verified']);
Route::put('/units/{unit_id}/owners/{unit_owner_id}', 'OwnerController@update')->middleware(['auth', 'verified']);


//route for users
Route::get('/users/search', 'UserController@search')->middleware(['auth', 'verified']);

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
