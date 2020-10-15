@extends('layouts.sm-2.template')

@section('title', 'Bills')

@section('sidebar')
   
      
           <!-- Heading -->
      
          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
                <a class="nav-link" href="/board">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
              </li>
      
            <hr class="sidebar-divider">
      
            <div class="sidebar-heading">
              Interface
            </div>  
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
          <li class="nav-item">
            <a class="nav-link" href="/home">
              <i class="fas fa-home"></i>
              <span>Home</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/calendar">
              <i class="fas fa-calendar-alt"></i>
              <span>Calendar</span></a>
          </li>
          @endif
        
          @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
            <li class="nav-item">
              <a class="nav-link" href="/tenants">
                <i class="fas fa-users fa-chart-area"></i>
                <span>Tenants</span></a>
            </li>
            @endif
      
       @if((Auth::user()->user_type === 'admin' && Auth::user()->property_ownership === 'Multiple Owners') || (Auth::user()->user_type === 'manager' && Auth::user()->property_ownership === 'Multiple Owners'))
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/owners">
            <i class="fas fa-user-tie"></i>
            <span>Owners</span></a>
        </li>
         @endif
      
         @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/concerns">
          <i class="far fa-comment-dots"></i>
              <span>Concerns</span></a>
        </li>
        @endif
    
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
        <li class="nav-item">
            <a class="nav-link" href="/job-orders">
              <i class="fas fa-tools fa-table"></i>
              <span>Job Orders</span></a>
        </li>
        @endif
      
             <!-- Nav Item - Tables -->
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
          <li class="nav-item">
            <a class="nav-link collapsed" href="/personnels" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-user-cog"></i>
                <span>Personnels</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="/housekeeping">Housekeeping</a>
                  <a class="collapse-item" href="/maintenance">Maintenance</a>
                </div>
              </div>
            </li>
        @endif
      
           @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <!-- Nav Item - Tables -->
            <li class="nav-item active">
              <a class="nav-link" href="/bills">
                <i class="fas fa-file-invoice-dollar fa-table"></i>
                <span>Bills</span></a>
            </li>
           @endif
      
           @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
              <li class="nav-item">
              <a class="nav-link" href="/collections">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Collections</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/financials">
                <i class="fas fa-coins"></i>
                <span>Financials</span></a>
            </li>
            @endif
      
               @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
            <a class="nav-link" href="/payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Payables</span></a>
          </li>
          @endif
      
          @if(Auth::user()->user_type === 'manager')
           <!-- Nav Item - Tables -->
           <li class="nav-item">
            <a class="nav-link" href="/users">
              <i class="fas fa-user-circle"></i>
              <span>Users</span></a>
          </li>
          @endif
          
          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">
      
          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
    
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Bills </h1>
  <div class="dropdown show">
    <br>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <button type="submit" form="billingRentForm" class="dropdown-item "> Rent</button>
      <input type="hidden" form="billingRentForm" name="billing_option" value="rent">
      <button type="submit" form="billingElectricForm" class="dropdown-item"> Electric</button>
      <input type="hidden" form="billingElectricForm" name="billing_option" value="electric">
      <button type="submit" form="billingWaterForm" class="dropdown-item "> Water</button>
      <input type="hidden" form="billingWaterForm" name="billing_option" value="water">
      <button type="submit" form="billingSurchargeForm" class="dropdown-item ">Surcharge</button>
      <input type="hidden" form="billingSurchargeForm" name="billing_option" value="surcharge">

    <form id="billingRentForm" action="/bills/rent/{{ Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" method="POST">
      @csrf
    </form>
    <form id="billingElectricForm" action=" /bills/electric/{{ Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" method="POST">
        @csrf
    </form>
    <form id="billingWaterForm" action=" /bills/water/{{ Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" method="POST">
        @csrf
    </form>
    <form id="billingSurchargeForm" action="/tenants/billings" method="POST">
        @csrf
    </form>
    </div>
  </div>
</div>
<!-- 404 Error Text -->
<div class="table-responsive text-nowrap">
<table class="table table-bordered">
  @foreach ($bills as $day => $bill)
    <tr>
        <th colspan="12">{{ Carbon\Carbon::parse($day)->addDay()->format('M d Y') }}, TENANTS BILLED: ({{ $bill->count() }}) , TOTAL AMOUNT BILLED: ({{ number_format($bill->sum('billing_amt'),2) }})</th>
    </tr>
    <tr>
      
      <th>Bill No</th>
      
      
      <th>Tenant</th>
      <th>Room</th>
      <th>Description</th>
     
      <th colspan="2">Period Covered</th>
      <th>Amount</th>
   
      <td></td>
        </tr>
  </tr>
    @foreach ($bill as $item)
    <tr>
     
      <td>{{ $item->billing_no }}</th>  
      {{-- <td>  {{ Carbon\Carbon::parse($item->billing_date)->format('M d Y') }}</td> --}}
     
      
      <td>
        @if(Auth::user()->user_type === 'billing')
        <a href="units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a>
        @else
          <a href="units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}">{{ $item->first_name.' '.$item->last_name }}</a>
        @endif
      </td>
      <td>{{ $item->building.' '.$item->unit_no }}</td>
      <td>{{ $item->billing_desc }}</td>
     
      <td colspan="2">
        {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
        {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
      </td>
      <td><a href="units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ number_format($item->billing_amt,2) }}</a></td>
   
        <td>
          @if(Auth::user()->user_type === 'manager')
          <form action="tenants/{{ $item->billing_tenant_id }}/billings/{{ $item->billing_id }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
          </form>
          @endif
        </td>
      </tr>
    @endforeach
        
      
  @endforeach
</table>
</div>
@endsection

@section('scripts')

@endsection



