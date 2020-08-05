<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

     <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    {{-- <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      
      <div class="sidebar-brand-text mx-5"> </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0"> --}}

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="/">
        <span>The Property Manager</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- <!-- Heading -->
     <div class="sidebar-heading">
      Interface
    </div>  --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link" href="/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
    <li class="nav-item active">
      <a class="nav-link" href="/home">
        <i class="fas fa-home"></i>
        <span>Home</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/tenants">
        <i class="fas fa-users fa-chart-area"></i>
        <span>Tenants</span></a>
    </li>

   @if(Auth::user()->property_ownership === 'Multiple Owners')
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
          <i class="fas fa-tools fa-table"></i>
          <span>Concerns</span></a>
      </li>

      
              <!-- Nav Item - Tables -->
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

  </ul>
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

           {{ Auth::user()->property.' '.Auth::user()->property_type }}
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

            {{-- <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> --}}

            <!-- Nav Item - Alerts -->
            {{-- <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> --}}

            <!-- Nav Item - Messages -->
            {{-- <li class="nav-item dropdown no-arrow mx-1">
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
                  <h1 class="h3 mb-0 text-gray-800">Home</h1>
                 @if(Auth::user()->user_type === 'manager')
                 <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addMultipleUnits" data-whatever="@mdo"><i class="fas fa-plus fa-sm text-white-50"></i> Add multiple rooms</a>
                 @endif
                </div>
                <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-home fa-sm text-white-50"></i> OCCUPIED</span>
                <span class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" ><i class="fas fa-home fa-sm text-white-50"></i> VACANT</span>
                <span class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" ><i class="fas fa-home fa-sm text-white-50"></i> RESERVED</span>
                <br><br>
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All<span class="badge badge-light">{{ $units_count }}</span></a>
                    @foreach ($buildings as $building)
                    <a class="nav-item nav-link" id="{{ $building->building }}-tab" data-toggle="tab" href="#{{ $building->building }}" role="tab" aria-controls="{{ $building->building }}" aria-selected="false">{{ $building->building }}<span class="badge badge-light">{{ $building  ->count }}</span></a>
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
                  @endif
                @endif
                
                </p>
              
                @foreach ($floor_no_list as $item)
                  @if($item->status === 'vacant')
                      <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-secondary">
                          <i class="fas fa-home fa-3x"></i>
                          <br>
                          {{ $item->unit_no }}
                      </a>
                      @elseif($item->status=== 'reserved')
                      <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-warning">
                          <i class="fas fa-home fa-3x"></i>
                          <br>
                         {{ $item->unit_no }}
                        </a>
                      @elseif($item->status=== 'occupied')
                        <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-primary">
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
                        @endif
                      @endif
                      
                      </p>
                    
                      @foreach ($floor_no_list as $item)
                      @if($building->building === $item->building)
                        @if($item->status === 'vacant')
                            <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-secondary">
                                <i class="fas fa-home fa-3x"></i>
                                <br>
                                {{ $item->unit_no }}
                            </a>
                            @elseif($item->status=== 'reserved')
                            <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-warning">
                                <i class="fas fa-home fa-3x"></i>
                                <br>
                               {{ $item->unit_no }}
                              </a>
                            @elseif($item->status=== 'occupied')
                              <a title="{{ $item->type_of_units }}" href="/units/{{$item->unit_id}}" class="btn btn-primary">
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
              
        </div>
        
      </div>
     
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Godie Enterprises 2020</span>
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

<div class="modal fade" id="addMultipleUnits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel" >ENTER ROOM INFORMATION</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="addUMultipleUnitForm" action="/units/add-multiple" method="POST">
              {{ csrf_field() }}
          </form>

          <div class="form-group">
              <label for="recipient-name" class="col-form-label">ENTER THE NAME OF BUILDING</label>
              <input form="addUMultipleUnitForm" type="text" class="form-control" name="building" placeholder="Building-A" required>
              <small class="text-danger">please put hyphen(-) between spaces</small>
          </div>

          <div class="form-group">
              <label for="recipient-name" class="col-form-label">SELECT THE FLOOR NO</label>
              <select class="form-control" form="addUMultipleUnitForm" name="floor_no" id="floor_no" onkeyup="getFloorNo()" required>
                  <option value="" selected>Please select one</option>
                                    <option value="-3">3rd basement</option>
                                    <option value="-2">2nd basement</option>
                                    <option value="-1">1st basement</option>
                                   
                                    <option value="1">1st floor</option>
                                    <option value="2">2nd floor</option>
                                    <option value="3">3rd floor</option>
                                    <option value="4">4th floor</option>
                                    <option value="5">5ht floor</option>
                                    <option value="6">6th floor</option>
                                    <option value="7">7th floor</option>
                                    <option value="8">8th floor</option>
                                    <option value="9">9th floor</option>
              </select>
          </div>

           <div class="form-group">
              <label for="recipient-name" class="col-form-label">SELECT THE ROOM TYPE</label>
              <select form="addUMultipleUnitForm" class="form-control" name="type_of_units" required>
                  <option value="" selected>Please select one</option>
                  <option value="leasing">leasing</option>
                  <option value="commercial">commercial</option>
                  <option value="residential">residential</option>
              </select>
          </div> 

          @if(Auth::user()->property_type === 'Condominium Associations')
                <input form="addUMultipleUnitForm" type="number" class="form-control" name="beds" value="0" required> 
            @else
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">ENTER THE NO OF BED</label>
                <input form="addUMultipleUnitForm" type="number" class="form-control" name="beds" required>
            </div>
            @endif

          

          <div class="form-group">
              <label for="recipient-name" class="col-form-label">ENTER THE NO OF ROOMS YOU WANT TO CREATE</label>
              <input form="addUMultipleUnitForm" type="number" class="form-control" name="no_of_rooms"required>
          </div>

          <div class="form-group">
              <label for="recipient-name" class="col-form-label">ENTER THE INITIAL NAME OF THE ROOMS </label>
              <input form="addUMultipleUnitForm" type="text" class="form-control" name="unit_no" id="unit_no" required>
          </div>

          @if(Auth::user()->property_type === 'Condominium Associations')
                <input form="addUnitForm" type="hidden" min="1" class="form-control" name="monthly_rent" id="monthly_rent" value="0" required>
            @else
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">ENTER THE RENT/MONTH</label>
                <input form="addUnitForm" type="number" min="1" class="form-control" name="monthly_rent" id="monthly_rent" required>
            </div>
            @endif

      </div>
      <div class="modal-footer">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
          <button form="addUMultipleUnitForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-check"></i> Create Rooms</button>
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

  <script>
    $(document).ready(() => {
    var url = window.location.href;
    if (url.indexOf("#") > 0){
    var activeTab = url.substring(url.indexOf("#") + 1);
      $('.nav[role="tablist"] a[href="#'+activeTab+'"]').tab('show');
    }

    $('a[role="tab"]').on("click", function() {
      var newUrl;
      const hash = $(this).attr("href");
        newUrl = url.split("#")[0] + hash;
      history.replaceState(null, null, newUrl);
    });
  });
  </script>

</body>

</html>
