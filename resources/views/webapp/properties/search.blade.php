@extends('templates.webapp-new.template')

@section('title', $search_key)

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
    <h6 class="h2 text-dark d-inline-block mb-0"><span class=""> <small> you searched for </small></span> <span class="text-danger">"{{ $search_key }}"<span></h6>
  </div>

</div>
<div class="row">
    <div class="table-responsive text-nowrap">
       <div class="col-md-12">
        <p><span class="font-weight-bold">{{ $tenants->count()+$emails->count() }}</span> matched for tenants...</p>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Room</th>
                <th>Status</th>
                <th>Move in date</th>
                <th>Move out date</th>
                <th>Monthly rent</th>
            </tr>
            <?php $tenant_ctr=1;?>
            @foreach ($tenants as $tenant)
            <tr>
                <th>{{ $tenant_ctr++ }}</th>
                <td><a href="/property/{{ $property->property_id }}/home/{{ $tenant->unit_id }}/tenant/{{ $tenant->tenant_id }}">{{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }}</a></td>
                <td>{{ $tenant->email_address }}</td>
                <td>{{ $tenant->contact_no }}</td>
                <td>{{ $tenant->unit_no }}</td>
                <td>{{ $tenant->tenant_status }}</td>
                <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y') }}</td>    
                <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y') }}</td>
                <td>{{ $tenant->tenant_monthly_rent }}</td>
            </tr>
            @endforeach
            @foreach ($emails as $tenant)
            <tr>
                <th>{{ $tenant_ctr++ }}</th>
                <td><a href="/property/{{ $property->property_id }}/home/{{ $tenant->unit_id }}/tenant/{{ $tenant->tenant_id }}">{{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }}</a></td>
                <td>{{ $tenant->email_address }}</td>
                <td>{{ $tenant->contact_no }}</td>
                <td>{{ $tenant->unit_no }}</td>
                <td>{{ $tenant->tenant_status }}</td>
                <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y') }}</td>    
                <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y') }}</td>
                <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
            </tr>
            @endforeach
         </table>

         <br>

         <p><span class="font-weight-bold">{{ $units->count() }}</span> matched for rooms...</p>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Room</th>
                <th>Building</th>
                <th>Type</th>
                <th>Floor no</th>
                <th>Number of bed</th>
                <th>Status</th>
                <th>Occupancy</th>
                <th>Monthly rent</th>
            </tr>
            <?php $unit_ctr=1;?>
            @foreach ($units as $unit)
            <tr>
                <th>{{ $unit_ctr++ }}</th>
                <td><a href="/property/{{ $property->property_id }}/home/{{ $unit->unit_id }}">{{ $unit->unit_no }}</a></td>
                <td>{{ $unit->building }}</td>
                <td>{{ $unit->type_of_units }}</td>
                <td>{{ $unit->floor_no }}</td>
                <td>{{ $unit->beds }}</td>
                <td>{{ $unit->status }}</td>
                <td>{{ $unit->max_occupancy }}</td>
                 <td>{{ number_format($unit->monthly_rent, 2) }}</td>
            </tr>
            @endforeach
         </table>

         <br>

         <p><span class="font-weight-bold">{{ $owners->count() }}</span> matched for owners...</p>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Owner</th>
                <th>Room</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Representative</th>
       
                <th>Date Accepted</th>
                <th>Room Type</th>
                <th>Occupancy</th>
                <th>Monthly Rent</th>
                <th>Status</th>
            </tr>
            <?php $owner_ctr=1;?>
            @foreach ($owners as $owner)
            <tr>
                <th>{{ $owner_ctr++ }}</th>
                <td><a href="/property/{{ $property->property_id }}/home/{{ $owner->unit_id_foreign }}">{{ $owner->building.' '.$owner->unit_no }}</a></td>
               <td>{{ $owner->investor_email_address}}</td>
               <td>{{ $owner->investor_contact_no }}</td>
               <TD>{{ $owner->investor_representative }}</TD>
               <td> {{ $owner->date_accepted ? Carbon\Carbon::parse($owner->date_accepted)->format('M d Y') : null}}</td>

               <td>{{ $owner->type_of_units }}</td>
               <td>{{ $owner->max_occupancy }} pax</td>
               <td>{{ number_format($owner->monthly_rent, 2) }}</td>
               <td>{{ $owner->status }}</td>
            </tr>
            @endforeach
         </table>
       </div>
        
    </div>
</div>

@endsection

@section('main-content')

@endsection

@section('scripts')
  
@endsection



