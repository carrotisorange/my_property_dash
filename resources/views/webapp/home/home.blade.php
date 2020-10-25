@extends('templates.webapp-new.template')

@section('title', 'Home')

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
    <h6 class="h2 text-dark d-inline-block mb-0">Home</h6>
    
  </div>

  <div class="col-lg-6 col-5 text-right">
    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-home"></i> Vacant</a>
    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-home"></i> Occupied</a>
    <a href="#" class="btn btn-sm btn-warning"> <i class="fas fa-home"></i>Reserved</a>

    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addMultipleUnits" data-whatever="@mdo"><i class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    <a href="/units/edit/{{ Auth::user()->property }}/{{ Carbon\Carbon::now()->getTimestamp() }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit</a>
  </div>

 
</div>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ $property->name }} <span id="count_rooms" class="badge badge-primary">{{ $units_count }}</span></a>
      @foreach ($buildings as $building)
      <a class="nav-item nav-link" id="{{ $building->building }}-tab" data-toggle="tab" href="#{{ $building->building }}" role="tab" aria-controls="{{ $building->building }}" aria-selected="false">{{ $building->building }} <span id="count_rooms" class="badge badge-primary">{{ $building->count }}</a>
      @endforeach
    </div>
  </nav>

<div class="tab-content" id="">
  <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <br>
  
@foreach ($units as $floor_no => $floor_no_list)
<p class="text-center">
@if($floor_no >= 1)
{{ $numberFormatter->format($floor_no).' floor  ('.$floor_no_list->count().')' }}
@else
  @if($floor_no >= -1)
  {{ '1st basement ('.$floor_no_list->count().')' }} 
  @elseif($floor_no >= -2)
  {{ '2nd basement ('.$floor_no_list->count().')' }} 
  @elseif($floor_no >= -3)
  {{ '3rd basement ('.$floor_no_list->count().')' }} 
  @elseif($floor_no >= -4)
  {{ '4th basement ('.$floor_no_list->count().')' }} 
  @elseif($floor_no >= -5)
  {{ '5th basement ('.$floor_no_list->count().')' }} 
  @endif
@endif

</p>

@foreach ($floor_no_list as $item)
  @if($item->status === 'vacant')
      <a title="{{ $item->type_of_units }}" href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}" class="btn btn-danger">
          <i class="fas fa-home fa-3x"></i>
          <br>
          {{ $item->unit_no }}
      </a>
      @elseif($item->status=== 'reserved')
      <a title="{{ $item->type_of_units }}" href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}" class="btn btn-warning">
          <i class="fas fa-home fa-3x"></i>
          <br>
         {{ $item->unit_no }}
        </a>
      @elseif($item->status=== 'occupied')
        <a title="{{ $item->type_of_units }}" href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}" class="btn btn-success">
          <i class="fas fa-home fa-3x"></i>
          <br>
          {{ $item->unit_no }}
          </a>
      @endif   
@endforeach
<hr>
@endforeach

  </div>
   @foreach ($buildings as $building)
    <div class="tab-pane fade show" id="{{ $building->building }}" role="tabpanel" aria-labelledby="{{ $building->building }}-tab">
      <br>
  
      @foreach ($units as $floor_no => $floor_no_list)
      <p class="text-center">
      @if($floor_no >= 1)
      {{ $numberFormatter->format($floor_no).' floor  ('.$floor_no_list->count().')' }}
      @else
      @if($floor_no >= -1)
        {{ '1st basement ('.$floor_no_list->count().')' }} 
        @elseif($floor_no >= -2)
        {{ '2nd basement ('.$floor_no_list->count().')' }} 
        @elseif($floor_no >= -3)
        {{ '3rd basement ('.$floor_no_list->count().')' }} 
        @elseif($floor_no >= -4)
        {{ '4th basement ('.$floor_no_list->count().')' }} 
        @elseif($floor_no >= -5)
        {{ '5th basement ('.$floor_no_list->count().')' }} 
        @endif
      @endif
      
      </p>
    
      @foreach ($floor_no_list as $item)
      @if($building->building === $item->building)
        @if($item->status === 'vacant')
            <a title="{{ $item->type_of_units }}" href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}" class="btn btn-danger">
                <i class="fas fa-home fa-3x"></i>
                <br>
                {{ $item->unit_no }}
            </a>
            @elseif($item->status=== 'reserved')
            <a title="{{ $item->type_of_units }}" href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}" class="btn btn-warning">
                <i class="fas fa-home fa-3x"></i>
                <br>
               {{ $item->unit_no }}
              </a>
            @elseif($item->status=== 'occupied')
              <a title="{{ $item->type_of_units }}" href="/property/{{ $property->property_id }}/home/{{ $item->unit_id }}" class="btn btn-success">
                <i class="fas fa-home fa-3x"></i>
                <br>
                {{ $item->unit_no }}
                </a>
            @endif   
          @endif
      @endforeach
      <hr>
    @endforeach
    </div>
  @endforeach 
</div>


<div class="modal fade" id="addMultipleUnits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >Add Room</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="addUMultipleUnitForm" action="/units/add-multiple" method="POST">
              @csrf
          </form>

          <div class="form-group">
              <small >Building</small>
              <input form="addUMultipleUnitForm" type="text" class="form-control" name="building" placeholder="ex. Building A, Building 1">
              
          </div>

          <div class="form-group">
              <small>Select the floor number of the rooms</small>
              <select class="form-control" form="addUMultipleUnitForm" name="floor_no" id="floor_no" required>
                                  <option value="" selected>Please select one</option>
                                  <option value="-5">5th basement</option>
                                  <option value="-4">4th basement</option>
                                  <option value="-3">3rd basement</option>
                                  <option value="-2">2nd basement</option>
                                  <option value="-1">1st basement</option>
                                   
                                    <option value="1">1st floor</option>
                                    <option value="2">2nd floor</option>
                                    <option value="3">3rd floor</option>
                                    <option value="4">4th floor</option>
                                    <option value="5">5th floor</option>
                                    <option value="6">6th floor</option>
                                    <option value="7">7th floor</option>
                                    <option value="8">8th floor</option>
                                    <option value="9">9th floor</option>
              </select>
          </div>

           <div class="form-group">
              <small>Type</small>
              <select form="addUMultipleUnitForm" class="form-control" name="type_of_units" required>
                  <option value="" selected>Please select one</option>
                  <option value="commercial">commercial</option>
                  {{-- <option value="leasing">leasing</option> --}}
                  <option value="residential">residential</option>         
              </select>
          </div> 
            <input form="addUMultipleUnitForm" type="hidden" value="{{ $property->property_id }}" name="property_id">
          
              <div class="form-group">
                <small>Number of occupants</small>
                <input form="addUMultipleUnitForm" type="number" value="1" min="0"  class="form-control" name="max_occupancy">
            </div>

          <div class="form-group">
              <small>Number of rooms to be created</small>
              <input form="addUMultipleUnitForm" type="number" value="1" min="1" class="form-control" name="no_of_rooms" required>
          </div>

          <div class="form-group">
              <small>Initial name</small>
              <input form="addUMultipleUnitForm" type="text" class="form-control" name="unit_no" placeholder="ex. GF, 1F, 6F" id="unit_no" required>
     
          </div>

         
            <div class="form-group">
                <small>Monthly rent</small>
                <input form="addUMultipleUnitForm" type="number" value="0" step="0.01" min="0" class="form-control" name="monthly_rent" id="monthly_rent">
            </div>
          

      </div>
      <div class="modal-footer">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
          <button form="addUMultipleUnitForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check"></i> Submit</button>
          </div>
  </div>
  </div>
</div>

@endsection



@section('scripts')
  
@endsection



