@extends('layouts.sm-2.template')

@section('title', 'Electric Bill')

@section('sidebar')
      <!-- Nav Item - Dashboard -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/board">
            <div class="sidebar-brand-icon">
               <i class="fab fa-product-hunt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ Auth::user()->property }}<sup></sup></div>
          </a>
      
          <!-- Divider -->
          <hr class="sidebar-divider my-0">
      
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
  <a href="/bills"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Bills</a>
  <h1 class="h3 mb-0 text-gray-800">Electric Bills</h1>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <form id="periodCoveredForm" action="/bills/electric/{{ Carbon\Carbon::parse($updated_billing_start)->format('Y-m-d') }}-{{ Carbon\Carbon::parse($updated_billing_end)->format('Y-m-d') }}/" method="POST">
        @csrf
        Period Covered 
        <input form="periodCoveredForm" type="date" name="billing_start" value="{{ Carbon\Carbon::parse($updated_billing_start)->startOfMonth()->format('Y-m-d') }}" required>
        <input form="periodCoveredForm" type="date" name="billing_end" value="{{ Carbon\Carbon::parse($updated_billing_end)->endOfMonth()->format('Y-m-d') }}" required>
        Current Electric Rate/KwH <input form="periodCoveredForm" type="number" name="electric_rate_kwh" id="electric_rate_kwh" step="0.001" value="{{ $electric_rate_kwh? $electric_rate_kwh : Auth::user()->electric_rate_kwh }}" required oninput="autoCompute()">
        <button form="periodCoveredForm" type="submit" id="addBillsButton" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-check"></i> Save Changes</button>
      </form>
      
    </div>
  </div>
</div>
<!-- 404 Error Text -->
<div class="table-responsive text-nowrap">
<form id="add_billings" action="/billings" method="POST">
 @csrf
  </form>
  <table class="table table-striped">
  <tr>
    
      <th>#</th>
      <th colspan="2">Period Covered</th>
      <th>Tenant</th>
      <th>Room</th>
       <th>Description</th> 
     
      <th>Previous Reading</th>
      <th>Current Reading</th>
      <th>Current Consumption</th>
      <th>Amount</th>
      
  </tr>
 <?php
  $ctr = 1;
   $billing_no_ctr = 1;
   $desc_ctr = 1;
   $amt_ctr = 1;
   $id_ctr = 1;
   $details_ctr = 1;
   $billing_start = 1;
   $billing_end = 1;
   $previous_reading = 1;
   $current_reading = 1;
   $consumption = 1;
   $id_previous_reading = 1;
   $id_current_reading = 1;
   $id_consumption = 1;
   $ctr_previous_reading = 1;
   $ctr_current_reading = 1;
   $ctr_consumption = 1;
   $id_amt = 1;
 ?>
 @foreach($active_tenants as $item)
 
    
  <input type="hidden" form="add_billings" name="billing_tenant_id{{ $id_ctr++ }}" value="{{ $item->tenant_id }}">

  <input type="hidden" form="add_billings" name="billing_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>

  <tr>
    <td>{{ $ctr++ }}</td>
    <td colspan="2">
      <input form="add_billings" type="date" name="billing_start{{ $billing_start++  }}" value="{{ Carbon\Carbon::parse($updated_billing_start)->startOfMonth()->format('Y-m-d') }}" required>
      <input form="add_billings" type="date" name="billing_end{{ $billing_end++  }}" value="{{ Carbon\Carbon::parse($updated_billing_end)->endOfMonth()->format('Y-m-d') }}" required>
  </td>
      <td>
      <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a> 
        @if($item->tenants_note === 'new' )
        <span class="badge badge-success">{{ $item->tenants_note }}</span>
        @endif
      
      <td>{{ $item->building.' '.$item->unit_no }}</td>
      <td>
        <input class="" type="text" form="add_billings" name="billing_desc{{ $desc_ctr++ }}" value="Electricity" readonly>
      </td>
     
    <td>
      <input class="" type="number" form="add_billings" step="0.001" name="previous_reading{{ $previous_reading++ }}" id="id_previous_reading{{ $id_previous_reading++ }}" value={{ $item->previous_electric_reading }}>
    </td>
    <td>
      <input class="" type="number" form="add_billings"step="0.001"  name="current_reading{{ $current_reading++ }}" id="id_current_reading{{ $id_current_reading++ }}" oninput="autoCompute({{ $ctr_current_reading++ }})" value={{ $item->previous_electric_reading }}>
    </td>
    <td>
      <input class="" type="number" form="add_billings" step="0.001" name="consumption{{ $consumption++ }}" id="id_consumption{{ $id_consumption++ }}"  value="0" required readonly>
    </td>
      <td>
          <input form="add_billings" type="number" step="0.001" name="billing_amt{{ $amt_ctr++ }}" id="id_amt{{ $id_amt++ }}" value="0" required readonly>
      </td>
     
 </tr>
 @endforeach
</table>
</div>
<br>
<p class="text-right">
  <a href="/bills" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times"></i> Cancel</a>
  <button type="submit" form="add_billings" id="addBillsButton" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  onclick="return confirm('Are you sure you want to perform this action?');"><i class="fas fa-check"></i> Add Bills</button>
</p>



@endsection

@section('scripts')
<script>
  function autoCompute(val) {
    var previous_reading = 'id_previous_reading'+val;
    var current_reading = 'id_current_reading'+val;
    var consumption = 'id_consumption'+val;
    var amt = 'id_amt'+val;

    var electric_rate_kwh = parseFloat(document.getElementById('electric_rate_kwh').value);

    var actual_consumption = document.getElementById(current_reading).value - document.getElementById(previous_reading).value;
    
    document.getElementById(consumption).value = parseFloat(actual_consumption,2);
    document.getElementById(amt).value = parseFloat(actual_consumption) * electric_rate_kwh;
   
  }
</script>
@endsection



