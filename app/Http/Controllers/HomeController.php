<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit, App\UnitOwner, App\Tenant, DB, App\User;
use App\Charts\DashboardChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    }
}
