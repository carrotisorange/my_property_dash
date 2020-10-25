@extends('templates.webapp-new.template')

@section('title',  'Profile' )

@section('sidebar')
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          {{-- <img src="{{ asset('/argon/assets/img/brand/logo.png') }}" class="navbar-brand-img" alt="...">--}}{{ $property->name }} 
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/dashboard">
                <i class="fas fa-tachometer-alt text-orange"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/home">
                <i class="fas fa-home text-indigo"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/calendar">
                <i class="fas fa-calendar-alt text-red"></i>
                <span class="nav-link-text">Calendar</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/tenants">
                <i class="fas fa-user text-green"></i>
                <span class="nav-link-text">Tenants</span>
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/owners">
                <i class="fas fa-user-tie text-teal"></i>
                <span class="nav-link-text">Owners</span>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/concerns">
                <i class="fas fa-tools text-cyan"></i>
                <span class="nav-link-text">Concerns</span>
              </a>
            </li>
            @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/joborders">
                <i class="fas fa-list text-dark"></i>
                <span class="nav-link-text">Job Orders</span>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}}/personnels">
                <i class="fas fa-user-secret text-gray"></i>
                <span class="nav-link-text">Personnels</span>
              </a>
            </li>
            @endif

            @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/bills">
                <i class="fas fa-file-invoice-dollar text-pink"></i>
                <span class="nav-link-text">Bills</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/collections">
                <i class="fas fa-coins text-yellow"></i>
                <span class="nav-link-text">Collections</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/financials">
                <i class="fas fa-chart-line text-purple"></i>
                <span class="nav-link-text">Financials</span>
              </a>
            </li>
            @endif
            @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'ap' || Auth::user()->user_type === 'admin')
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/payables">
                <i class="fas fa-file-export text-indigo"></i>
                <span class="nav-link-text">Payables</span>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="/property/{{$property->property_id }}/users">
                <i class="fas fa-user-circle text-green"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal">Documentation</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="/getting-started" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/system-updates" target="_blank">
                <i class="fas fa-bug text-red"></i>
                <span class="nav-link-text">System Updates</span>
              </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="announcements" target="_blank">
                <i class="fas fa-microphone text-purple"></i>>
                <span class="nav-link-text">Annoncements</span>
              </a>
            </li>
             {{--  <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Plugins</span>
              </a>
            </li> --}}
            
          </ul>
        </div>
      </div>
    </div>
  </nav>
@endsection

@section('upper-content')
<div class="row align-items-center py-4">
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-dark d-inline-block mb-0">{{ Auth::user()->name }}</h6>
    
  </div>

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
        <div class="col-md-12 mx-auto">
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
      <br>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <tr>
            <?php $ctr = 1; ?>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Ownership</th>
            <th>Mobile</th>
            <th>Address</th>
          </tr>
          @foreach ($properties as $item)
          <tr>
            <th>{{ $ctr++ }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->ownership }}</td>
            <td>{{ $item->mobile }}</td>
            <td>{{ $item->address.', '.$item->country.', '.$item->zip }}</td>
          </tr>
          @endforeach
      </table>
      </div>    

     
    </div>
    <div class="tab-pane fade" id="session" role="tabpanel" aria-labelledby="nav-session-tab">  
      <br><br>

      <div class="col-md-12 mx-auto">
        <div class="table-responsive text-nowrap">
          <table class="table">
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
            <p>Body</p>
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

@section('main-content')

@endsection

@section('scripts')
  
@endsection



