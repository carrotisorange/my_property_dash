<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ $tenant->first_name.' '.$tenant->last_name}}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"><link href="{{ asset('index/assets/img/favicon.ico') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- Custom styles for this template-->
  <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      {{-- <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        
        <div class="sidebar-brand-text mx-5"> </div>
      </a>
  
      <!-- Divider -->
      <hr class="sidebar-divider my-0"> --}}
  
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
    
      @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury' && (Auth::user()->property_type === 'Apartment Rentals' || Auth::user()->property_type === 'Dormitory'))
        <li class="nav-item active">
          <a class="nav-link" href="/tenants">
            <i class="fas fa-users fa-chart-area"></i>
            <span>Tenants</span></a>
        </li>
        @endif
  
    @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'treasury' && (Auth::user()->property_ownership === 'Multiple Owners'))
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
  
        @if(Auth::user()->user_type === 'manager')
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
  
    </ul>  <!-- End of Sidebar -->
  <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

               <!-- Topbar Search -->
               <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/board/search" method="GET">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                      <i class="fas fa-search fa-sm text-white"></i>
                    </button>
                  </div>
                </div>
              </form>
          <!-- Topbar Search -->
          {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> --}}

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

             <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" action="/board/search" method="GET">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> 


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <i class="fas fa-users-circle"></i> 
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/users/{{ Auth::user()->id }}">
                 <i class="fas fa-user-circle  fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                {{-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> --}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        <div class="container-fluid">
          @foreach (['danger', 'warning', 'success', 'info'] as $key)
          @if(Session::has($key))
         <p class="alert alert-{{ $key }}"> <i class="fas fa-check-circle"></i> {{ Session::get($key) }}</p>
          @endif
          @endforeach
            <div class="row">
              <div class="col-md-12">
                <a href="/units/{{ $tenant->unit_tenant_id }}"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to room</a>
                @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin')
                <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/edit"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-edit fa-sm text-white-50"></i> Edit Tenant</a>  
                <span  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addConcern" data-whatever="@mdo"><i class="far fa-comment-dots fa-sm text-white-50"></i> Report Concern</span>  
                @endif
                @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
                <a href="{{ route('show-billings',['unit_id' => $tenant->unit_tenant_id, 'tenant_id'=>$tenant->tenant_id]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-invoice-dollar fa-sm text-white-50"></i> Show Bills <span class="badge badge-light">{{ $balance->count('balance') }}</span> </a>
                @endif
                @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
                <a href="#payment-history" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-dollar-sign fa-sm text-white-50"></i> Show Payments</a>
                @endif
                
                @if ($tenant->tenant_status === 'inactive' && $balance->sum('balance') > 0) 
                <span  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#moveoutTenantWarning" data-whatever="@mdo"><i class="fas fa-external-link-alt fa-sm text-white-50"></i> Extend Contract</span>
                @else
                <span  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#extendTenant" data-whatever="@mdo"><i class="fas fa-external-link-alt fa-sm text-white-50"></i> Extend Contract</span>
                @endif
               
                @if ($tenant->tenant_status === 'active' || $tenant->tenant_status === 'pending')
                   
                      @if($tenant->created_at === null && $tenant->updated_at === null)
                      <span href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#requestToMoveoutModal" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Request Moveout</span>
                      @elseif($tenant->created_at !== null && $tenant->updated_at === null)
                        @if(Auth::user()->user_type === 'manager')
                        <span href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#approveToMoveoutModal" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Approve Moveout</span>
                        @else
                          <button title="Waiting for the manager to approve..." class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" ><i class="fas fa-clock fa-sm text-white-50"></i> Pending Moveout</button>
                        @endif
                      @else
                      @if($balance->sum('balance') > 0)
                      <span href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#moveoutTenantWarning" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Process Moveout</span>
                      @else
                      <button  href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#moveoutTenant" data-whatever="@mdo"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Process Moveout</button>
                      @endif
                  @endif
           
                @endif
              </div>
            </div>
                
            
            <br>

              <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">TENANT INFORMATION</h6>
                </div>
                <div class="card-body">
                 
                  <div class="table-responsive text-nowrap">
                    <table class="table table-striped" >
        
                             <input type="hidden" value="{{ ($tenant->updated_at) }}" id="approve_moveout_at"> 
                         
             
                          <tr>
                              <td>Full Name</td>
                              <td>{{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }} 
                                  @if($tenant->tenant_status === 'active')
                                      <span class="badge badge-primary">{{ $tenant->tenant_status }}</span>
                                  @elseif($tenant->tenant_status === 'pending')
                                      <span class="badge badge-warning">{{ $tenant->tenant_status }}</span>
                                  @else
                                      <span class="badge badge-danger">{{ $tenant->tenant_status }}</span>
                                  @endif
                              </td>
                          </tr>
                          <tr>
                              <td>Gender</td>
                              <td>{{ $tenant->gender }}</td>
                          </tr>
                          <tr>
                              <td>Birthdate</th>
                              <td>{{ Carbon\Carbon::parse($tenant->birthdate)->format('M d Y') }}</td>
                          </tr>
                          <tr>
                              <td>Civil Status</td>
                              <td>{{ $tenant->civil_status }}</td>
                          </tr>
                          <tr>
                              <td>ID/ID Number</td>
                              <td>{{ $tenant->id_number }}</td>
                          </tr>
                          <tr>
                              <td>Address</td>
                              <td>{{ $tenant->barangay.', '.$tenant->city.', '.$tenant->province.', '.$tenant->country.', '.$tenant->zip_code }}</td>
                          </tr>
                          <tr>
                              <th colspan="2">CONTACT INFORMATION</th>
                          </tr>
                          <tr>
                              <td>Contact No</td>
                              <td>{{ $tenant->contact_no }}</td>
                          </tr>
                          <tr>
                              <td>Email Address</td>
                              <td>{{ $tenant->email_address }}</td>
                          </tr>
                          <tr>
                              <th colspan="2">PERSON TO CONTACT IN CASE OF EMERGENCY</th>
              
                          </tr>
                          <tr>
                              <td>Name</td>
                              <td>{{ $tenant->guardian }}</td>
                          </tr>
                          <tr>
                              <td>Relationship with the tenant</td>
                              <td>{{ $tenant->guardian_relationship }}</td>
                          </tr>
                          <tr>
                              <td>Contact No</td>
                              <td>{{ $tenant->guardian_contact_no }}</td>
                          </tr>
                          <tr>
                            <th colspan="2">EDUCATIONAL BACKGROUND</th>
                        </tr>
                          <tr>
                              <td>High School</td>
                              <td>{{ $tenant->high_school.', '.$tenant->high_school_address }}</td>
                          </tr>
                          <tr>
                              <td>College/University</td>
                              <td>{{ $tenant->college_school.', '.$tenant->college_school_address }}</td>
                          </tr>
                          <tr>
                              <td>Course/Year</td>
                              <td>{{ $tenant->course.', '.$tenant->year_level }}</td>
                          </tr>
                        
                          <tr>
                            <th colspan="2">EMPLOYMENT BACKGROUND</th>
            
                        </tr>
                          <tr>
                              <td>Employer</td>
                              <td>{{ $tenant->employer}}</td>
                          </tr>
                          <tr>
                              <td>Address</td>
                              <td>{{ $tenant->employer_address }}</td>
                          </tr>
                          <tr>
                              <td>Contact No</td>
                              <td>{{ $tenant->employer_contact_no }}</td>
                          </tr>
              
                          <tr>
                              <td>Job description</td>
                              <td>{{ $tenant->job }}</td>
                          </tr>
                          <tr>
                              <td>Years of employment</td>
                              <td>{{ $tenant->years_of_employment }}</td>
                          </tr>
                          <tr>
                            <th colspan="2">CONTRACT INFORMATION</th>
                        </tr>
                          <tr>
                              <td>Monthly Rent</td>
                              <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
                          </tr>
                          <?php 
                              $renewal_history = explode(",", $tenant->renewal_history); 
                              $diffInDays =  number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($tenant->moveout_date), false))
                          ?>
                          <tr>
                              <td>Current Contract Period</td>
                              <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }} 
                                @if( $tenant->has_extended === 'renewed')
                                <span class="badge badge-primary">{{ $tenant->has_extended}} 
                                 
                                 ({{ count($renewal_history)-1 }}x) 
                               </span>  
                                @endif
                               @if($tenant->tenant_status === 'pending')
                               @else
                                  @if($diffInDays <= -1)
                                  <span class="badge badge-danger">contract has lapsed {{ $diffInDays*-1 }} days ago</span> 
                                  @else
                                  <span class="badge badge-warning">contract expires in {{ $diffInDays }} days </span>
                                  @endif
                               @endif
                              </td>
                          </tr>
                          <tr>
                              <td>Previous Contracts</td>
                              <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
                              <td>
                                  @for ($i = 1; $i < count($renewal_history); $i++)
                                    @if($i<=0)
                                    @else
                                      {{ $numberFormatter->format($i-1) .' renewal: '.$renewal_history[$i] }}<br>
                                    @endif
                                  @endfor     
                              </td>
                          </tr>
                           @if($tenant->tenant_status === 'inactive')
                          <tr>
                            <td>Actual Moveout Date</td>
                            <td>
                                {{ Carbon\Carbon::parse($tenant->actual_move_out_date)->format('M d Y') }}
                            </td>
                          </tr>
                          @endif 
                          @if($tenant->tenants_note !== 'new' )
                          <tr>
                              <td>Note</td>
                              <td>
                                  {{ $tenant->tenants_note }}
                              </td>
                          </tr>
                          @endif
                      </table>
                    </div>
                </div>
              </div>

              <div class="row" id="concerns-history">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">CONCERNS HISTORY</h6>            
                        </div>
                        <div class="card-body">
                          <div class="table-responsive text-nowrap">
               
               <table class="table table-striped" >
                 <thead>
                   <tr>
                       <th>ID</th>
                       <th>DATE REPORTED</th>
                      
                       <th>ROOM</th>
                       <th>TYPE</th>
                       <th>DESCRIPTION</th>
                       <th>URGENCY</th>
                       <th>STATUS</th>
                      
                  </tr>
                 </thead>
                 <tbody>
                   @foreach ($concerns as $item)
                   <tr>
                   <td>{{ $item->concern_id }}</td>
                     <td>{{ Carbon\Carbon::parse($item->date_reported)->format('M d Y') }}</td>
                       
                       <td>{{ $item->building.' '.$item->unit_no }}</td>
                       <td>
                         
                           {{ $item->concern_type }}
                           
                       </td>
                       <td ><a title="{{ $item->concern_desc }}" href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/concerns/{{ $item->concern_id }}">{{ $item->concern_item }}</a></td>
                       <td>
                           @if($item->concern_urgency === 'urgent')
                           <span class="badge badge-danger">{{ $item->concern_urgency }}</span>
                           @elseif($item->concern_urgency === 'major')
                           <span class="badge badge-warning">{{ $item->concern_urgency }}</span>
                           @else
                           <span class="badge badge-primary">{{ $item->concern_urgency }}</span>
                           @endif
                       </td>
                       <td>
                           @if($item->concern_status === 'pending')
                           <span class="badge badge-warning">{{ $item->concern_status }}</span>
                           @elseif($item->concern_status === 'active')
                           <span class="badge badge-primary">{{ $item->concern_status }}</span>
                           @else
                           <span class="badge badge-secondary">{{ $item->concern_status }}</span>
                           @endif
                       </td>
                     
                   </tr>
                   @endforeach
                 </tbody>
               </table>
               {{ $concerns->links() }}
             </div>
                        </div>
                    </div>    
                </div>
            </div>

            <!-- start -->
            <div class="row" id="payment-history">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Payments</h6>            
                        </div>
                        <div class="card-body">
                        <table class="table table-striped" table-bordered" id="dataTable" width="100%" cellspacing="0">
                @foreach ($payments as $day => $collection_list)
                  <tr>
                      <th colspan="8">{{ Carbon\Carbon::parse($day)->addDay()->format('M d Y') }} ({{ $collection_list->count()}})</th>
                  </tr>
                  <tr>
                          <th>AR NO</th>
                          <th>BILL NO</th>
                          
                          <th>ROOM</th>
                          <th>DESCRIPTION</th>
                          <th class="text-right">AMOUNT</th>
                          <th></th>
                      </tr>
                </tr>
                  @foreach ($collection_list as $item)
                  <tr>
                          <td>{{ $item->ar_number }}</td>
                          <td>{{ $item->payment_billing_no }}</td>
                          
                          <td>{{ $item->building.' '.$item->unit_no }}</td>
                          <td>{{ $item->payment_note }}</td>
                          <td class="text-right">{{ number_format($item->amt_paid,2) }}</td>
                          <td class="text-center">
                            <a title="export pdf" target="_blank" href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}/dates/{{$item->payment_created}}/export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i></a>
                            {{-- <a target="_blank" href="#" title="print invoice" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i></a> 
                            --}}
                          </td>
                          {{-- <td>
                              <form action="/payments/{{ $item->payment_id }}" method="POST">
                                  @method('delete')
                                  @csrf
                                  <button type="submit" class="btn btn-danger">Delete</button>
                              </form>
                          </td> --}}
                      </tr>
                  @endforeach
                      <tr>
                        <th>TOTAL</th>
                        <th colspan="4" class="text-right">{{ number_format($collection_list->sum('amt_paid'),2) }}</th>
                      </tr>
                      <tr>
                          <th colspan="6"></th>
                      </tr>
                @endforeach
            </table>
                        </div>
                    </div>    
                </div>
            </div>

          <!-- end -->
        </div>

                {{-- Modal for renewing tenant --}}
                <div class="modal fade" id="addConcern" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Enter Concern Information</h5>
              
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                          <form id="concernForm" action="/concerns" method="POST">
                              {{ csrf_field() }}
                          </form>

                          <input type="hidden" form="concernForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}"required>
                          <input type="hidden" form="concernForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}"required>

                          <div class="row">
                            <div class="col">
                                <small>Date Reported</small>
                                <input type="date" form="concernForm" class="form-control" name="date_reported" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required >
                            </div>
                        </div>
                        <br>
                          <div class="row">
                              <div class="col">
                                 <small>Type of Concern</small>
                                  <select class="form-control" form="concernForm" name="concern_type" id="" required>
                                    <option value="" selected>Please select one</option>
                                    <option value="billing">billing</option>
                                    <option value="employee">employee</option>
                                    <option value="internet">internet</option>
                                    <option value="neighbour">neighbour</option>
                                    <option value="noise">noise</option>
                                    <option value="odours">odours</option>
                                    <option value="parking">parking</option>
                                    <option value="pets">pets</option>
                                    <option value="repair">repair</option>
                                    <option value="others">others</option>
                                  </select>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col">
                               <small>Urgency</small>
                                <select class="form-control" form="concernForm" name="concern_urgency" id="" required>
                                  <option value="" selected>Please select one</option>
                                  <option value="minor">minor</option>
                                  <option value="major">major</option>
                                  <option value="urgent">urgent</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <!-- <div class="row">
                          <div class="col">
                              <label for="">Under Warranty</label>
                              <select class="form-control" form="concernForm" name="is_warranty" id="" required>
                                <option value="" selected>Please select one</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                                <option value="na">na</option>
                              </select>
                          </div>
                      </div>
                      <br> -->
                      <div class="row">
                        <div class="col">
                            <small>Short Description</small>
                            <small class="text-danger">(What is your concern all about?)</small>
                            <input type="text" form="concernForm" class="form-control" name="concern_item" required >
                        </div>
                      </div>  
                      <br>
                      <!-- <div class="row">
                        <div class="col">
                            <label for="movein_date">Quantity</label>
                            <input type="number" oninput="this.value = Math.abs(this.value)" form="concernForm" class="form-control" name="concern_qty" required >
                        </div>
                      </div>
                      <br> -->
                       <div class="row">
                            <div class="col">
                                <small>Details of the concern</small>
                                
                                <textarea form="concernForm" rows="7" class="form-control" name="concern_desc" required></textarea>
                            </div>
                        </div>
                        <br>
                        <!-- <div class="row">
                          <div class="col">
                              <label for="movein_date">Assign concern to</label>
                              <select class="form-control" form="concernForm" name="concern_personnel_id" required>
                                <option value="" selected>Please select one</option>
                                @foreach($personnels as $personnel)
                                <option value="{{ $personnel->personnel_id }}">{{ $personnel->personnel_name }}</option>
                                @endforeach
                               
                              </select>
                          </div>
                      </div> -->
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                          <button type="submit" form="concernForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Report Concern</button>
                      </div>
                  </div>
                  </div>
              </div>


        {{-- Modal to moveout tenant --}}
        <div class="modal fade" id="moveoutTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Process Moveout </h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="moveoutTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                    <input type="hidden" form="moveoutTenantForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}" required>
                    <input type="hidden" form="moveoutTenantForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}" required>
                    <div class=" row">
                        <div class="col">
                          <p class="text-center">{{ $tenant->first_name.' '.$tenant->last_name }} is ready to moveout in {{ $unit->building.' '.$unit->unit_no }} on {{ Carbon\Carbon::parse($tenant->actual_move_out_date)->format('M d Y') }}. </p>
                          
                        </div>
                    </div>
                  
                  <div class="modal-footer">
                    <button form="moveoutTenantForm" type="submit" class="btn btn-primary btn-user btn-block"  onclick="this.form.submit(); this.disabled = true;">
                      Print Gatepass
                   </button>
                  
                </div>
             
            </div>
            </div>
        </div>
        </div>
        
        {{-- Modal for renewing tenant --}}
        <div class="modal fade" id="extendTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extend Contract</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="extendTenantForm" action="/units/{{ $unit->unit_id }}/tenants/{{ $tenant->tenant_id }}/renew" method="POST">
                        @csrf
                    </form>
        
                    <div class="row">
                        <div class="col-md-8">
                            <label for="movein_date">Enter the new movein date</label>
                            <input type="date" form="extendTenantForm" class="" name="movein_date" value="{{ $tenant->moveout_date }}" required>
                            <input type="hidden" form="extendTenantForm" class="" name="action" value="extend_contract" required>
                            {{-- <input type="text" form="" class="form-control" name="" value="{{ Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }}" required readonly> --}}
                        </div>

                        <div class="col-md-4">
                          <label for="moveout_date">Extend contract to</label>
                          <input type="number" form="extendTenantForm" min="1" class="" name="no_of_months" min="1" placeholder="enter no of months" required >
                          <input type="hidden" form="extendTenantForm" class="form-control" name="old_movein_date" value="{{ $tenant->movein_date }}" required>
                      </div>
                    </div>
                    <br>
                
                    
                    <div class="row">
                        <div class="col"> 
                               <p class="">
                                <span id='remove_charges' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove Bill</span>
                                <span id="add_charges" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</span>     
                               </p>
                            
                            <br>
                                <table class ="table table-bordered" id="extend_table">
                                    <tr>
                                        <th>Bill No</th>
                                        <th>Description</th>
                                        <th colspan="2">Period Covered</th>
                                        <th>Amount</th>
                                    </tr>
                                        <input form="extendTenantForm" type="hidden" id="no_of_items" name="no_of_items" >
                                    
                                    <tr id='row1'></tr>
                                </table>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
                    <button form="extendTenantForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50"></i> Extend</button>
                </div>
            </div>
            </div>
        </div>
        
        {{-- Modal for warning message --}}
        <div class="modal fade" id="moveoutTenantWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pending Balance </h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

               
                <div class="modal-body">
                  <div class="row">
                    <div class="col">
    
                      <small>Breakdown</small>
                      <div class="table-responsive text-nowrap">
                       
                        <table class="table table-bordered">
                          <tr>
                          {{-- <td></td> --}}
                            <th>Bill No</th>
                           
                            <th>Description</th>
                            <th>Period Covered</th>
                            <th class="text-right" colspan="3">Amount</th>
                            
                          </tr>
                          @foreach ($balance as $item)
                          <tr>
                            {{-- <td>
                              <form action="/billings/{{ $item->billing_id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                              </form>
                            </td>    --}}
                              <td>{{ $item->billing_no }}</td>
                      
                              <td>{{ $item->billing_desc }}</td>
                              <td>
                                {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                                {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                              </td>
                              <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                          </tr>
                         
                          @endforeach
                          <tr>
                            <th colspan="4">TOTAL AMOUNT PAYABLE</th>
                            <th class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
                          </tr>
                    
                      </table>
                     
                    </div>
                    </div>
                    
                  </div>
                 
               </div>
               <div class="modal-footer">
                 <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
                 @if($balance->sum('balance') > 0)
                 <button title="balance has to be settled before moving out." href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{  $tenant->tenant_id }}/billings" form="extendTenantForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" disabled><i class="fas fa-check fa-sm text-white-50"></i> Process Moveout</button> 
                 @else
                 <button href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{  $tenant->tenant_id }}/billings" form="extendTenantForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check fa-sm text-white-50"></i> Process Moveout</button> 
                 @endif
             </div>
             
                
              
            </div>
            </div>
        
        </div>

                {{-- Modal for requesting to moveout --}}
                <div class="modal fade" id="requestToMoveoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Request Moveout </h5>
              
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
  
                      <div class="modal-body">
                      <form id="requestMoveoutForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
                        @method('put')
                         @csrf
                        </form>
                        <input form="requestMoveoutForm" type="hidden" name="action" value="request to moveout">
                        <input type="hidden" form="requestMoveoutForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}"required>
                        <input type="hidden" form="requestMoveoutForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}"required>
                        <div class=" row">
                          <div class="col-md-8">
                              <small>Moveout Date</small>
                              <input type="date" form="requestMoveoutForm" name="actual_move_out_date" id="actual_moveout_date" value="{{ $tenant->moveout_date }}" required>
                          </div>

                          <div class="col-md-4">
                            <small>Reason for Moving Out</small>
                              <select form="requestMoveoutForm" name="reason_for_moving_out" id="reason_for_moving_out" required>
                                  <option value="">Please select one</option>
                                  <option value="end of contract">end of contract</option>
                                  <option value="delinquent">delinquent</option>
                                  <option value="force majeure">force majeure</option>
                                  <option value="run away">run away</option>
                                  <option value="unruly">unruly</option>
                              </select>
                          </div>
                      </div>
                      <hr>
                  

                      <div class="row">
                        <div class="col">
                          <small>Pending balance</small>
                          <div class="table-responsive text-nowrap">
                           
                            <table class="table table-bordered">
                              <tr>
                            
                                <th>Bill No</th>
                               
                                <th>Description</th>
                                <th>Period Covered</th>
                                <th class="text-right" colspan="3">Amount</th>
                                
                              </tr>
                              @foreach ($balance as $item)
                              <tr>
                              
                                  <td>{{ $item->billing_no }}</td>
                          
                                  <td>{{ $item->billing_desc }}</td>
                                  <td>
                                    {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                                    {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                                  </td>
                                  <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                                         </tr>
                              @endforeach
                        
                          </table>
                          <table class="table">
                            <tr>
                             <th>TOTAL AMOUNT PAYABLE</th>
                             <th class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
                            </tr>    
                          </table>
                        </div>
                        </div>
                        
                      </div>
                      <hr>
                      
                      <div class="row">
                        <div class="col">
                       <small>Moveout Charges</small>
                          <p class="text-left">
                            <span id='delete_row' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove Bill</span>
                          <span id="add_row" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</span>     
                          </p>
                            <div class="table-responsive text-nowrap">
                            <table class = "table table-bordered" id="tab_logic">
                                <tr>
                                    <th>Bill No</th>
                                    <th>Description</th>
                                    
                                    <th>Amount</th>
                                    
                                </tr>
                                    <input form="requestMoveoutForm" type="hidden" id="no_of_bills" name="no_of_bills" >
                                <tr id='addr1'></tr>
                            </table>
                          </div>
                        </div>
                      </div>
                        <br>
                        
                       
                     </div>
                     <div class="modal-footer">
                       {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
                      
                        <button type="submit" form="requestMoveoutForm" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Request Moveout</button>
                     
                   </div>
                     
                
                  </div>
                  </div>
              
              </div>

              {{-- Modal to approve to moveout --}}
              <div class="modal fade" id="approveToMoveoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Moveout </h5>
            
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    <div class="modal-body">
                      <form id="approveMoveoutForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
                        @method('put')
                         {{ csrf_field() }}
                        <input form ="approveMoveoutForm" type="hidden" name="action" value="approve to moveout">
                      </form>
                      <div class="row">
                        <div class="col">
                          <small>Moveout Date</small>
                          <input class="form-control" type="date" name="actual_move_out_date" value={{ $tenant->actual_move_out_date }}>
                    
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col">
                          <small>Reason for Moving Out</small>
                          <select form="approveMoveoutForm" class="form-control" name="reason_for_moving_out" id="reason_for_moving_out" required>
                            <option value="{{ $tenant->reason_for_moving_out }}">{{ $tenant->reason_for_moving_out }}</option>
                            <option value="end of contract">end of contract</option>
                            <option value="delinquent">delinquent</option>
                            <option value="force majeure">force majeure</option>
                            <option value="run away">run away</option>
                            <option value="unruly">unruly</option>
                        </select>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col">
                          <small>Pending balance</small>
                          <div class="table-responsive text-nowrap">
                           
                            <table class="table table-bordered">
                              <tr>
                              <td></td>
                                <th>Bill No</th>
                               
                                <th>Description</th>
                                <th>Period Covered</th>
                                <th class="text-right" colspan="3">Amount</th>
                                
                              </tr>
                              @foreach ($balance as $item)
                              <tr>
                                <td>
                                  <form action="/billings/{{ $item->billing_id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                                  </form>
                                </td>   
                                  <td>{{ $item->billing_no }}</td>
                          
                                  <td>{{ $item->billing_desc }}</td>
                                  <td>
                                    {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                                    {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                                  </td>
                                  <td class="text-right" colspan="3">{{ number_format($item->balance,2) }}</td>
                                         </tr>
                              @endforeach
                        
                          </table>
                          <table class="table">
                            <tr>
                             <th>TOTAL AMOUNT PAYABLE</th>
                             <th class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
                            </tr>    
                          </table>
                        </div>
                        </div>
                        
                      </div>
                      
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                      <button form="approveMoveoutForm" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Approve Moveout</button>
                  
                 </div>
                   
              
                </div>
                </div>
            
            </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; The PMO Co 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" type="button" data-dismiss="modal">Cancel</button>
          <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/dashboard/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('/dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('/dashboard/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('/dashboard/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('/dashboard/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('/dashboard/js/demo/chart-pie-demo.js') }}"></script>

  <script type="text/javascript">

  //adding moveout charges upon moveout
    $(document).ready(function(){
        var i=1;
        var current_bill_no  = {{ $current_bill_no }};
    $("#add_row").click(function(){
        $('#addr'+i).html("<th id='value'>"+ (current_bill_no) +"</th><td><input form='requestMoveoutForm' name='billing_desc"+i+"' id='desc"+i+"' type='text' required></td><td><input form='requestMoveoutForm'   name='billing_amt"+i+"' id='amt"+i+"' type='number' min='1' required></td>");


     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;
     current_bill_no++;
     document.getElementById('no_of_bills').value = i;

    });

    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        current_bill_no--;
        document.getElementById('no_of_bills').value = i;
        }
    });

        var j=1;
    $("#add_charges").click(function(){
      $('#row'+j).html("<th>"+ (current_bill_no ) +"</th><td><select name='billing_desc"+j+"' form='extendTenantForm' id='billing_desc"+j+"'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option><option value='Rent'>Rent</option><option value='Electric'>Electric</option><option value='Water'>Water</option></select> <td><input form='extendTenantForm' name='billing_start"+j+"' id='billing_start"+j+"' type='date' required></td> <td><input form='extendTenantForm' name='billing_end"+j+"' id='billing_end"+j+"' type='date' required></td> <td><input form='extendTenantForm'   name='billing_amt"+j+"' id='billing_amt"+j+"' type='number' min='1' step='0.01' required></td>");
     $('#extend_table').append('<tr id="row'+(j+1)+'"></tr>');
     j++;
     current_bill_no++;
        document.getElementById('no_of_items').value = j;

 });

    $("#remove_charges").click(function(){
        if(j>1){
        $("#row"+(j-1)).html('');
        j--;
        current_bill_no--;
        document.getElementById('no_of_items').value = j;
        }
    });
});
</script>

{{-- <script>
	$(document).ready(function(){

    if(document.getElementById('approve_moveout_at').value === '' ){
      
    }else{
      $("#moveoutTenant").modal('show');
    }

	});
</script> --}}
</body>

</html>
