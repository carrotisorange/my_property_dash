<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{$tenant->first_name.' '.$tenant->last_name}} | Edit</title>

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

            <!-- Nav Item - Alerts -->
            {{--     <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if($request_to_moveout->count() > 3)
                  <span class="badge badge-danger badge-counter">{{ $request_to_moveout->count() }}+</span>
                @else
                  <span class="badge badge-danger badge-counter">{{ $request_to_moveout->count()  }}</span>
                @endif
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                @foreach($request_to_moveout as $item)
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                  <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</div>
                    <span class="font-weight-bold">{{ $item->building.' '.$item->unit_no }} is requesting to moveout.</span>
                  </div>
                </a> 
                @endforeach 
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li> 

            <!-- Nav Item - Messages -->
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
          
        <!-- 404 Error Text -->
        <form id="editTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
            @method('put')
            {{ csrf_field() }}
        </form>
         
                    <div class="form-group row">
                        <div class="col">
                            <small>First Name</small>
                            <input form="editTenantForm" class="form-control" type="text" name="first_name" value="{{ $tenant->first_name }}">
                        </div>
                        <div class="col">
                            <small>Middle Name</small>
                            <input form="editTenantForm" class="form-control" type="text" name="middle_name" value="{{ $tenant->middle_name }}">
                        </div>
                        <div class="col">
                            <small>Last Name</small>
                            <input form="editTenantForm" class="form-control" type="text" name="last_name" value="{{ $tenant->last_name }}">
                        </div>
                    </div>
             
                    <div class="form-group row">
                        <div class="col">
                            <small>Gender</small>
                            <select form="editTenantForm" class="form-control" name="gender" id="">
                                <option value="{{ $tenant->gender }}">{{ $tenant->gender }}</option>
                                <option value="female">female</option>
                                <option value="male">male</option>
                            </select>
                        </div>
                        <div class=" col">
                            <small>Birthdate</small>
                            <input form="editTenantForm" class="form-control" type="date" name="birthdate" value="{{ $tenant->birthdate }}">
                        </div>
                        <div class="col">
                            <small>Civil Status:</small>
                            <select form="addTenantForm"  id="civil_status" name="civil_status" class="form-control">
                                <option value="{{ $tenant->civil_status }}" selected>{{ $tenant->civil_status }}</option>
                                <option value="single" selected>single</option>
                                <option value="married">married</option>
                            </select>
                        </div>
                        <div class=" col">
                            <small>ID/ID number</small>
                            <input form="editTenantForm" class="form-control" type="text" name="id_number" value="{{ $tenant->id_number }}">
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class=" col-md-8">
                            <small for="">Barangay</small>
                            <input form="editTenantForm" class="form-control" type="text" name="barangay" value="{{ $tenant->barangay }}">
                        </div>
                        <div class=" col-md-4">
                            <small for="">City</small>
                            <input form="editTenantForm" class="form-control" type="text" name="city" value="{{ $tenant->city }}">
                        </div>
                       
                    </div>
                    <div class="form-group row">
                        <div class=" col-md-4">
                            <small for="">Province</small>
                            <input form="editTenantForm" class="form-control" type="text" name="province" value="{{ $tenant->province }}">
                        </div>
                        <div class=" col-md-4">
                            <small for="">Country</small>
                            <input form="editTenantForm" class="form-control" type="text" name="country" value="{{ $tenant->country }}">
                        </div>
                        <div class=" col-md-4">
                            <small for="">Zipcode</small>
                            <input form="editTenantForm" class="form-control" type="text" name="zip_code" value="{{ $tenant->zip_code }}">
                        </div>
                    </div>
  
                    <div class="form-group row">
                        <div class="col">
                            <small for="">Contact No</small>
                            <input form="editTenantForm" class="form-control" type="text" name="contact_no" value="{{ $tenant->contact_no }}">
                        </div>
                        <div class="col" id="email_address">
                            <small for="">Email Address</small>
                            <input form="editTenantForm" class="form-control" type="text" name="email_address" value="{{ $tenant->email_address }}">
                          @if($tenant->email_address === null)
                          <small class="text-danger">Please add an email</small>
                          @endif
                        </div>
                    </div>
               
                    <hr>
                    <div class="form-group row">
                        <div class="col">
                            <small for="">Guardian</small>
                            <input form="editTenantForm" class="form-control" type="text" name="guardian" value="{{ $tenant->guardian }}">
                        </div>
                        <div class="col">
                            <small for="">Relationhip to the tenant</small>
                            <input form="editTenantForm" class="form-control" type="text" name="guardian_relationship" value="{{ $tenant->guardian_relationship }}">
                        </div>
                        <div class="col">
                            <small for="">Contact no</small>
                            <input form="editTenantForm" class="form-control" type="text" name="guardian_contact_no" value="{{ $tenant->guardian_contact_no }}">
                        </div>
                    </div>
    
                    <hr>
  
                    <div class="form-group row">
                        <div class="col">
                            <small for="">High School</small>
                            <input form="editTenantForm" class="form-control" type="text" name="high_school" value="{{ $tenant->high_school }}">
                        </div>
                        <div class="col">
                            <small for="">Adddress</small>
                            <input form="editTenantForm" class="form-control" type="text" name="high_school_address" value="{{ $tenant->high_school_address }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <small for="">College/University</small>
                            <input form="editTenantForm" class="form-control" type="text" name="college_school" value="{{ $tenant->college_school }}">
                        </div>
                        <div class="col">
                            <small for="">Address</small>
                            <input form="editTenantForm" class="form-control" type="text" name="college_school_address" value="{{ $tenant->college_school_address }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <small for="">Course</small>
                            <input form="editTenantForm" class="form-control" type="text" name="course" value="{{ $tenant->course }}">
                        </div>
                        <div class="col">
                            <small for="">Year Level</small>
                            <select form="editTenanForm" class="form-control" name="year_level" id="">
                                <option value="{{ $tenant->year_level }}">{{ $tenant->year_level }}</option>
                                  <option value="senior high">junior high</option>
                                  <option value="first year">first year</option>
                                  <option value="second year">second year</option>
                                  <option value="third year">third year</option>
                                  <option value="fourth year">fourth year</option>
                                  <option value="fifth year">fifth year</option>
                                  <option value="graduate student">graduate student</option>
                              </select>
                        </div>
                    </div>
    
                    <hr>
    
        
                    <div class="form-group row">
                        <div class="col">
                            <small for="">Employer/Company</small>
                            <input form="editTenantForm" class="form-control" type="text" name="employer" value="{{ $tenant->employer }}">
                        </div>
                        <div class="col">
                            <small for="">Position/Job description</small>
                            <input form="editTenantForm" class="form-control" type="text" name="job" value="{{ $tenant->job }}">
                        </div>
                        <div class="col">
                            <small for="">Years of Employment</small>
                            <input form="editTenantForm" class="form-control" type="number" name="years_of_employment" value="{{ $tenant->years_of_employment }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <small for="">Address</small>
                            <input form="editTenantForm" class="form-control" type="text" name="employer_address" value="{{ $tenant->employer_address }}">
                        </div>
                        <div class="col">
                            <small for="">Contact No</small>
                            <input form="editTenantForm" class="form-control" type="text" name="employer_contact_no" value="{{ $tenant->employer_contact_no }}">
                        </div>
                        
                    </div>
                    <hr>
                    @if($tenant->tenants_note !== 'new' )
                    <div class="form-group row">
                        <div class="col">
                          <small>Note</small>
                            <textarea form="editTenantForm" class="form-control" name="tenants_note" id="" cols="30" rows="5">
                                {{ $tenant->tenants_note }}
                            </textarea>
                        </div>
                    </div>
                    @endif
    
    
        <p class="text-right">   
            <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</a>
            <button type="submit" form="editTenantForm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check fa-sm text-white-50"></i> Update Tenant</button>
        </p>
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

</body>

</html>
