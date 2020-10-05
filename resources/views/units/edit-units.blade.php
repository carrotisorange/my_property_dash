@extends('layouts.sm-2.template')

@section('title', 'Units | Edit')

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
          <li class="nav-item active">
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
<br>
<!-- Content Row -->
<div class="row">

    <!-- Content Column -->
    <div class="col-lg-12 mb-4">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
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
   
       <div class="card-body">
        <div class="table-responsive text-nowrap">
            <form id="editUnitsForm" action="/units/edit/{{ Auth::user()->property }}/{{ Carbon\Carbon::now()->getTimestamp()}}" method="POST">
    
                @csrf
                @method('PUT')

            </form>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Unit No</th>
                        <th>Room Type</th>
                        <th>Status</th>
                        <th>Building</th>
                        <th>Floor No</th>
                        <th>Max Occupancy</th>
                        <th>Monthly Rent</th>
                        <th></th>
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
                              <input form="editUnitsForm" type="text" name="unit_no{{ $unit_no++  }}" id="" value="{{ $item->unit_no }}">
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
                            <td><input form="editUnitsForm" type="number" name="max_occupancy{{ $max_occupancy++  }}" id="" min="1" value="{{ $item->max_occupancy }}"> pax</td>
                            <td><input form="editUnitsForm" type="number" step="0.001" name="monthly_rent{{ $monthly_rent++  }}"  min="0" id="" value="{{$item->monthly_rent }}"></td>
                            <td>
                              <form action="/units/{{ $item->unit_id }}" method="POST">
                                @csrf
                                @method('delete')
                                
                                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                              </form> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              
          </table>
           </div>
           <br>
           <p class="text-right">
            <a href="/home" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
            <button type="submit" form="editUnitsForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Save Changes</button>
        </p>
       </div>
       
     </div>

         </div>


  </div>
@endsection

@section('scripts')

@endsection



