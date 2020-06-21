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
          {{-- <i class="fas fa-fw fa-tachometer-alt"></i> --}}
          <span>The Property Manager</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      {{-- <div class="sidebar-heading">
        Interface
      </div> --}}

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/leasing">
          <i class="fas fa-home"></i>
          <span>Leasing</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-home fa-cog"></i>
          <span>Residential</span>
          
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
            
            
          </div>
        </div>
      </li>


      <!-- Divider -->
      {{-- <hr class="sidebar-divider"> --}}

      {{-- <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div> --}}

      <!-- Nav Item - Pages Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li> --}}

      <!-- Nav Item - Charts -->

      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-user fa-chart-area"></i>
          <span>Tenants</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-user-tie fa-table"></i>
          <span>Unit Owners</span></a>
      </li>

       <!-- Nav Item - Tables -->
       <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-tools fa-table"></i>
          <span>Job Orders</span></a>
      </li>

       <!-- Nav Item - Tables -->
       <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-user-secret fa-table"></i>
          <span>Users</span></a>
      </li>
      

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

          {{ Auth::user()->property }}
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
            <li class="nav-item dropdown no-arrow mx-1">
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
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                {{-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> --}}
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/users/{{ Auth::user()->id }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
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
            <h5 style="text-align:left;">
                <a href="/units/{{ $tenant->unit_tenant_id }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> go back to unit</a>
                <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/edit" class="btn btn-primary"><i class="fas fa-user-edit"></i> edit</a>  
                <a href="{{ route('show-billings',['unit_id' => $tenant->unit_tenant_id, 'tenant_id'=>$tenant->tenant_id]) }}" class="btn btn-primary"><i class="fas fa-file-invoice-dollar"></i> billing <span class="badge badge-light">{{ $billings->count() }}</span> </a>
                <a href="{{ route('show-payments',['unit_id' => $tenant->unit_tenant_id, 'tenant_id'=>$tenant->tenant_id]) }}" class="btn btn-primary"><i class="fas fa-dollar-sign"></i> payment history <span class="badge badge-light">{{ $payments->count() }}</span></a>
                <span style="float:right;">
                    {{-- <form action="/tenants/{{ $tenant->tenant_id }}" method="POST">
                        {{ csrf_field() }}
                        @method('delete')
                        <button type="submit">Delete</button>
                    </form> --}}
                <a class="btn btn-primary" data-toggle="modal" data-target="#extendTenant" data-whatever="@mdo"><i class="fas fa-external-link-alt"></i> extend/renew</a>
                @if ($tenant->tenant_status === 'active' || $tenant->tenant_status === 'pending')
                    @if($pending_balance > 0)
                <a class="btn btn-danger" data-toggle="modal" data-target="#moveoutTenantWarning" data-whatever="@mdo"><i class="fas fa-sign-out-alt"></i> moveout</a>
                    @else
                <a class="btn btn-danger" data-toggle="modal" data-target="#moveoutTenant" data-whatever="@mdo"><i class="fas fa-sign-out-alt"></i> moveout</a>
                    @endif
                @else
                @endif
                </span>
            </h5>
            <table class="table table-striped">
                <tr>
                        <th colspan="2">Personal Information</th>
                    </tr>
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
                        <th colspan="2">Contact Information</th
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
                        <th colspan="2">Person to contact in case of emergency</th>
        
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
                        <th>Education Background</th>
                        <td></td>
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
                        <th colspan="2">Employment Information</th>
        
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
                        <th colspan="2">Rental Information</th>
                    </tr>
                    <tr>
                        <td>Monthly Rent</td>
                        <td>{{ number_format($tenant->tenant_monthly_rent, 2) }}</td>
                    </tr>
                    <?php 
                        $renewal_history = explode(",", $tenant->renewal_history); 
                        $diffInMonths =  number_format(Carbon\Carbon::now()->floatDiffInMonths(Carbon\Carbon::parse($tenant->moveout_date), false));
                        $diffInDays =  number_format(Carbon\Carbon::now()->DiffInDays(Carbon\Carbon::parse($tenant->moveout_date), false));
                    ?>
                    <tr>
                        <td>Contract Duration</td>
                        <td>{{ Carbon\Carbon::parse($tenant->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }} <a class="badge badge-primary">{{ $tenant->has_extended}} 
                            @if( count($renewal_history) > 1)
                            ({{ count($renewal_history)-1 }}x) </a>  
                            @endif
                            @if($diffInDays <= -1)
                            <span class="badge badge-danger">contract has lapsed {{ $diffInDays*-1 }} days ago</span> 
                             @else
                            <a class="badge badge-warning">contract expires in {{ $diffInDays }} days </a>
                             @endif
                            </a>  
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Contract Renewal History</td>
                        <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
                        <td>
                            @for ($i = 1; $i < count($renewal_history); $i++)
                               @if($i <= 1)
                               {{ 'Initial contract: '.$renewal_history[$i] }}<br>
                               @else
                               {{ $numberFormatter->format($i-1) .' renewal: '.$renewal_history[$i] }}<br>
                               @endif
                               
                                
                            @endfor     
                        </td>
                    </tr>
                    <tr>
                        <td>Note</td>
                        <td>
                            {{ $tenant->tenants_note }}
                        </td>
                    </tr>
                </table>
        </div>
        {{-- Modal to moveout tenant --}}
        <div class="modal fade" id="moveoutTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Moveout </h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="moveoutTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" method="POST">
                        {{ csrf_field() }}
                    </form>
                    <input type="hidden" form="moveoutTenantForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}"required>
                    <input type="hidden" form="moveoutTenantForm" id="tenant_id" name="tenant_id" value="{{ $tenant->tenant_id }}"required>
                    <div class=" row">
                        <div class="col">
                            <label for="moveout_date">move out date</label>
                            <input type="date" form="moveoutTenantForm" class="form-control" name="actual_move_out_date" id="actual_moveout_date" value={{date('Y-m-d')}} required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="ex1">reason for moving-out</label>
                              <select form="moveoutTenantForm" class="form-control" name="reason_for_moving_out" id="reason_for_moving_out">
                                  <option value="end of contract" selected>end of contract</option>
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
                            <p>
                                moveout charges
                                @foreach ($security_deposits as $item)
                                    <ul>
                                        <li>{{ $item->payment_note.' - '. number_format($item->amt_paid,2)}} </li>
                                    </ul>
                                @endforeach
                                <span style="float:right">
                                    <a id="add_row" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    <a id='delete_row' class="btn btn-danger"><i class="fas fa-minus"></i></a>
                                </span>
                            </p>
                            <br>
                            <table class = "table table-hover " id="tab_logic">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>description</th>
                                    <th>amount</th>
                                </tr>
                                    <input form="moveoutTenantForm" type="hidden" id="no_of_items" name="no_of_items" >
                                <tr id='addr1'></tr>
                            </table>
                        </div>
                      </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> cancel</button>
                    <button form="moveoutTenantForm" type="submit" class="btn btn-danger" ><i class="fas fa-check"></i> moveout</button>
                </div>
            </div>
            </div>
        </div>
        </div>
        
        {{-- Modal for renewing tenant --}}
        <div class="modal fade" id="extendTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extend/Renew</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="extendTenantForm" action="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/renew" method="POST">
                        {{ csrf_field() }}
                    </form>
        
                    <div class="row">
                        <div class="col">
                            <label for="movein_date">enter the new move in date</label>
                            <input type="date" form="extendTenantForm" class="form-control" name="movein_date" value="{{ $tenant->moveout_date }}" required>
                            {{-- <input type="text" form="" class="form-control" name="" value="{{ Carbon\Carbon::parse($tenant->moveout_date)->format('M d Y') }}" required readonly> --}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="moveout_date">extend contract to </label>
                            <input type="number" form="extendTenantForm" class="form-control" name="no_of_months" min="1" placeholder="enter no of months" required >
                            <input type="hidden" form="extendTenantForm" class="form-control" name="old_movein_date" value="{{ $tenant->movein_date }}" required>
                        </div>
                    </div>
                     <br>
                    
                    <div class="row">
                        <div class="col">
                            <p>
                                additional charges
                                <small class="text-danger">(optional)</small>
                                <span style="float:right">
                                    <a id="add_charges" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    <a id='remove_charges' class="btn btn-danger"><i class="fas fa-minus"></i></a>
                                </span>
                            </p>
                            <br>
                                <table class = "table table-hover " id="extend_table">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>description</th>
                                        <th>amount</th>
                                    </tr>
                                        <input form="extendTenantForm" type="hidden" id="no_of_row" name="no_of_row" >
                                        <input form="extendTenantForm" type="hidden" id="current_date" name="current_date" value="{{ date('Y-m-d') }}">
                                    
                                    <tr id='row1'></tr>
                                </table>
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> cancel</button>
                    <button form="extendTenantForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> extend/renew</button>
                </div>
            </div>
            </div>
        </div>
        
        {{-- Modal for warning message --}}
        <div class="modal fade" id="moveoutTenantWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tenant can't move out</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                   <p class="text-center">
                       Tenant has a pending balance of <a title="click this to see the breakdown" href=#billing>{{ number_format($pending_balance,2) }}</a>.
                   </p>
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
    $(document).ready(function(){
        var i=1;
    $("#add_row").click(function(){
        $('#addr'+i).html("<th>"+ (i) +"</th><td><input form='moveoutTenantForm' name='desc"+i+"' id='desc"+i+"' type='text' class='form-control input-md'></td><td><input form='moveoutTenantForm'   name='amt"+i+"' id='amt"+i+"' type='number' min='1' class='form-control input-md'></td>");


     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;

     document.getElementById('no_of_items').value = i;
 });

    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        document.getElementById('no_of_items').value = i;
        }
    });

        var j=1;
    $("#add_charges").click(function(){
        $('#row'+j).html("<th class='text-center'>"+ (j) +"</th><td><select form='extendTenantForm' name='desc"+j+"' name='desc"+j+"' class='form-control'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option></select></td><td><input form='extendTenantForm' name='amt"+j+"' type='number' min='1' class='form-control input-md'></td>");

     $('#extend_table').append('<tr id="row'+(j+1)+'"></tr>');
     j++;
        document.getElementById('no_of_row').value = j;

 });

    $("#remove_charges").click(function(){
        if(j>1){
        $("#row"+(j-1)).html('');
        j--;
        document.getElementById('no_of_row').value = j;
        }
    });
});
</script>

</body>

</html>
