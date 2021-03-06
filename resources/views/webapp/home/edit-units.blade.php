@extends('templates.webapp-new.template')

@section('title', 'Edit All')

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
    <h6 class="h2 text-dark d-inline-block mb-0"><a href="/property/{{ $property->property_id }}/home" class="btn btn-primary" ><i class="fas fa-home"></i> Back</a></h6>
  </div>

</div>
<div class="row">

  <!-- Content Column -->
  <div class="col-lg-12 mb-4">
    <!-- DataTales Example -->

      {{-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">LOGINS HISTORY </h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a> 
           <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> --}}
            {{-- <div class="dropdown-header">Dropdown Header:</div> --}}
            {{-- <a class="dropdown-item" target="_blank" href="/logins">See All</a> --}}
            {{-- <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a> --}}
          {{-- </div> 
        </div>
      </div> --}}
 
      <div class="table-responsive">
          <form id="editUnitsForm" action="/property/{{ $property->property_id }}/home/{{ Carbon\Carbon::now()->getTimestamp()}}/" method="POST">
  
              @csrf
              @method('PUT')

          </form>
          <table class="table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Unit No</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Building</th>
                      <th>Floor No</th>
                      <th>Occupancy</th>
                      <th>Rent</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody> 
                  <?php 
                      $ctr = 1;
                      $unit_id = 1;
                      $unit_no = 1;
                      $type_of_units = 1;
                      $status =1;
                      $building =1;
                      $floor_no = 1;
                      $max_occupancy =1;
                      $monthly_rent = 1;
                  ?>
                  @foreach ($units as $item)
                      <tr>
                          <th> {{ $ctr++ }}</th>
                          <td>
                            <input col-md-12" form="editUnitsForm" type="text" name="unit_no{{ $unit_no++  }}" id="" value="{{ $item->unit_no }}">
                            <input form="editUnitsForm" type="hidden" name="unit_id{{ $unit_id++  }}" id="" value="{{ $item->unit_id }}">
                          </td>
                          <td>
                            <select form="editUnitsForm" type="text" name="type_of_units{{ $type_of_units++  }}">
                              <option value="{{ $item->type_of_units }}" readonly selected class="bg-primary">{{ $item->type_of_units }}</option>
                              <option value="commercial">commercial</option>
                              <option value="residential">residential</option>
                          </select>
                           
                          </td>
                          <td>
                            <select form="editUnitsForm" type="text" name="status{{ $status++  }}" id="" >
                              <option value="{{ $item->status }}" readonly selected class="bg-primary">{{ $item->status }}</option>
                              <option value="vacant">vacant</option>
                              <option value="occupied">occupied</option>
                              
                              <option value="reserved">reserved</option>
                          </select>
                          
                          </td>
                          <td><input form="editUnitsForm" type="text" name="building{{ $building++  }}" id="" value="{{ $item->building }}"></td>
                          <td>
                            <select form="editUnitsForm" type="number" name="floor_no{{ $floor_no++ }}">
                              <option value="{{ $item->floor_no }}" readonly selected class="bg-primary">{{ $item->floor_no }}</option>
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
                           
                          </td>
                          <td><input form="editUnitsForm" type="number" name="max_occupancy{{ $max_occupancy++  }}" id="" min="0" value="{{ $item->max_occupancy }}"> pax</td>
                          <td><input form="editUnitsForm" type="number" step="0.001" name="monthly_rent{{ $monthly_rent++  }}"  min="0" id="" value="{{$item->monthly_rent }}"></td>
                          <td>
                            <form action="/units/{{ $item->unit_id }}" method="POST">
                              @csrf
                              @method('delete')
                              
                              <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-trash fa-sm text-white-50"></i></button>
                            </form> 
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            
        </table>
         </div>
         <br>
         @if($units->count() <=0 )

         @else
        <p class="text-right">
                <button type="submit" form="editUnitsForm" class="btn btn-primary"  onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
            </p>
         @endif
  
</div>
</div>
@endsection

@section('main-content')

@endsection

@section('scripts')
  
@endsection



