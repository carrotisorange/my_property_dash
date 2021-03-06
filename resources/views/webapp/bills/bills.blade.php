@extends('templates.webapp-new.template')

@section('title', 'Bills')

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
              <a class="nav-link" href="/property/{{$property->property_id }}/personnels">
                <i class="fas fa-user-secret text-gray"></i>
                <span class="nav-link-text">Personnels</span>
              </a>
            </li>
            @endif

            @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
            <li class="nav-item">
              <a class="nav-link active" href="/property/{{$property->property_id }}/bills">
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
    <h6 class="h2 text-dark d-inline-block mb-0">Bills</h6>
    
  </div>
  <div class="col-lg-6 col-5 text-right">
    <div class="dropdown show">
      <br>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <button type="submit" form="billingRentForm" class="dropdown-item "> Rent</button>
        <input type="hidden" form="billingRentForm" name="billing_option" value="rent">
        <button type="submit" form="billingElectricForm" class="dropdown-item"> Electric</button>
        <input type="hidden" form="billingElectricForm" name="billing_option" value="electric">
        <button type="submit" form="billingWaterForm" class="dropdown-item "> Water</button>
        <input type="hidden" form="billingWaterForm" name="billing_option" value="water">
      
  
      <form id="billingRentForm" action="/property/{{ $property->property_id }}/bills/rent/{{ Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" method="POST">
        @csrf
      </form>
      <form id="billingElectricForm" action=" /property/{{ $property->property_id }}/bills/electric/{{ Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" method="POST">
          @csrf
      </form>
      <form id="billingWaterForm" action="/property/{{ $property->property_id }} /bills/water/{{ Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}-{{ Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" method="POST">
          @csrf
      </form>
 
      </div>
    </div>
  </div>

</div>

<div class="table-responsive text-nowrap">
  <table class="table">
    @foreach ($bills as $day => $bill)
      <tr>
          <th colspan="12">{{ Carbon\Carbon::parse($day)->addDay()->format('M d Y') }}, TENANTS BILLED: ({{ $bill->count() }}) , TOTAL AMOUNT BILLED: ({{ number_format($bill->sum('billing_amt'),2) }})</th>
      </tr>
      <tr>
        
        <th>Bill No</th>
        
        
        <th>Tenant</th>
        <th>Room</th>
        <th>Description</th>
       
        <th colspan="2">Period Covered</th>
        <th>Amount</th>
     
        <td>Action</td>
          </tr>
    </tr>
      @foreach ($bill as $item)
      <tr>
       
        <td>{{ $item->billing_no }}</th>  
        {{-- <td>  {{ Carbon\Carbon::parse($item->billing_date)->format('M d Y') }}</td> --}}
       
        
        <td>
          @if(Auth::user()->user_type === 'billing')
          <a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}/tenant/{{ $item->tenant_id }}/bills">{{ $item->first_name.' '.$item->last_name }}</a>
          @else
            <a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}/tenant/{{ $item->tenant_id }}#bills">{{ $item->first_name.' '.$item->last_name }}</a>
          @endif
        </td>
        <td>{{ $item->building.' '.$item->unit_no }}</td>
        <td>{{ $item->billing_desc }}</td>
       
        <td colspan="2">
          {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
          {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
        </td>
        <td><a href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}/tenant/{{ $item->tenant_id }}/bill/{{ $item->billing_id }}">{{ number_format($item->billing_amt,2) }}</a></td>
     
          <td class="text-center">
            @if(Auth::user()->user_type === 'manager')
            <form action="tenants/{{ $item->billing_tenant_id }}/billings/{{ $item->billing_id }}" method="POST">
              @csrf
              @method('delete')
              <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-trash-alt fa-sm text-white-50"></i></button>
            </form>
            @endif
          </td>
        </tr>
      @endforeach
          
        
    @endforeach
  </table>
  </div>

@endsection



@section('scripts')
  
@endsection



