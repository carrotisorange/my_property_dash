@extends('layouts.app')

@section('title', 'Rental Bill')

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
            <a class="nav-link" href="/account-payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Account Payables</span></a>
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
  <h1 class="h3 mb-0 text-gray-800">Add Rental Bills</h1>
  <div class="form-group">
      <form id="periodCoveredForm" action="/bills/rent/{{ $updated_billing_start? Carbon\Carbon::parse($updated_billing_start)->format('Y-m-d'): null }}-{{ Carbon\Carbon::parse($updated_billing_end)->format('Y-m-d') }}/" method="POST">
          @csrf
          Period Covered 
          <input form="periodCoveredForm" type="date" name="billing_start" value="{{ Carbon\Carbon::parse($updated_billing_start)->startOfMonth()->format('Y-m-d') }}" required>
          <input form="periodCoveredForm" type="date" name="billing_end" value="{{ Carbon\Carbon::parse($updated_billing_end)->endOfMonth()->format('Y-m-d') }}" required>
          <button form="periodCoveredForm" type="submit" id="addBillsButton" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-check"></i> Save Changes</button>
        </form>
    
  </div>
</div>

<div class="table-responsive text-nowrap">

<form id="add_billings" action="/billings" method="POST">
    {{ csrf_field() }}
</form>
  
  <table class="table table-striped table-bordered">
  <tr>
      <th>#</th>
      <th>Tenant</th>
      <th>Room</th>   
      <th>Description</th>
      <th colspan="2">Period Covered</th>     
      <th>Amount</th>
      <th></th>
 
  </tr>
 <?php
   $ctr = 1;
   $desc_ctr = 1;
   $amt_ctr = 1;
   $id_ctr = 1;
   $billing_start = 1;
   $billing_end = 1;
 ?>   
 @foreach($active_tenants as $item)

 {{-- <input type="hidden" form="add_billings" name="ctr" value="{{ $ctr++ }}" required>      --}}

  <input type="hidden" form="add_billings" name="billing_tenant_id{{ $id_ctr++ }}" value="{{ $item->tenant_id }}" required>

  <input type="hidden" form="add_billings" name="billing_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>

  <tr>
    <td>
      {{ $ctr++ }}
    </td>
    <td>
      <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}</a> 
        @if($item->tenants_note === 'new' )
        <span class="badge badge-success">{{ $item->tenants_note }}</span>
        @endif
    </td>
    <td>
        {{ $item->building.' '.$item->unit_no }}
    </td>
    <td>
        <input class="" type="text" form="add_billings" name="billing_desc{{ $desc_ctr++ }}" value="Rent" required readonly>
    </td>
      {{-- <td>
        @if($item->tenants_note === 'new' )
          <input form="add_billings" type="text" name="details{{ $details_ctr++  }}" value="{{ Carbon\Carbon::parse($item->movein_date)->startOfMonth()->format('M d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('d Y') }} " >
        @else
          <input form="add_billings" type="text"  name="details{{ $details_ctr++  }}" value="{{ Carbon\Carbon::now()->startOfMonth()->format('M d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('d Y') }}" >
        @endif
      </td> --}}
    <td colspan="2">
        @if($item->tenants_note === 'new' )
        <input form="add_billings" type="date" name="billing_start{{ $billing_start++  }}" value="{{ Carbon\Carbon::parse($item->movein_date)->format('Y-m-d') }}" required>
        <input form="add_billings" type="date" name="billing_end{{ $billing_end++  }}" value="{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" required>
        @else
        <input form="add_billings" type="date" name="billing_start{{ $billing_start++  }}" value="{{ Carbon\Carbon::parse($updated_billing_start)->startOfMonth()->format('Y-m-d') }}" required>
        <input form="add_billings" type="date" name="billing_end{{ $billing_end++  }}" value="{{ Carbon\Carbon::parse($updated_billing_end)->endOfMonth()->format('Y-m-d') }}" required>
        @endif
    </td>
    <td>
      <?php 
            $prorated_rent =  Carbon\Carbon::parse($item->movein_date)->DiffInDays(Carbon\Carbon::now()->endOfMonth());
            $prorated_monthly_rent =  ($item->monthly_rent/30) * $prorated_rent;
      ?>
        @if($item->tenants_note === 'new' )
          <input form="add_billings" type="number" name="billing_amt{{ $amt_ctr++ }}" step="0.01"  value="{{ $prorated_monthly_rent }}" oninput="this.value = Math.abs(this.value)" required>
        @else
          <input form="add_billings" type="number" name="billing_amt{{ $amt_ctr++ }}" step="0.01"  value="{{ $item->tenant_monthly_rent }}" oninput="this.value = Math.abs(this.value)" required>
        @endif
    </td>
    <td>
      @if($item->tenants_note === 'new' )
        <span class="badge badge-primary">prorated</span>
      @endif
    </td>
 </tr>
 @endforeach
</table>

</div>
<br>
<p class="text-right">
<a href="/bills" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
<button type="submit" form="add_billings" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Add Bills</button>
</p>
@endsection

@section('scripts')

@endsection



