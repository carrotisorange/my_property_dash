@extends('layouts.sm-2.template')

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
  <h1 class="h3 mb-0 text-gray-800">{{ $user->name }}</h1>
</div>
      
    <div class="row">
      <div class="col-md-12">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="nav-profile" aria-selected="true"><i class="fas fa-user fa-sm text-primary-50"></i> Profile</a>
            <a class="nav-item nav-link" id="nav-property-tab" data-toggle="tab" href="#property" role="tab" aria-controls="nav-property" aria-selected="false"><i class="fas fa-home fa-sm text-primary-50"></i> Property</a>
            <a class="nav-item nav-link" id="nav-session-tab" data-toggle="tab" href="#session" role="tab" aria-controls="nav-session" aria-selected="false"><i class="fas fa-sign-in-alt fa-sm text-primary-50"></i> Sessions</a>
            <a class="nav-item nav-link" id="nav-session-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="nav-settings" aria-selected="false"><i class="fas fa-user-cog fa-sm text-primary-50"></i> Settings</a>
            <a class="nav-item nav-link" id="nav-session-tab" data-toggle="tab" href="#blogs" role="tab" aria-controls="nav-blogs" aria-selected="false"><i class="fas fa-blog fa-sm text-primary-50"></i> Blogs</a>
          </div>
        </nav>
      </div>
    </div>
 
   <div class="row">
     <div class="col-md-12">
      <div class="tab-content" id="nav-tabContent">
        
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          
          <br><br>
            <div class="col-md-11 mx-auto">
              <small>Name</small>
              <p>{{ $user->name }}</p>
              <hr>
              <small>Email</small>
              <p>{{ $user->email }}</p>
              <hr>
              <small>Role</small>
              <p>{{ $user->user_type }}</p>
              <hr>
              <small>Plan</small>
              <p>{{ $user->account_type }}</p>
            </div>
        </div>
        <div class="tab-pane fade" id="property" role="tabpanel" aria-labelledby="nav-property-tab">
          <br><br>
          <div class="col-md-11 mx-auto">
            <small>Property</small>
            <p>{{ $user->property }}</p>
            <hr>
            <small>Type</small>
            <p>{{ $user->property_type }}</p>
            <hr>
            <small>Ownership</small>
            <p>{{ $user->property_ownership }}</p>
          

          </div>
        </div>
        <div class="tab-pane fade" id="session" role="tabpanel" aria-labelledby="nav-session-tab">  
          <br><br>

          <div class="col-md-11 mx-auto">
            <div class="table-responsive">
              <table class="table table-bordered">
                <?php $ctr = 1; ?>
                <tr>
                  <th>#</th>  
                  <th>IP Address</th>
                  <th>Login At</th>
                  <th>Logout At</th>
                </tr>
                @foreach ($sessions as $item)
                  <tr>
                   <th>{{ $ctr++ }}</th>
                    <td>{{ $item->session_last_login_ip }}</td>
                   <td>{{ $item->session_last_login_at? Carbon\Carbon::parse($item->session_last_login_at)->format('M d Y').' '.Carbon\Carbon::parse($item->session_last_login_at)->toTimeString() : null }}</td>
                    
                   <td>{{ $item->session_last_logout_at? Carbon\Carbon::parse($item->session_last_logout_at)->format('M d Y').' '.Carbon\Carbon::parse($item->session_last_logout_at)->toTimeString() : null }}</td>
           
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="nav-settings-tab">  
          <br><br>
          <div class="col-md-11 mx-auto">
            <form id="editUserForm" action="/users/{{ $user->id }}" method="POST">
              @method('put')
              {{ csrf_field() }}
            </form>
              <small>Name</small>
              <input form="editUserForm" id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              <hr>
              <small>Email</small>
              <input form="editUserForm" id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              <hr>
              <small>New Password</small>
              <input form="editUserForm" id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" autocomplete="password">
                    <small class="text-danger">Changing your password will log you out of the application.</small>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              <p class="text-right">
                <button form="editUserForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
              </p>

              <hr>
              @if(Auth::user()->user_type === 'manager')
              <small>Warning: Account deletion can't be undone. </small>
              <br>
              <form action="/users/{{ $user->id }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="col-md-3 btn btn-danger btn-user btn-block" id="registerButton" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;">
                  <i class="fas fa-trash fa-sm text-white-50"></i> Delete
                </button>
              </form>
              @endif
             
          </div>
        </div>
        <div class="tab-pane fade" id="blogs" role="tabpanel" aria-labelledby="nav-blogs-tab">
          
          <br>
            <div class="col-md-11 mx-auto">
              <form action="/blogs" method="POST">
                @csrf
                <input class="form-control" type="text" name="title" placeholder="Title" required>
                <br>
                <select class="form-control" name="category" id="" required>
                  <option value="">Please select category</option>
                  <option value="Condominium & Homeowners Associations">Condominium & Homeowners Associations</option>
                  <option value="Investment Property">Investment Property</option>
                  <option value="Maintenance & Repair">Maintenance & Repair</option>
                  <option value="Property Management">Property Management</option>
                  <option value="Real Estate Trends">Real Estate Trends</option>
                  <option value="Tenants">Tenants</option>
                  <option value="Taxes & Finances">Taxes & Finances</option>
          
                </select>
                <br>
                <textarea class="form-control" name="body" id="body" cols="30" rows="30" placeholder="Body" required></textarea>
                
                <br>
                
                {{-- <input type="file" name="image" class="form-control">
                <br> --}}
                <p class="text-right">                
                  <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-share fa-sm text-white-50"></i> share </button>
                </p>
              </form>
            </div>
            <br>
            @foreach ($blogs as $item)
            <div class="col-md-11 mx-auto">
             
              <div class="jumbotron bg-transparent">
                <header class="blockquote-header text-right">{{ $item->category }}</header>
                <h3 class="">{{ $item->title }}</h3>
                <p class="">{!! $item->body !!}</p>
              
                <footer class="blockquote-footer">{{ $item->name }} <cite title="Source Title">on {{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</cite></footer>
               
              </div>
            </div>
            @endforeach
        </div>
      </div>
     </div>
   </div>

@endsection

@section('scripts')
	
@endsection



