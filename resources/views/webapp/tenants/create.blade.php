@extends('templates.webapp-new.template')

@section('title', $unit->building.' '.$unit->unit_no )

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
              <a class="nav-link active" href="/property/{{$property->property_id }}/home">
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
    <h6 class="h2 text-dark d-inline-block mb-0">{{ $unit->building.' '.$unit->unit_no }}</h6>
    
  </div>

</div>

<form id="addTenantForm1" action="/tenants" method="POST">
  {{ csrf_field() }}
  </form>
  
  <input form="addTenantForm1" type="hidden" value="{{ session(Auth::user()->id.'unit_id') }}" name="unit_id"> 
  <div class="row">
      <div class="col">
          <small class="">First Name <span class="text-danger">*</span></small>
          <input form="addTenantForm1" type="text" class="form-control" name="first_name" name="first_name" id="first_name" required>
            {{-- @error('first_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror --}}
        </div>
      <div class="col">
          <small class="">Middle Name</small>
          <input form="addTenantForm1" type="text" class="form-control" name="middle_name" id="middle_name" value="">
      </div>
      <div class="col">
          <small class="">Last Name  <span class="text-danger">*</span></small>
          <input form="addTenantForm1" type="text" class="form-control" name="last_name" id="last_name" value="" required>
  
          {{-- @error('last_name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror --}}
      </div>
      </div>
      <br>
  <div class="row">
      <div class="col">
          <small class="">Birthdate </small>
          <input form="addTenantForm1" type="date" class="form-control" name="birthdate" id="birthdate" value="{{ session(Auth::user()->id.'birthdate') }}" >
  
          {{-- @error('birthdate')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror --}}
      </div>
      <div class="col">
          <small class="">Gender </small>
          <select form="addTenantForm1"  id="gender" name="gender" class="form-control">        
              <option value="" selected>Please select one</option>
              <option value="male">male</option>
              <option value="female">female</option>
          </select>
  
          {{-- @error('gender')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror --}}
      </div>
      <div class="col">
          <small class="">Civil Status</small>
          <select form="addTenantForm1"  id="civil_status" name="civil_status" class="form-control">
              <option value="">Please select one</option>
              <option value="single">single</option>
              <option value="married">married</option>
          </select>
      </div>
      <div class="col">
          <small class="">ID/ID Number</small>
          <input form="addTenantForm1" type="text" class="form-control" name="id_number" id="id_number" >
      </div>
  </div>

  <input type="hidden" form="addTenantForm1" value="{{ $property->property_id }}" name="property_id">
  <br>
  <div class="row">
      <div class="col">
          <small class="">Mobile <span class="text-danger">*</span></small>
        <input form="addTenantForm1" type="text" class="form-control " name="contact_no" id="contact_no" >
  
        {{-- @error('contact_no')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="col">
          <small class="">Email <span class="text-danger">*</span></small>
        <input form="addTenantForm1" type="email" class="form-control" name="email_address" id="email_address" value="">
  
        {{-- @error('email_address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror --}}
      </div>
  </div>
  <hr>
  <div class="row">
      <div class="col">
        <small>Move-in date <span class="text-danger">*</span></small>
        <input form="addTenantForm1" type="date" class="form-control" name="movein_date" id="movein_date" value="" required>
  
        {{-- @error('movein_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="col">
        <small>Move-out date <span class="text-danger">*</span></small>
        <input onkeyup="duration()" form="addTenantForm1" type="date" class="form-control" name="moveout_date" value="" id="moveout_date" required>
        
        {{-- @error('moveout_date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="col">
          <small>Monthly rent <span class="text-danger">*</span></small>
          <input form="addTenantForm1" type="number" class="form-control" name="tenant_monthly_rent" min="1" id="tenant_monthly_rent" value="{{ session(Auth::user()->id.'tenant_monthly_rent') }}" required>
  
          {{-- @error('tenant_monthly_rent')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror --}}
      </div>
    </div>
    <hr>
            
    <div class="row">
      <div class="col">
     
        <p class="">
          <a href="#/" id='delete_row' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Bill</a>
        <a href="#/" id="add_row" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Bill</a>     
        </p>
          <div class="table-responsive text-nowrap">
          <table class = "table table-bordered" id="tab_logic">
              <tr>
                  <th>#</th>
                  <th>Description</th>
                  <th>Amount</th>
                 
              </tr>
                  <input form="addTenantForm1" type="hidden" id="no_of_items" name="no_of_items" >
              <tr id='addr1'></tr>
          </table>
        </div>
      </div>
    </div>
  
  <br>
  <p class="text-right">   
      <a href="/units/{{ session(Auth::user()->id.'unit_id') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
      <button type="submit" form="addTenantForm1" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-arrow-right fa-sm text-white-50" ></i> Submit</button>
  </p>
  

@endsection

@section('main-content')

@endsection

@section('scripts')
  

<script type="text/javascript">

  //adding moveout charges upon moveout
    $(document).ready(function(){
        var i=1;
        var current_bill_no  = {{ $current_bill_no }};
    $("#add_row").click(function(){
        $('#addr'+i).html("<th>"+ (current_bill_no ) +"</th><td><select class='form-control' name='billing_desc"+i+"' form='addTenantForm1' id='billing_desc"+i+"'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option><option value='Rent'>Rent</option><option value='Electric'>Electric</option><option value='Water'>Water</option></select> <td><input class='form-control' form='addTenantForm1' name='billing_amt"+i+"' id='billing_amt"+i+"' type='number' min='1' step='0.01' value='{{ session(Auth::user()->id.'tenant_monthly_rent') }}'' required></td>");


     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;
     current_bill_no++;
     document.getElementById('no_of_items').value = i;

    });

    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        current_bill_no--;
        document.getElementById('no_of_items').value = i;
        }
    });

});
</script>
@endsection



