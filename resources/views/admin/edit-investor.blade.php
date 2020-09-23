@extends('layouts.app')

@section('title', $investor->unit_owner.' | Edit')

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
      
        @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'treasury' && (Auth::user()->property_ownership === 'Multiple Owners'))
        <!-- Nav Item - Tables -->
        <li class="nav-item active">
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
            <li class="nav-item">
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
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/units/{{ $unit->unit_id}}">{{ $unit->building.' '.$unit->unit_no }}</a></li>
  <li class="breadcrumb-item">Owner </li>
</ol>

<!-- 404 Error Text -->
<form id="editInvestorForm" action="/units/{{ $unit->unit_id }}/owners/{{ $investor->unit_owner_id }}" method="POST">
    @method('put')
    {{ csrf_field() }}
</form>
            <div class="form-group row">
                <div class="col">
                    <small>Name</small>
                    <input form="editInvestorForm" class="form-control" type="text" name="unit_owner" value="{{ $investor->unit_owner }}" >
                </div>
               
              <div class="col">
                <small>Email</small>
                <input form="editInvestorForm" class="form-control" type="text" name="investor_contact_no" value="{{ $investor->investor_contact_no }}" >
            </div>
            <div class="col">
              <small>Mobile</small>
              <input form="editInvestorForm" class="form-control" type="text" name="investor_email_address" value="{{ $investor->investor_email_address }}" >
          </div>  
               
            </div>

            <div class="form-group row">
              
          <div class="col">
            <small>Address</small>
            <input form="editInvestorForm" class="form-control" type="text" name="investor_address" value="{{ $investor->investor_address }}" >
        </div>  
             
          </div>

          <div class="form-group row">
              
            <div class="col">
              <small>Authorized Representative</small>
              <input form="editInvestorForm" class="form-control" type="text" name="investor_representative" value="{{ $investor->investor_representative }}" >
          </div>  
               
            </div>
            <hr>

            <div class="form-group row">
              
              <div class="col">
                <small>Date Accepted</small>
                <input form="editInvestorForm" class="form-control" type="date" name="date_accepted" value="{{ $unit->date_accepted }}" >
            </div>  
            
             <div class="col">
                <small>Purchase Amount</small>
                <input form="editInvestorForm" class="form-control" type="number" min="1" step="0.01" name="investment_price" value="{{ $investor->investment_price }}" >
            </div>  

            <div class="col">
              <small>Payment Option</small>
              <select name="investment_type" id=""  form="editInvestorForm" class="form-control" >
                  <option value="{{ $investor->investment_type }}">{{ $investor->investment_type }}</option>
                  <option value="Full Cash">Full Cash</option>
                  <option value="Full Downpayment">Full Downpayment</option>
                  <option value="Installment">Installment</option>
              </select>
          </div>  
                 
              </div>
     
           
  


<p class="text-right">   
    <a href="/units/{{ $unit->unit_id}}/owners/{{ $investor->unit_owner_id }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
    <button type="submit" form="editInvestorForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Update Owner</button>
</p>
@endsection

@section('scripts')

@endsection



