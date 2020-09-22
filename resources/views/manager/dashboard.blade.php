<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard </title>

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
      <li class="nav-item active">
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
        <li class="nav-item">
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
  
    </ul>  <!-- End of Sidebar -->

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
                  <input type="text" class="form-control bg-light border-0 small" name="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
               <input type="text" class="form-control bg-light border-0 small" name="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                     <input type="text" class="form-control bg-light border-0 small" name="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> 

            <!-- Nav Item - Alerts -->
             <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if($notifications_opened  > 0)
                  <span class="badge badge-danger badge-counter">{{ $notifications_opened }}</span>
                @else
                  <span class="badge badge-danger badge-counter"></span>
                @endif
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notifications
                </h6>
                @foreach($notifications as $item)
                  @if($item->action==='request to moveout has been approved!' ||$item->action==='has been added to the property!' || $item->action==='property has been set-up!' )
                    @if($item->updated_at === null)
                    <form id="notificationtForm" action="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}" method="POST">
                        @method('put')
                        {{ csrf_field() }}
                        <input form="notificationtForm" type="hidden" name="action" value="open notification">
                        <input form="notificationtForm" type="hidden" name="notification_id" value="{{ $item->notification_id }}">
                    </form>
                      <button form="notificationtForm" class="dropdown-item d-flex align-items-center">
                      <div class="mr-3">
                      <div class="icon-circle bg-success">
                          <i class="fas fa-check text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
                        <span class="font-weight-bold">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
                      </div>
                    </button> 
                    @else
                      <a class="dropdown-item d-flex align-items-center" href="/units/{{$item->unit_no}}/tenants/{{ $item->tenant_id }}">
                      <div class="mr-3">
                      <div class="icon-circle bg-success">
                          <i class="fas fa-check text-white"></i>
                        </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
                        <span class="">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
                      </div>
                    </a> 
                    @endif
                  @else
                  @if($item->updated_at === null)
                    <form id="notificationtForm" action="/units/{{ $item->unit_tenant_id }}/tenants/{{ $item->tenant_id }}" method="POST">
                        @method('put')
                        {{ csrf_field() }}
                        <input form="notificationtForm" type="hidden" name="action" value="open notification">
                        <input form="notificationtForm" type="hidden" name="notification_id" value="{{ $item->notification_id }}">
                    </form>
                      <button form="notificationtForm" class="dropdown-item d-flex align-items-center">
                      <div class="mr-3">
                      <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
                        <span class="font-weight-bold">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
                      </div>
                    </button> 
                    @else
                      <a class="dropdown-item d-flex align-items-center" href="/units/{{$item->unit_no}}/tenants/{{ $item->tenant_id }}">
                      <div class="mr-3">
                      <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                      </div>
                      <div>
                        <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
                        <span class="">{{ $item->first_name.' '.$item->last_name.' '.$item->building.' '.$item->unit_no.' '.$item->action }}</span>
                      </div>
                    </a> 
                    @endif
                  @endif
                @endforeach
                 <a class="dropdown-item text-center small text-gray-500" href="/notifications">Show All Notifications</a>
              </div>
            </li> 

            {{--<!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
               <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li> --}}

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
            
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                   <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> 
                </div>

                @if(Auth::user()->property_ownership === 'Multiple Owners')
   <!-- Content Row -->
                <div class="row">
      
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-primary" href="/home">  ROOMS</a> </div>
                            <div id="count_rooms" class="h5 mb-0 font-weight-bold text-gray-800">{{ $units->count() }}</div>
{{--                             
                            <small>O ({{ $units_occupied->count() }})</small>
                            <small>V ({{ $units_vacant->count() }})</small>
                            <small>R ({{ $units_reserved->count() }})</small>
                             --}}
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-home fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
      
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="text-success" href="/tenants">  ACTIVE TENANTS</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_tenants->count() }}</div>
                            {{-- <small>PENDING ({{ $pending_tenants->count() }})</small> --}}
                            
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
      
                
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a class="text-warning" href="/owners">  OWNERS</a> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $owners->count() }}</div>
                            {{-- <small>|</small> --}}
                            
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Pending Requests Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a class="text-danger"  href="#active-concerns">  ACTIVE CONCERNS</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_concerns->count() }}</div>
{{--                            
                            <small>PENDING ({{ $pending_concerns->count() }})</small> --}}
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @else
   <!-- Content Row -->
                <div class="row">
      
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a class="text-primary" href="/home">  ROOMS</a></div>
                            <div id="count_rooms" class="h5 mb-0 font-weight-bold text-gray-800">{{ $units->count() }}</div>
                            
                            {{-- <small>O ({{ $units_occupied->count() }})</small>
                            <small>V ({{ $units_vacant->count() }})</small>
                            <small>R ({{ $units_reserved->count() }})</small> --}}
                            
                          </div>
                          <div class="col-auto">
                              <i class="fas fa-home fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
      
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" ><a class="text-success" href="/tenants">  ACTIVE TENANTS</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_tenants->count() }}</div>
                            {{-- <small>PENDING ({{ $pending_tenants->count() }})</small> --}}
                            
                          </div>
                          <div class="col-auto">
                          <i class="fas fa-users fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Pending Requests Card Example -->
                  <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1" ><a class="text-danger" href="#active-concerns">  ACTIVE CONCERNS</a></div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_concerns->count() }}</div>
                           
                            {{-- <small>PENDING ({{ $pending_concerns->count() }})</small> --}}
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-tools fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @endif

                <div class="row">
      
                  <!-- Area Chart -->
                  <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">OCCUPANCY RATE</h6>
                        {{-- <div class="dropdown no-arrow">
                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                          </a> 
                           <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div> 
                        </div> --}}
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                       
                          {!! $movein_rate->container() !!}
                        
                      </div>
                    </div>
                  </div>
      
                  <!-- Pie Chart -->
                  <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-3">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">RETENTION RATE</h6>
                        <div class="dropdown no-arrow">
                          {{-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                          </a> --}}
                          {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div> --}}
                        </div>
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        
                          {!! $renewed_chart->container() !!}
                        
                        {{-- <div class="mt-4 text-center small">
                          <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                          </span>
                          <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                          </span>
                          <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                          </span>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                </div>

      
                <!-- Content Row -->
                <div class="row">
                  
                  <!-- Content Column -->
                  <div class="col-lg-6 mb-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                     <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary">EXPIRING CONTRACTS</h6>
                         
                     </div>
                     <div class="card-body">
                      <div class="table-responsive text-nowrap">
                         <table class="table table-striped" >
                           <thead>
                             <tr>
                               <th>TENANT</th>
                               <th>ROOM</th>
                               <th>STATUS</th>
                               <th>ACTION</th>
                               <th>ACTION STATUS</th>
                           </tr>
                           </thead>
                           <tbody>
                             @foreach($tenants_to_watch_out as $item)
                             <?php   $diffInDays =  number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($item->moveout_date), false)) ?>
                              <tr>
                                  <td title="{{ $item->tenants_note }}">
                                    @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury' )
                                    <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}
                                    @else
                                    <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                    @endif  
                                  </td>
                                  <td>
                                    @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin' )
                                    <a href="/units/{{ $item->unit_id }}">{{ $item->building.' '.$item->unit_no }}</a>
                                    @else
                                   {{ $item->building.' '.$item->unit_no }}
                                    @endif
                                  </td>
                                  <td>
                                      @if($diffInDays <= -1)
                                      <span class="badge badge-danger">contract has lapsed {{ $diffInDays*-1 }} days ago</span>
                                       @else
                                      <span class="badge badge-warning">contract expires in {{ $diffInDays }} days </span>
                                       @endif
                                  </td>
                                  <td>
                                    @if($item->email_address === null)
                                    <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/edit#email_address" class="badge badge-warning">Please add an email</a>
                                    @else
                                    <form action="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/alert/contract">
                                      @csrf
                                      @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin')
                                      <button class="btn btn-primary d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-paper-plane fa-sm text-white-50"></i> Send Email</button>
                                      @else
                                      <button class="btn btn-primary d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" title="for manager and admin access only" type="submit" onclick="this.form.submit(); this.disabled = true;" disabled><i class="fas fa-paper-plane fa-sm text-white-50"></i> Send Email</button>
                                      @endif
                                    </form>
                                    @endif
                                  </td>
                                  <td><span class="badge badge-success">{{ $item->tenants_note }}</span></td>
                             </tr>
                            
                            
                             @endforeach
                           </tbody>
                         </table>
                         {{ $tenants_to_watch_out->links() }}
                       </div>
                     </div>
                   </div>
           
                       </div>

                        <!-- Pie Chart -->
                  <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-3">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">DELINQUENT TENANTS</h6>
                        
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                        <div class="table-responsive text-nowrap">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>TENANT</th>
                                <th>ROOM</th>
                                <th>AMOUNT</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach($delinquent_accounts as $item)
                              <tr>
                                <td title="{{ $item->tenants_note }}">
                                  @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury' )
                                  <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ $item->first_name.' '.$item->last_name }}
                                  @else
                                  <a href="{{ route('show-tenant',['unit_id' => $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                                  @endif
                                </td>
                                <td>
                                  @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin' )
                                  <a href="/units/{{ $item->unit_id }}">{{ $item->building.' '.$item->unit_no }}</a>
                                  @else
                                 {{ $item->building.' '.$item->unit_no }}
                                  @endif
                                </td>
                                <td>
                                  <a href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/billings">{{ number_format($item->balance,2) }}</a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          {{-- {{ $delinquent_accounts->links() }} --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                        <!-- Content Column -->
           <div class="col-lg-12 mb-4">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">DAILY COLLECTION</h6>
                
              
                  <a title="export" target="_blank" href="/property/{{ Auth::user()->property }}/export"><i class="fas fa-download "></i></a>
                
                
              </div>
             <div class="card-body">
              <div class="table-responsive text-nowrap">
                 <table class="table table-striped" >
                   <thead>
                    <tr>
                        <th>AR NO</th>
                        <th>BILL NO</th>
                        <th>TENANT</th>
                        <th>ROOM</th>
                        
                        <th>AMOUNT</th>
                        <th></th>
                    </tr>
                    
                  </thead>
                   <tbody>
                    @foreach ($collections_for_the_day as $item)
                    <tr>
                      <td>{{ $item->ar_no }}</td>
                       <td>{{ $item->payment_billing_no }}</td>
                        <td>{{ $item->first_name.' '.$item->last_name }}</td>
                        <td>{{ $item->building.' '.$item->unit_no }}</td>
                        
                        
                        <td>{{ number_format($item->total,2) }}</td>
                        <td>
                          <a title="export pdf" target="_blank" href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/payments/{{ $item->payment_id }}/dates/{{$item->payment_created}}/export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i></a>
                          {{-- <a id="" target="_blank" href="#" title="print invoice" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i></a>  --}}
                          
                        </td>
                    </tr>
                    @endforeach
                   </tbody>
                 </table>
                 <table class="table table-striped"" id="dataTable" width="100%" cellspacing="0">
                  <tr>
                   <th>TOTAL</th>
                   <th class="text-right">{{ number_format($collections_for_the_day->sum('total'),2) }}</th>
                  </tr>
                </table>
               </div>
             </div>
           </div>
   
               </div>
                </div>

                <div class="row" id="active-concerns">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ACTIVE CONCERNS</h6>            
                        </div>
                        <div class="card-body">
                          <div class="table-responsive text-nowrap">
               
               <table class="table table-striped">
                 <thead>
                   <tr>
                          <th>ID</th>
                          <th>DATE REPORTED</th>
                          <th>TENANT</th>
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
                          <td>
                              <a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }}</a>
                          </td>
                          <td> @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin' )
                            <a href="/units/{{ $item->unit_id }}">{{ $item->building.' '.$item->unit_no }}</a>
                            @else
                           {{ $item->building.' '.$item->unit_no }}
                            @endif</td>
                          <td>
                            
                              {{ $item->concern_type }}
                              
                          </td>
                          <td >
                            @if(Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'admin' )
                            <a title="{{ $item->concern_desc }}" href="/units/{{ $item->unit_id }}/tenants/{{ $item->tenant_id }}/concerns/{{ $item->concern_id }}">{{ $item->concern_item }}</a></td>
                            @else
                            {{ $item->concern_item }}
                            @endif

                            
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
                

                <!-- Content Row -->
      
                <div class="row">
      
                  <!-- Area Chart -->
                  <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                      <!-- Card Header - Dropdown -->
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">TOTAL COLLECTION</h6>
                        <div class="dropdown no-arrow">
                          {{-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                          </a> --}}
                          {{-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div> --}}
                        </div>
                      </div>
                      <!-- Card Body -->
                      <div class="card-body">
                       
                          {!! $collection_rate->container() !!}
                        
                      </div>
                    </div>
                  </div>
      
                 
                </div>
      
                <!-- Content Row -->
                <div class="row">
      
                  <div class="col-lg-6 mb-4">
      
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">FREQUENCY OF MOVEOUT</h6>
                      </div>
                      <div class="card-body">
                          {!! $moveout_rate->container() !!}
                      </div>
                    </div>
      
                  
      
                  </div>
      
                  <div class="col-lg-6 mb-4">
      
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">REASON FOR MOVING-OUT</h6>
                      </div>
                      <div class="card-body">
                        
                        {!! $reason_for_moving_out_chart->container() !!}
                      
                      {{-- <div class="mt-4 text-center small">
                        <span class="mr-2">
                          <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                          <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                          <i class="fas fa-circle text-info"></i> Referral
                        </span>
                      </div> --}}
                    </div>
                    </div>
      
                  </div>
                </div>
              
            <!-- Page Heading -->
         
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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="{{ route('logout') }}"
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

  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Congratulations!</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
            <div class="modal-body">
				      <p class="text-center">You've just completed setting-up your property.
                <br>
                Would you like to start adding rooms?
              </p>
            </div>
             <div class="modal-footer">
              <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> No, later</button>
              <a href="/home" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-check fa-sm text-white-50"></i> Yes, proceed</a>
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

{!! $movein_rate->script() !!}
{!! $renewed_chart->script() !!}
{!! $moveout_rate->script() !!}
{!! $collection_rate->script() !!}
{!! $reason_for_moving_out_chart->script() !!}

<script>
	$(document).ready(function(){

   if(document.getElementById('count_rooms').innerHTML <= 0){
      $("#myModal").modal('show');
    }
	});
</script>
</body>

</html>
