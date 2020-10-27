<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit, App\UnitOwner, App\Tenant, DB, App\User, App\Property;
use App\Charts\DashboardChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Billing;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($property_id)
    {
    if(auth()->user()->user_type === 'manager' || auth()->user()->user_type === 'admin' ){

        $units_count = Property::findOrFail($property_id)
        ->units->where('status','<>','deleted')
        ->count();

       $units = Property::findOrFail($property_id)
       ->units()->where('status','<>','deleted')
       ->get()->groupBy(function($item) {
            return $item->floor_no;
        });;

        $buildings = Property::findOrFail($property_id)
        ->units()
        ->where('status','<>','deleted')
        ->select('building', 'status', DB::raw('count(*) as count'))
        ->groupBy('building')
        ->get('building', 'status','count');
    
        $property = Property::findOrFail($property_id);

        return view('webapp.home.home',compact('units','buildings', 'units_count', 'property'));
    }else{
        return view('website.unregistered');
    }
}
    public function show($property_id, $unit_id){
       
        if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager'){

            $users = DB::table('users_properties_relations')
            ->join('users', 'user_id_foreign', 'id')
            ->where('property_id_foreign', $property_id)
            ->get();

            $home = Unit::findOrFail($unit_id);

            $property = Property::findOrFail($property_id);

            $owners = DB::table('units')
            ->join('unit_owners', 'unit_id', 'unit_id_foreign')
            ->where('unit_id', $unit_id)
            ->get();
    

            $tenant_active = Unit::findOrFail($unit_id)
            ->tenants
            ->where('tenant_status', 'active');

            $tenant_inactive = Unit::findOrFail($unit_id)
            ->tenants
            ->where('tenant_status', 'inactive');

            $tenant_reserved = Unit::findOrFail($unit_id)
            ->tenants
            ->where('tenant_status', 'reserved');

            $bills = Billing::leftJoin('payments', 'billings.billing_no', '=', 'payments.payment_billing_no')
           ->join('tenants', 'billing_tenant_id', 'tenant_id')
           ->selectRaw('*, billings.billing_amt - IFNULL(sum(payments.amt_paid),0) as balance')
           ->where('unit_tenant_id', $unit_id)
           ->groupBy('billing_id')
           ->orderBy('billing_no', 'desc')
           ->havingRaw('balance > 0')
           ->get();

            $concerns = DB::table('tenants')
            ->join('units', 'unit_id', 'unit_tenant_id')
            ->join('concerns', 'tenant_id', 'concern_tenant_id')
            ->where('unit_id', $unit_id)
            ->orderBy('date_reported', 'desc')
            ->orderBy('concern_urgency', 'desc')
            ->orderBy('concern_status', 'desc')
            ->get();
            

                // if(Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory'){
                    return view('webapp.home.show-home',compact('users','property','home', 'owners', 'tenant_active', 'tenant_inactive', 'tenant_reserved', 'bills', 'concerns'));
                // }
                // else{
                //     return view('webapp.home.show-unit',compact('unit', 'unit_owner', 'tenant_active', 'tenant_inactive', 'tenant_reservations', 'bills', 'concerns'));
                // }
        }else{
                return view('website.unregistered');
        }
    
    }
}
