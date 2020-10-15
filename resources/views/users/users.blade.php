@extends('layouts.sm-2.template')

@section('title', 'Users')

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
            <a class="nav-link" href="/payables">
            <i class="fas fa-hand-holding-usd"></i>
              <span>Payables</span></a>
          </li>
          @endif
      
          @if(Auth::user()->user_type === 'manager')
           <!-- Nav Item - Tables -->
           <li class="nav-item active">
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
  <h1 class="h3 mb-0 text-gray-800">Users</h1>
  @if(Auth::user()->email === 'thepropertymanager2020@gmail.com' || Auth::user()->email !== 'Free')
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="collapse" href="#addUserModal" role="button" aria-expanded="false" aria-controls=""> <i class="fas fa-user-plus  fa-sm text-white-50"></i> Add</a> 
  @else
    <a title="Your plan can't add another user." class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="collapse" href="#/" role="button" aria-expanded="false" aria-controls=""> <i class="fas fa-user-plus  fa-sm text-white-50"></i> Add</a> 
  @endif
</div>

<div class="row">
    <div class="col">
      <div class="collapse multi-collapse" id="addUserModal">
        <div class="card card-body">
            <form id="addUserForm" action="/users" method="POST">
                {{ csrf_field() }}
            </form>
            <div class="row">
                <div class="col">
                    <small>Name</small>
                    <input form="addUserForm"  id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Full Name" required>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                    <small>Email</small>
                    <input form="addUserForm"  id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email" required>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>
                <div class="col">
                   <small>Role</small>
                    <select class="form-control" form="addUserForm" name="user_type" required>
                        <option value="">Please select one</option>
                        <option value="admin">admin</option>
                        <option value="ap">ap</option>
                        <option value="billing">billing</option>
                        <option value="manager">manager</option>
                        <option value="treasury">treasury</option>
                        
                    </select>
                </div>
                <div class="col">
                  <small>Password</small>
                    <input form="addUserForm" type="password" class="form-control" name="password" required>
              </div>
               
            </div>
            <br>
            <button form="addUserForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;">
               Register
      </button>
            

        </div>
      </div>
    </div>
</div>
<br>
<h4>Logins ({{ $sessions->count() }})</h4>
<div class="table-responsive text-nowrap">
  <table class="table table-bordered" >
    <?php $ctr=1; ?>
    <thead>
      <tr>
       <th>#</th>
       <th>User</th>
       <th>Email</th>
       <th>Role</th>
       <th>Property</th>
       <th>Login at</th>
       <th>Status</th>
    </tr>
    </thead>
    <tbody>
     @foreach ($sessions as $item)
     <tr>
      <th>{{ $ctr++ }}</th>
       <td><a href="/users/{{ $item->id }}">{{ $item->name }}</a></td>
       <td>{{ $item->email }}</td>
       <td>{{ $item->user_type }}</td>
       <td>{{ $item->property }}</td>
       <td>{{ Carbon\Carbon::parse($item->session_last_login_at)->toTimeString() }}</td>
       <?php  
                                     $diffInMinutes = Carbon\Carbon::parse($item->session_last_logout_at)->diffInMinutes();
                                     $diffInHours = Carbon\Carbon::parse($item->session_last_logout_at)->diffInHours();
                                     $diffInDays = Carbon\Carbon::parse($item->session_last_logout_at)->diffInDays()
                                  ?>
                                  <td>
                                     @if($item->user_current_status === 'online')
                                    <span class="badge badge-success"> {{ $item->user_current_status }}</span>
                                    @else
                                     @if($diffInMinutes < 60)
                                     <span class="badge badge-secondary"> {{ $diffInMinutes }} minutes ago</span> 
                                       @elseif($diffInHours > 24)
                                       <span class="badge badge-secondary"> {{ $diffInDays }} days ago</span>
                                       @else
                                       <span class="badge badge-secondary">  {{ $diffInHours }} hours ago</span>
                                       @endif
                                    @endif
                                   </td> 
     </tr>
     @endforeach
    </tbody>
  </table>
 
</div>
<br>
<h4>Users ({{ $users->count() }})</h4>
<div class="table-responsive text-nowrap">
  <table class="table table-bordered" >
    <?php $ctr=1; ?>
    <thead>
      <tr>
       <th>#</th>
       <th>User</th>
       <th>Email</th>
       <th>Role</th>
       <th>Created at</th>
       <th>Verified at</th>
     
  
   
    </tr>
    </thead>
    <tbody>
     @foreach ($users as $item)
     <tr>
      <th>{{ $ctr++ }}</th>
       <td><a href="/users/{{ $item->id }}">{{ $item->name }}</a></td>
       <td>{{ $item->email }}</td>
       <td>{{ $item->user_type }}</td>
        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y').' '.Carbon\Carbon::parse($item->created_at)->toTimeString() }}</td>
        <td>{{ Carbon\Carbon::parse($item->email_verified_at)->format('M d Y').' '.Carbon\Carbon::parse($item->email_verified_at)->toTimeString() }}</td>
     
       
     @endforeach
    </tbody>
  </table>
 
</div>
@if(Auth::user()->email === 'thepropertymanager2020@gmail.com' || Auth::user()->email === 'tecson.pamela@gmail.com')

<br>
<div class="row">


  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-primary" href="#/">  PROPERTIES</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $properties->count() }}</div>
            {{-- <small>PENDING ({{ $pending_tenants->count() }})</small> --}}
            
          </div>
          <div class="col-auto">
            <i class="fas fa-home fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a class="text-info" href="#/"> ACTIVE USERS</a> </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_users->count() }}</div>
            {{-- <small>|</small> --}}
            
          </div>
          <div class="col-auto">
            <i class="fas fa-user-check fa-2x text-gray-300"></i>
          
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="text-success"  href="#/">  PAYING USERS</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $paying_users->count() }}</div>
{{--                            
            <small>PENDING ({{ $pending_concerns->count() }})</small> --}}
          </div>
          <div class="col-auto">
            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a class="text-warning"  href="#/">  UNVERFIFIED USERS</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unverified_users->count() }}</div>
{{--                            
            <small>PENDING ({{ $pending_concerns->count() }})</small> --}}
          </div>
          <div class="col-auto">
            <i class="fas fa-user-clock fa-2x text-gray-300"></i>
      
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="row">
  <!-- Area Chart -->
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">SIGN UP RATE</h6>
        
      </div>
      <!-- Card Body -->
      <div class="card-body">
       
          {!! $signup_rate->container() !!}
        
      </div>
    </div>
  </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-properties-tab" data-toggle="tab" href="#properties" role="tab" aria-controls="nav-properties" aria-selected="true"><i class="fas fa-building fa-sm text-primary-50"></i> Properties <span class="badge badge-primary">{{ $properties->count() }}</span></a>
                  <a class="nav-item nav-link" id="nav-active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="nav-active" aria-selected="false"><i class="fas fa-user-check fa-sm text-primary-50"></i> Active Users <span class="badge badge-primary">{{ $active_users->count() }}</span></a>
                  <a class="nav-item nav-link" id="nav-unverified-tab" data-toggle="tab" href="#unverified" role="tab" aria-controls="nav-unverified" aria-selected="false"><i class="fas fa-user-times fa-sm text-primary-50"></i> Unverified Users <span class="badge badge-primary">{{ $unverified_users->count() }}</span> </a>
                </div>
              </nav>
            </div>
          </div>
       
            <div class="tab-content" id="nav-tabContent">
       
              <div class="tab-pane fade show active" id="properties" role="tabpanel" aria-labelledby="nav-properties-tab">
                <br>
                  <div class="col-md-11 mx-auto">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-bordered" >
                        <?php $ctr=1; ?>
                        <thead>
                          <tr>
                            <th>#</th>
                           <th>Property</th>
                           <th>No of Rooms</th>
                           <th>Occupancy Rate</th>
                           <th>Manager</th>
                           <th>Email</th>
                         
                          
                           <th>Plan</th>
                           <th>Created At</th>
                           <th>Email Verified At</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                         @foreach ($properties as $item)
                             <tr>
                              <th>{{ $ctr++ }}</th>
                               <td>
                                 {{ $item->property }}
                                 {{ $item->property_type }} with
                                 {{ $item->property_ownership }}
                               </td>
                               <?php $count_units = $item->reserved_units + $item->occupied_units + $item->vacant_units ?>
                               <td>{{ $count_units }}
                               </td>
                               <td>
                                 
                                 {{ number_format(( $count_units  == 0 ? 0 : $item->occupied_units/$count_units) * 100, 2) }}%
                                 ({{ $item->occupied_units.'/'.$count_units }})
                               </td>
                               <td>
                                 @if($item->user_type==='manager')
                                 <a href="/users/{{ $item->id }}">{{ $item->name }}</a>
                                 @endif
                               </td>
                               <td>{{ $item->email }}</td>
                              
                             
                             <td>{{ $item->account_type }}</td>
                             <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y').' '.Carbon\Carbon::parse($item->created_at)->toTimeString() }}</td>
                               <td>{{ Carbon\Carbon::parse($item->email_verified_at)->format('M d Y').' '.Carbon\Carbon::parse($item->email_verified_at)->toTimeString() }}</td>
                             </tr>
                         @endforeach
                        </tbody>
                      </table>
                     
                    </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="unverified" role="tabpanel" aria-labelledby="nav-unverified-tab">
               <br>
               <div class="col-md-11 mx-auto">
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered" >
                    <?php $ctr=1; ?>
                    <thead>
                      <tr>
                        <th>#</th>
                       <th>User</th>
                       <th>Property</th>
                       <th>Role</th>
                       
                       <th>Created at</th>
                      
                      
                    </tr>
                    </thead>
                    <tbody>
                     @foreach ($unverified_users as $item)
                         <tr>
                           <th>{{ $ctr++ }}</th>
                           <td>
                            
                             <a href="/users/{{ $item->id }}">{{ $item->name }}</a>
                             
                           </td>
                           <td>
                             {{ $item->property }}
                           </td>
                           <td>{{ $item->user_type }}</td>
                     
                          
                          
                          
                           <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y').' '.Carbon\Carbon::parse($item->created_at)->toTimeString() }}</td>
                     
                     
                         </tr>
                     @endforeach
                    </tbody>
                  </table>
                 
                </div>
               </div>
              </div>
              <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="nav-active-tab">
                <br>
                <div class="col-md-11 mx-auto">
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered">
                    <?php $ctr=1; ?>
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>User</th>
                          <th>Created at</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Property</th>
                          <th>Type</th>
                          <th>Ownership</th>
                          <th>Email Verified At</th>
                          <th>Trial Ends At</th>
                          <th>Plan</th>
                          <th>Last Login IP</th>
                          <th>Last Login At</th>
                          <th>Last Logout At</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $item)
                     <tr>
                      <th>{{ $ctr++ }}</th>
                         <td><a href="/users/{{ $item->id }}">{{ $item->name }}</a></td>
                         <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y').' '.Carbon\Carbon::parse($item->created_at)->toTimeString() }}</td>
                         <td>{{ $item->email }}</td>
                         <td>{{ $item->user_type }}</td>
                         <td>{{ $item->property }}</td>
                         <td>{{ $item->property_type }}</td>
                        
                         <td>{{ $item->property_ownership }}</td>
                        
                         <td>{{ Carbon\Carbon::parse($item->email_verified_at)->format('M d Y').' '.Carbon\Carbon::parse($item->email_verified_at)->toTimeString() }}</td>
                         <td>{{ Carbon\Carbon::parse($item->trial_ends_at)->format('M d Y').' '.Carbon\Carbon::parse($item->trial_ends_at)->toTimeString() }}</td>
                         <td>{{ $item->account_type }}</td>
                         <td>{{ $item->last_login_ip }}</td>
                         <td>{{ Carbon\Carbon::parse($item->last_login_at)->format('M d Y').' '.Carbon\Carbon::parse($item->last_login_at)->toTimeString() }}</td>
                         <td>{{ Carbon\Carbon::parse($item->last_logout_at)->format('M d Y').' '.Carbon\Carbon::parse($item->last_logout_at)->toTimeString() }}</td>
                         
                         <?php  
                            $diffInMinutes = Carbon\Carbon::parse($item->last_logout_at)->diffInMinutes();
                            $diffInHours = Carbon\Carbon::parse($item->last_logout_at)->diffInHours();
                            $diffInDays = Carbon\Carbon::parse($item->last_logout_at)->diffInDays()
                         ?>
                         <td>
                            @if($item->user_current_status === 'online')
                           <span class="badge badge-success"> {{ $item->user_current_status }}</span>
                           @else
                            @if($diffInMinutes < 60)
                            <span class="badge badge-secondary"> {{ $diffInMinutes }} minutes ago</span> 
                              @elseif($diffInHours > 24)
                              <span class="badge badge-secondary"> {{ $diffInDays }} days ago</span>
                              @else
                              <span class="badge badge-secondary">  {{ $diffInHours }} hours ago</span>
                              @endif
                           @endif
                          </td>      
                        
                     </tr>
                     @endforeach
                    </tbody>
                  </table>
                </div> 
              </div>
              </div>
            </div>
          
@endif
               



                               

<br>

{!! $signup_rate->script() !!}
@endsection

@section('scripts')

@endsection



