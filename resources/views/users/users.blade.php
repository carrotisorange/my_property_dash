@extends('layouts.app')

@section('title', 'Users')

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
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="collapse" href="#addUserModal" role="button" aria-expanded="false" aria-controls=""> <i class="fas fa-user-plus  fa-sm text-white-50"></i> Add User</a> 
  @else
    <a title="Your plan can't add another user." class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="collapse" href="#/" role="button" aria-expanded="false" aria-controls=""> <i class="fas fa-user-plus  fa-sm text-white-50"></i> Add User</a> 
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
@if(Auth::user()->email === 'thepropertymanager2020@gmail.com' || Auth::user()->email === 'tecson.pamela@gmail.com')


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
        {{-- <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a> 
           <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Dropdown Header:</div>
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div> 
        </div> --}}
      </div>
      <!-- Card Body -->
      <div class="card-body">
       
          {!! $signup_rate->container() !!}
        
      </div>
    </div>
  </div>
          </div>

                                  <!-- Content Row -->
                                  <div class="row">
          
                                    <!-- Content Column -->
                                    <div class="col-lg-12 mb-4">
                                      <!-- DataTales Example -->
                                      <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                          <h6 class="m-0 font-weight-bold text-primary">LOGINS ({{ $sessions->count() }})</h6>
                                          <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a> 
                                             <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                              {{-- <div class="dropdown-header">Dropdown Header:</div> --}}
                                              <a class="dropdown-item" target="_blank" href="/logins">See All</a>
                                              {{-- <a class="dropdown-item" href="#">Another action</a>
                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item" href="#">Something else here</a> --}}
                                            </div> 
                                          </div>
                                        </div>
                                   
                                       <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                           <table class="table table-striped" >
                                             <thead>
                                               <tr>
                                                <th>USER</th>
                                                <th>EMAIL</th>
                                                <th>ROLE</th>
                                                <th>PROPERTY</th>
                                                <th>LOGIN AT</th>
                                                <th>STATUS</th>
                                             </tr>
                                             </thead>
                                             <tbody>
                                              @foreach ($sessions as $item)
                                              <tr>
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
                                       </div>
                                     </div>
                             
                                         </div>
                  
                               
                                  </div>


                <!-- Content Row -->
                <div class="row">
          
                  <!-- Content Column -->
                  <div class="col-lg-12 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                     <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">PROPERTIES ({{ $properties->count() }})</h6>
                         
                     </div>
                     <div class="card-body">
                      <div class="table-responsive text-nowrap">
                         <table class="table table-striped" >
                           <thead>
                             <tr>
                            
                              <th>PROPERTY</th>
                              <th>ROOMS</th>
                              <th>OCCUPANCY</th>
                              <th>MANAGER</th>
                              <th>EMAIL</th>
                            
                             
                              <th>PLAN</th>
                              <th>CREATED AT</th>
                              <th>EMAIL VERIFIED AT</th>
                             
                           </tr>
                           </thead>
                           <tbody>
                            @foreach ($properties as $item)
                                <tr>
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
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y').'@'.Carbon\Carbon::parse($item->created_at)->toTimeString() }}</td>
                                  <td>{{ Carbon\Carbon::parse($item->email_verified_at)->format('M d Y').'@'.Carbon\Carbon::parse($item->email_verified_at)->toTimeString() }}</td>
                                </tr>
                            @endforeach
                           </tbody>
                         </table>
                        
                       </div>
                     </div>
                   </div>
           
                       </div>

             
                </div>

                <!-- Content Row -->
                <div class="row">
          
                  <!-- Content Column -->
                  <div class="col-lg-12 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                     <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">ACTIVE USERS ({{ $active_users->count() }})</h6>
                         
                     </div>
                     <div class="card-body">
                      <div class="table-responsive text-nowrap">
                         <table class="table table-striped" >
                           <thead>
                             <tr>
                              <th>USER</th>
                              <th>PROPERTY</th>
                              <th>ROLE</th>
                              
                              <th>PLAN</th>
                             
                             
                           </tr>
                           </thead>
                           <tbody>
                            @foreach ($active_users as $item)
                                <tr>
                                  <td>
                                   
                                    <a href="/users/{{ $item->id }}">{{ $item->name }}</a>
                                    
                                  </td>
                                  <td>
                                    {{ $item->property }}
                                  </td>
                                  <td>{{ $item->user_type }}</td>
                            
                                 
                                 
                                 
                                <td>{{ $item->account_type }}</td>
                            
                                </tr>
                            @endforeach
                           </tbody>
                         </table>
                        
                       </div>
                     </div>
                   </div>
           
                       </div>

             
                </div>

                                        <!-- Content Row -->
                                        <div class="row">
          
                                          <!-- Content Column -->
                                          <div class="col-lg-12 mb-4">
                                            <!-- DataTales Example -->
                                            <div class="card shadow mb-4">
                                             <div class="card-header py-3">
                                               <h6 class="m-0 font-weight-bold text-primary">UNVERIFIED USERS ({{ $unverified_users->count() }})</h6>
                                                 
                                             </div>
                                             <div class="card-body">
                                              <div class="table-responsive text-nowrap">
                                                 <table class="table table-striped" >
                                                   <thead>
                                                     <tr>
                                                    
                                                      <th>PROPERTY</th>
                                                      <th>USER</th>
                                                      <th>ROLE</th>
                                                      <th>EMAIL ADDRESS</th>
                                                     
                                                      <th>PLAN</th>
                                                      <th>CREATED AT</th>
                                                     
                                                     
                                                   </tr>
                                                   </thead>
                                                   <tbody>
                                                    @foreach ($unverified_users as $item)
                                                        <tr>
                                                          <td>
                                                            {{ $item->property }}
                                                          </td>
                                                          <td>
                                                           
                                                            <a href="/users/{{ $item->id }}">{{ $item->name }}</a>
                                                     
                                                          </td>
                                                          <td>{{ $item->user_type }}</td>
                                                          <td>{{ $item->email }}</td>
                                                         
                                                        <td>{{ $item->account_type }}</td>
                                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y').' '.Carbon\Carbon::parse($item->created_at)->toTimeString() }}</td>
                                                         
                                                        </tr>
                                                    @endforeach
                                                   </tbody>
                                                 </table>
                                                
                                               </div>
                                             </div>
                                           </div>
                                   
                                               </div>
                        
                                     
                                        </div>
@endif
               



                                        <!-- Content Row -->
                                        <div class="row">
          
                                                <!-- Pie Chart -->
                                          <div class="col-xl-12 col-lg-12">
                                            <div class="card shadow mb-3">
                                              <!-- Card Header - Dropdown -->
                                              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary"> USERS ({{ $users->count() }})</h6>
                                                
                                              </div>
                                              <!-- Card Body -->
                                              <div class="card-body">
                                                <div class="table-responsive text-nowrap">
                                                  <table class="table table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>ID</th>
                                                          <th>USER</th>
                                                          <th>CREATED AT</th>
                                                          <th>EMAIL</th>
                                                          <th>ROLE</th>
                                                          <th>PROPERTY</th>
                                                          <th>PROPERTY TYPE</th>
                                                          <th>PROPERTY OWNERSHIP</th>
                                                          <th>EMAIL VERIFIED AT</th>
                                                          <th>TRIAL ENDS AT</th>
                                                          <th>PLAN</th>
                                                          <th>LAST LOGIN IP</th>
                                                          <th>LAST LOGIN</th>
                                                          <th>LAST LOGOUT</th>
                                                          <th>STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      @foreach ($users as $item)
                                                     <tr>
                                                        <td>{{ $item->id }}</td>
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
                                                </div>                                                      </div>
                                            </div>
                                          </div>
                                        </div>

<br>

{!! $signup_rate->script() !!}
@endsection

@section('scripts')

@endsection



