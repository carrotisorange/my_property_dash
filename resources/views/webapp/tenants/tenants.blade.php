@extends('templates.webapp-new.template')

@section('title', 'Tenants')

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
              <a class="nav-link " href="/property/{{$property->property_id }}/home">
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
              <a class="nav-link active" href="/property/{{$property->property_id }}/tenants">
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
              <a class="nav-link" href="/property/{{$property->property_id }}/personnels">
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
              <a class="nav-link" href="/property/{{ $property->property_id }}/getting-started" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/system-updates" target="_blank">
                <i class="fas fa-bug text-red"></i>
                <span class="nav-link-text">System Updates</span>
              </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="/property/{{ $property->property_id }}/announcements" target="_blank">
                <i class="fas fa-microphone text-purple"></i>
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
    <h6 class="h2 text-dark d-inline-block mb-0">Tenants</h6>
    
  </div>
  <div class="col-lg-6 col-5 text-right">
    <form  action="/property/{{ $property->property_id }}/tenants/search" method="GET" >
      @csrf
      <div class="input-group">
          <input type="text" class="form-control" name="search" placeholder="Enter tenant, room, ..." value="{{ session(Auth::user()->id.'search_tenant') }}">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
      </div>
  </form>
  </div>

</div>
Showing <b>{{ $tenants->count() }} </b> of {{ $count_tenants }} tenants
@if(session(Auth::user()->id.'search_tenant'))
<p class="text-center"> <span class=""> <small> you searched for </small></span> <span class="text-danger">"{{ session(Auth::user()->id.'search_tenant') }}"<span></p>
@endif


<div class="table-responsive text-nowrap">
    <table class="table table-bordered">
      <thead>
        <?php $ctr=1;?>
        <tr>
          <th>#</th>
            <th>Tenant</th>
            <th>Room</th>
            <th>Status</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Contract Period</th>    
            <th>Monthly Rent</th>
            <th>Guardian</th>
            <th>Relationship</th>
            <th>Mobile</th>
       </tr>
      </thead>
      <tbody>
        @foreach ($tenants as $item)
        <tr>
          <th>{{ $ctr++ }}</th>
            <td>
                @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager')
                <a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}/tenant/{{ $item->tenant_id }}">{{ $item->first_name.' '.$item->middle_name.' '.$item->last_name }}
                  @if($item->tenants_note === 'new' )
                  <span class="badge badge-success">{{ $item->tenants_note }}</span>
                  @endif
                  
                  <span class="badge badge-success">{{ $item->has_extended }}</span>
                </a>
                @else
                <a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}/tenant/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}
                  @if($item->tenants_note === 'new' )
                  <span class="badge badge-success">{{ $item->tenants_note }}</span>
                  @endif
                  
                  <span class="badge badge-success">{{ $item->has_extended }}</span>
                </a>
                @endif
            </td>
            
            <td> @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin' )
              <a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}">{{ $item->building.' '.$item->unit_no }}</a>
              @else
             {{ $item->building.' '.$item->unit_no }}
              @endif
            </td>
            <td>
                @if($item->tenant_status === 'active')
                <span class="badge badge-success">{{ $item->tenant_status }}</span>
                @elseif($item->tenant_status === 'inactive')
                <span class="badge badge-secondary">{{ $item->tenant_status }}</span>
                @else
                <span class="badge badge-danger">{{ $item->tenant_status }}</span>
                @endif
            </td>
            <td>{{ $item->contact_no }}</td>
            <td>{{ $item->email_address }}</td>
          
            <td>{{ Carbon\Carbon::parse($item->movein_date)->format('M d Y').' - '.Carbon\Carbon::parse($item->moveout_date)->format('M d Y') }}</td>
            <td>{{ number_format($item->monthly_rent, 2) }}</td>
            <td>{{ $item->guardian }}</td>
            <td>{{ $item->guardian_relationship }}</td>
            <td>{{ $item->guardian_contact_no }}</td>
           
            {{-- <td title="months before move-out">{{ number_format(Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($item->moveout_date), false)/30,1) }} mon</td> --}}
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>

@endsection



@section('scripts')
  
@endsection



