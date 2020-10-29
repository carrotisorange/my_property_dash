<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, App\User, Carbon\Carbon, Auth, Session;
use Illuminate\Support\Facades\Hash;

use App\Mail\TenantRegisteredMail;
use Illuminate\Support\Facades\Mail;
use App\Property;
use App\Charts\DashboardChart;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property_id)
    {
        
    $properties = User::where('user_type', 'manager')
    ->leftJoin('units', 'property','unit_property')
    ->select('*','users.created_at as created_at')
   ->selectRaw("count(case when units.status = 'reserved' then 1 end) as reserved_units")
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
    ->get();

    $unverified_users = DB::table('users')
    ->whereNull('email_verified_at')
    ->orderBy('users.created_at', 'desc')
    ->get();


    $signup_rate_1 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(11)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_2 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(10)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_3 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(9)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_4 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(8)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_5 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(7)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_6 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(6)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_7 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(5)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_8 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(4)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_9 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(3)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_10 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(2)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

    $signup_rate_11 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(1)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(1)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();

     $signup_rate_12 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNull('email_verified_at')
    ->count();


    $verified_users_1 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(11)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(11)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')

    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_2 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(10)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(10)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_3 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(9)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(9)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_4 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(8)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(8)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_5 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(7)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(7)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_6 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(6)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(6)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_7 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(5)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(5)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_8 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(4)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(4)->endOfMonth())

    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_9 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(3)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(3)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_10 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(2)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(2)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $verified_users_11 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->subMonths(1)->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->subMonths(1)->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

     $verified_users_12 = DB::table('users')
    ->where('email_verified_at', '>=', Carbon::now()->firstOfMonth())
    ->where('email_verified_at', '<=', Carbon::now()->endOfMonth())
    ->where('email', '!=','thepropertymanager2020@gmail.com')
    ->where('user_type', 'manager')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->count();

    $signup_rate = new DashboardChart;

    $signup_rate->barwidth(4.0);
    $signup_rate->displaylegend(true);
    $signup_rate->labels([Carbon::now()->subMonth(11)->format('M Y'),Carbon::now()->subMonth(10)->format('M Y'),Carbon::now()->subMonth(9)->format('M Y'),Carbon::now()->subMonth(8)->format('M Y'),Carbon::now()->subMonth(7)->format('M Y'),Carbon::now()->subMonth(6)->format('M Y'),Carbon::now()->subMonth(5)->format('M Y'),Carbon::now()->subMonth(4)->format('M Y'),Carbon::now()->subMonth(3)->format('M Y'),Carbon::now()->subMonths(2)->format('M Y'),Carbon::now()->subMonth()->format('M Y'),Carbon::now()->format('M Y')]);
    $signup_rate->dataset
                            (
                                'Sign Ups', 'line',
                                                                [
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
->color("#0000FF")
->fill(false)
->backgroundcolor("#0000FF");

    $signup_rate->dataset
                            (
                                'Active Users', 'line',
                                                                [

                                                                    $verified_users_1,
                                                                    $verified_users_2,
                                                                    $verified_users_3,
                                                                    $verified_users_4,
                                                                    $verified_users_5,
                                                                    $verified_users_6,
                                                                    $verified_users_7,
                                                                    $verified_users_8,
                                                                    $verified_users_9,
                                                                    $verified_users_10,
                                                                    $verified_users_11,
                                                                    $verified_users_12,

                                                                ],

                                )

    ->color("#008000")
    ->backgroundcolor("#008000")
    ->fill(false)
    ->linetension(0.4);

    $active_users = DB::table('users')
    ->orderBy('user_current_status', 'desc')
    ->orderBy('last_login_at', 'desc')
    ->whereNotNull('account_type')
    ->whereNotNull('email_verified_at')
    ->where('email', '!=','thepropertymanager2020@gmail.com')

    ->get();

    $users = DB::table('users')
    ->orderBy('user_current_status', 'desc')
    ->orderBy('last_login_at', 'desc')
    ->whereNotNull('account_type')
    ->where('property', Auth::user()->property)
    ->get();


    

        if(Auth::user()->email === 'thepropertymanager2020@gmail.com' || Auth::user()->email === 'tecson.pamela@gmail.com'){

            $users = DB::table('users')
            ->orderBy('user_current_status', 'desc')
            ->get();

            $sessions = DB::table('users')
            ->join('sessions', 'id', 'session_user_id')
            ->join('properties', 'id', 'user_id_property')
            ->select('*', 'properties.name as property_name', 'users.name as user_name')

            ->whereDay('session_last_login_at', now()->day)
            ->get();
            
            $property = Property::findOrFail($property_id);

            return view('webapp.users.users', compact('users', 'sessions', 'paying_users', 'unverified_users', 'properties','signup_rate','active_users', 'users', 'property'));

        }else{

            if(Auth::user()->user_type === 'manager'){
                $users = User::findOrFail(Auth::user()->id)->users;
            }else{
                $users = DB::table('users')
                ->where('lower_access_user_id', Auth::user()->id)
   
                ->get();
            }
           
            $sessions = DB::table('users')
            ->join('sessions', 'id', 'session_user_id')
            ->join('properties', 'id', 'user_id_property')
            ->select('*', 'properties.name as property_name', 'users.name as user_name')
            ->where('id', Auth::user()->id)
            ->orWhere('lower_access_user_id', Auth::user()->id )
            ->whereDay('session_last_login_at', now()->day)
            ->get();

            $property = Property::findOrFail($property_id);


        return view('webapp.users.users', compact('users', 'sessions', 'paying_users', 'unverified_users', 'properties','signup_rate','active_users', 'users', 'property'));

   
    }
}

    public function search(Request $request){
        $search = $request->get('search');

        $request->session()->put('search_user', $search);

        $users = DB::table('users')
        ->whereRaw("name like '%$search%' ")
        ->get();

        return view('webapp.users.users', compact('users'));
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

    public function create_system_user($property_id){
        
            // return back()->with('danger', 'Exceeded your limit for adding users. Upgrade to Pro to add more users.');
            $property = Property::findOrFail($property_id);
            return view('webapp.users.system-users.create', compact('property'));

    }

    public function index_system_user($property_id){
       
        //  $users = DB::table('users_properties_relations')
        // ->join('users', 'user_id_foreign', 'id')
        // ->where('property_id_foreign', $property_id)
        // ->orWhere('lower_access_user_id', Auth::user()->id)
        // ->get();

        $users = User::findOrFail(Auth::user()->id)->users;

        $property = Property::findOrFail($property_id);

        return view('webapp.users.system-users.index', compact('users', 'property'));
    }

    public function show_system_user($property_id, $user_id){
        
        $user = User::findOrFail($user_id);

        $property = Property::findOrFail($property_id);
        
        return view('webapp.users.system-users.show', compact('user', 'property'));
    }

    public function store_system_user(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

      $user_id =  DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'property' => '',
            'property_type' => '',
            'property_ownership' => '',
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'account_type' => Auth::user()->account_type,
            'lower_access_user_id' => Auth::user()->id,
            'trial_ends_at' => Auth::user()->trial_ends_at,
        ]);

        DB::table('users_properties_relations')
        ->insert([
            'property_id_foreign' => $request->property_id,
            'user_id_foreign' => $user_id,
        ]);

        return redirect('/property/'.$request->property_id.'/system-user/'.$user_id)->with('success', 'New user has been saved!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'property' => Auth::user()->property,
            'property_type' => Auth::user()->property_type,
            'property_ownership' => Auth::user()->property_ownership,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'account_type' => Auth::user()->account_type,
        ]);

        return redirect('/users')->with('success', 'New user has been saved!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($property_id, $user_id)
    {
        $user = User::findOrFail($user_id);

         $properties = User::findOrFail($user_id)->properties;

        $manager = User::findOrFail(Auth::user()->id);

        $sessions = DB::table('sessions')->where('session_user_id', $user_id)->get();

        $blogs = DB::table('users')
        ->join('blogs', 'users.id','user_id_foreign')
        ->select('*', 'blogs.created_at as created_at')
        ->orderBy('blogs.id', 'desc')
        ->where('user_id_foreign', Auth::user()->id)
        ->get();

        $property = Property::findOrFail($property_id);

         if(($user->id === Auth::user()->id) || ($manager->user_type === 'manager' && $user->property === $manager->property) || Auth::user()->email === 'thepropertymanager2020@gmail.com'){
            return view('webapp.users.show-user', compact('properties','property','user', 'sessions', 'blogs'));
         }else{
             return view('website.unregistered');
         }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        $manager = User::findOrFail(Auth::user()->id);

        if(($user->id === Auth::user()->id) || ($manager->user_type === 'manager' && $user->property === $manager->property)){

            return view('webapp.users.edit-user', compact('user'));
        }
        else{
            return view('website.unregistered');
        }

       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $property_id, $user_id)
    {

        if($request->password === null){


            DB::table('users')
            ->where('id', $user_id)
            ->update(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                      
                    ]
                );

                return back()->with('success', 'changes have been saved!');
        }else{
            DB::table('users')
            ->where('id', $user_id)
            ->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]
                );
            
                if(Auth::user()->user_type != 'manager'){
                    Auth::logout();
                    return redirect('/login')->with('success', 'New password has been saved!');
                }else{
                    return back()->with('success', 'New password has been saved!');
                }
            
          
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::table('users')->where('id', $id)->delete();
      return redirect('/users')->with('success', 'user has been deleted!');
    }

    public function show_user_tenant(){

        $tenant = DB::table('tenants')
        ->where('user_id_foreign', Auth::user()->id)
        ->get();

        return view('webapp.tenant_access.index', compact('tenant'));
    }
}


