@extends('layouts.sm-2.template')

@section('title', 'Tenants')

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
            <li class="nav-item active">
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
      
         <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/concerns">
          <i class="far fa-comment-dots"></i>
              <span>Concerns</span></a>
        </li>
    
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
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Bills</span></a>
            </li>
           @endif
      
           @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
              <li class="nav-item">
              <a class="nav-link" href="/collections">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Collections</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/financials">
                <i class="fas fa-coins"></i>
                <span>Financials</span></a>
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
  <h1 class="h3 mb-0 text-gray-800">Tenants</h1>
  <form  action="/tenants/search" method="GET" >
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search for tenant..." value="{{ session(Auth::user()->id.'search_tenant') }}" required>
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
    </div>
</form>
</div>
<div class="table-responsive text-nowrap">
      <table class="table">
        <tr>
          <td colspan="6">Showing <b>{{ $tenants->count() }} </b> of {{ $count_tenants }} tenants </td>
          
        </tr>
      </table>
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
                    <a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->middle_name.' '.$item->last_name }}
                      @if($item->tenants_note === 'new' )
                      <span class="badge badge-success">{{ $item->tenants_note }}</span>
                      @endif
                      
                      <span class="badge badge-success">{{ $item->has_extended }}</span>
                    </a>
                    @else
                    <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}
                      @if($item->tenants_note === 'new' )
                      <span class="badge badge-success">{{ $item->tenants_note }}</span>
                      @endif
                      
                      <span class="badge badge-success">{{ $item->has_extended }}</span>
                    </a>
                    @endif
                </td>
                
                <td> @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin' )
                  <a href="/units/{{ $item->unit_id }}">{{ $item->building.' '.$item->unit_no }}</a>
                  @else
                 {{ $item->building.' '.$item->unit_no }}
                  @endif
                </td>
                <td>
                    @if($item->tenant_status === 'active')
                    <span class="badge badge-primary">{{ $item->tenant_status }}</span>
                    @elseif($item->tenant_status === 'inactive')
                    <span class="badge badge-secondary">{{ $item->tenant_status }}</span>
                    @else
                    <span class="badge badge-warning">{{ $item->tenant_status }}</span>
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



