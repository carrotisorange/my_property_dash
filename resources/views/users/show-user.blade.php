@extends('layouts.app')

@section('title', $user->name)

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
 
<div class="col-lg-12 mb-4">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
     <h6 class="m-0 font-weight-bold text-primary">PROFILE </h6>
      <div class="dropdown no-arrow">
      <a title="edit profile" href="/users/{{ $user->id }}/edit">
        <i class="fas fa-user-edit fa-fw text-gray-400"></i>
        </a>
      <form action="/users/{{ $user->id }}" method="POST">
        @csrf
        @method('DELETE')
        <a title="edit profile" href="/users/{{ $user->id }}">
          <i class="fas fa-user-times fa-fw text-gray-400"></i>
          </a>
      </form>
        
      </div>
      
      <!-- end -->
    
   </div>
   <div class="card-body">
    <div class="row">
      <div class="col">
        <small>Name</small>
        <p>{{ $user->name }}</p>
       
      </div>
    </div>
    
    <div class="row">
      <div class="col">
        <small>Email</small>
        <p>{{ $user->email }}</p>
       
      </div>
    </div>
  
    <div class="row">
      <div class="col">
        <small>User Type</small>
        <p>{{ $user->user_type }}</p>
       
      </div>
    </div>
  
  <hr>
    <div class="row">
      <div class="col">
        <small>Plan</small>
       <p>{{ $user->account_type }}</p>
       
      </div>
    </div>
    
    <div class="row">
      <div class="col">
        <small>Property</small>
        <p>{{ $user->property }}</p>
       
      </div>
    </div>

    <div class="row">
      <div class="col">
        <small>Property Type</small>
       <p>{{ $user->property_type }}</p>
       
      </div>
    </div>

    <div class="row">
      <div class="col">
        <small>Property Ownership</small>
        <p>{{ $user->property_ownership }}</p>
       
      </div>
    </div>



    

   </div>
 </div>

     </div>
  <!-- Page Heading -->

  <div class="col-lg-12 mb-4">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
       <h6 class="m-0 font-weight-bold text-primary">ACTIVITIES </h6>
        <div class="dropdown no-arrow">
        {{-- <a title="edit profile" href="/users/{{ $user->id }}/edit">
          <i class="fas fa-user-edit fa-fw text-gray-400"></i>
          </a> --}}
        </div>
        <!-- end -->
      
     </div>
     <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <tr>
            
              <th>IP ADDRESS</th>
              <th>LOGIN AT</th>
              <th>LOGOUT AT</th>
            </tr>
            @foreach ($sessions as $item)
              <tr>
               
                <td>{{ $item->session_last_login_ip }}</td>
               <td>{{ $item->session_last_login_at? Carbon\Carbon::parse($item->session_last_login_at)->format('M d Y').' '.Carbon\Carbon::parse($item->session_last_login_at)->toTimeString() : null }}</td>
                
               <td>{{ $item->session_last_logout_at? Carbon\Carbon::parse($item->session_last_logout_at)->format('M d Y').' '.Carbon\Carbon::parse($item->session_last_logout_at)->toTimeString() : null }}</td>
       
              </tr>
            @endforeach
          </table>
        </div>
     </div>
   </div>

       </div>

@endsection

@section('scripts')

@endsection



