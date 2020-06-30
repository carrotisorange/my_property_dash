<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ $unit->building.' '.$unit->unit_no }}</title>

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
      <li class="nav-item">
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

  @if(Auth::user()->user_type === 'admin')
  <li class="nav-item active">
    <a class="nav-link" href="/home">
      <i class="fas fa-home"></i>
      <span>Home</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/tenants">
      <i class="fas fa-user fa-chart-area"></i>
      <span>Tenants</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="/owners">
      <i class="fas fa-user-tie"></i>
      <span>Unit Owners</span></a>
  </li>

    <!-- Nav Item - Tables -->
  <li class="nav-item">
      <a class="nav-link" href="/joborders">
        <i class="fas fa-tools fa-table"></i>
        <span>Job Orders</span></a>
    </li>
  @endif

   @if(Auth::user()->user_type === 'billing')
    <!-- Nav Item - Tables -->
    <li class="nav-item">
      <a class="nav-link" href="/billing-and-collection">
        <i class="fas fa-file-invoice-dollar fa-table"></i>
        <span>Billing and collection</span></a>
    </li>
   @endif

   @if(Auth::user()->user_type === 'treasury')
      <li class="nav-item">
      <a class="nav-link" href="/payments">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Payments</span></a>
    </li>

    @endif

  @if(Auth::user()->user_type === 'manager')
   <!-- Nav Item - Tables -->
   <li class="nav-item">
    <a class="nav-link" href="/users">
      <i class="fas fa-user-secret fa-table"></i>
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
                <i class="fas fa-user-circle"></i> 
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
          @foreach (['danger', 'warning', 'success', 'info'] as $key)
          @if(Session::has($key))
         <p class="alert alert-{{ $key }}"> <i class="fas fa-check-circle"></i> {{ Session::get($key) }}</p>
          @endif
          @endforeach
                {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                  <h1 class="h3 mb-0 text-gray-800">{{ $unit->building.' '.$unit->unit_no }}</h1>
                  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> 
                </div> --}}

                <div class="row">
                    <div class="col-md-6">
                      
                        <button type="button" title="edit unit/room information." class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#editUnit" data-whatever="@mdo"><i class="fas fa-edit fa-sm text-white-50"></i>EDIT</button> 
                        @if ($tenant_active->count() < $unit->beds)
                        <a href="/units/{{ $unit->unit_id }}/tenant-step1" title="{{ $unit->beds - $tenant_active->count() }} remaining tenant/s to be fully occupied." type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i> TENANT <span class="badge badge-light">{{  $tenant_active->count() }}/{{ $unit->beds }} </a>

                        @else
                        <a href="#/" title="{{ $unit->beds - $tenant_active->count() }} remaining tenant/s to be fully occupied." data-toggle="modal" data-target="#warningTenant" data-whatever="@mdo" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i> TENANT <span class="badge badge-light">{{  $tenant_active->count() }}/{{ $unit->beds }} 
                          </a>
                        @endif
                        {{-- if unit owner does not exist in this unit, then show the add investor button, otherwise, hide. --}}
                        @if ($unit_owner->count() < 1)
                        <a href="#/" data-toggle="modal" data-target="#addInvestor" data-whatever="@mdo" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                          <i class="fas fa-user-plus fa-sm text-white-50"></i> OWNER 
                        </a>   
                        @endif
                        <br> <br>
                            <?php $numberFormatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL) ?>
                            <div class="table-responsive">
                              <table class="table table-bordered" width="100%" cellspacing="0">
                                   <tr>
                                       <th colspan="2" >ROOM/UNIT INFORMATION</th>
                                   </tr>
                                   <tr>
                                        <th>UNIT/ROOM NO</th>
                                        <td>{{ $unit->unit_no }}</td>
                                   </tr>
                                   {{-- <tr>
                                    <th>LAST UPDATED AT</th>
                                    <td>{{ $unit->updated_at }}</td>
                               </tr> --}}
                                  {{-- <tr>
                                    <th></th>
                                    <th>
                                         <form action="/units/{{ $unit->unit_id }}" method="POST">
                                          @csrf
                                          @method('delete')
                                          <button type="submit">Delete</button>
                                      </form> 
                                    </th>
                                  </tr> --}}
                                    <tr>
                                        <th>BUILDING</th>
                                        <td>{{ $unit->building }}</td>
                                   </tr>
                                   <tr>
                                        <th>FLOOR NO</th>
                                        <td>{{ $numberFormatter->format($unit->floor_no) }}</td>
                                   </tr>
                                   <tr>
                                        <th>UNIT/ROOM TYPE</th>
                                        <td>{{ $unit->type_of_units }}</td>
                                   </tr>
                                   <tr>
                                        <th>NO OF BEDS</th>
                                        <td>{{ $unit->beds }}</td>     
                                    </tr>
                                    <tr>
                                        <th>STATUS</th>
                                        <td>{{ $unit->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>MONTHLY RENT <br>(excluding utilities)</th> 
                                        <td>{{ number_format($unit->monthly_rent,2) }}</td>
            
                                        <?php 
                                            session([Auth::user()->property.'tenant_monthly_rent'=> $unit->monthly_rent]);
                                            session([Auth::user()->property.'unit_id'=> $unit->unit_id]);
                                            session([Auth::user()->property.'unit_no'=> $unit->unit_no]);
                                            session([Auth::user()->property.'building'=> $unit->building]);
                                        ?>
                                    </tr>
                                    @if ($unit_owner->count() > 0)
                                        @foreach ($unit_owner as $item)
                                    
                                    <tr>
                                        <th colspan="2">OWNER INFORMATION</th>
                                        
                                    </tr>
                                    <tr>
                                        <th>OWNER </th>
                                        <td><a href="{{ route('show-investor',['unit_id'=> $item->unit_id, 'unit_owner_id'=>$item->unit_owner_id]) }}">{{ $item->unit_owner }} </a></td>
                                    </tr>
                                    <tr>
                                        <th>REPRESENTATIVE</th>
                                        <td>{{ $item->investor_representative }}</td>
                                    </tr>
                                    <tr>
                                        <th>CONTRACT PERIOD</th>
                                        <td>
                                            @if($item->contract_end == NULL)
                                                {{ Carbon\Carbon::parse($item->contract_start)->format('M d Y') }} (Renewable) 
                                            @else
                                                {{ Carbon\Carbon::parse($item->contract_start)->format('M d Y') .'-'. Carbon\Carbon::parse($item->contract_end)->format('M d Y')  }} 
                                            @endif
                                        </td>
                                    </tr>
                                        @endforeach
                                    @endif
                               </table>
                              </div>
                    </div>
                
                    
                    <div class="col-md-6">
                      <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" data-toggle="tab" href="#active" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-user-check fa-sm text-50"></i>&nbsp&nbspACTIVE  <span class="badge badge-light">{{ $tenant_active->count() }}</span></a>
                          <a class="nav-item nav-link"  data-toggle="tab" href="#reserved" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-user-clock fa-sm text-50"></i>&nbsp&nbspRESERVED <span class="badge badge-light">{{ $tenant_reservations->count() }}</a>
                          <a class="nav-item nav-link"  data-toggle="tab" href="#inactive" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-user-times fa-sm text-50"></i>&nbsp&nbspINACTIVE <span class="badge badge-light">{{ $tenant_inactive->count() }}</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="nav-home-tab">
                          <div class="table-responsive">
                          <table class="table table-borderless">
                            @if($tenant_active->count() <= 0)
                            <tr>
                                <br><br><br>
                                <p class="text-center">NO TENANTS FOUND!</p>
                            </tr>
                            @else
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                <th>CONTRACT PERIOD</th>   
                            </tr>
                            <?php $ctr = 1; ?>   
                        @foreach ($tenant_active as $item)
                            <tr>
                                <th class="text-center">{{ $ctr++ }}</th>
                                <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }} </a></td>
                                <td title="{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($item->moveout_date), false) }} days left">{{ Carbon\Carbon::parse($item->movein_date)->format('M d Y').'-'.Carbon\Carbon::parse($item->moveout_date)->format('M d Y') }}</>
                            </tr>
                        @endforeach
                            @endif                        
                        </table>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="reserved" role="tabpanel" aria-labelledby="nav-profile-tab">
                          <div class="table-responsive">
                          <table class="table table-borderless">
                            @if($tenant_reservations->count() <= 0)
                            <tr>
                                <br><br><br>
                                <p class="text-center">NO TENANTS FOUND!</p>
                            </tr>
                            @else
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                <th>RESERVED VIA</th>
                                <th>RESERVATION DATE</th>   
                                         
                                <th></th>
                            </tr>
                            <?php
                                $ctr = 1;
                            ?>   
                        @foreach ($tenant_reservations as $item)
                            <tr>
                                <th class="text-center">{{ $ctr++ }}</th>
                                <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }} </a></td>
                                @if($item->type_of_tenant === 'online')
                                <td><a class="badge badge-success">{{ $item->type_of_tenant }}</td>
                                @else
                                <td><a class="badge badge-warning">{{ $item->type_of_tenant }}</td>
                                @endif
                                <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                                <th>{{ Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($item->created_at)->addDays(7), false) }} days before exp</th>
                            </tr>
                        @endforeach
                            @endif                        
                        </table>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="nav-contact-tab">
                          <div class="table-responsive">
                          <table class="table table-borderless">
                            @if($tenant_inactive->count() <= 0)
                            <tr>
                                <br><br><br>
                                <p class="text-center">NO TENANTS FOUND!</p>
                            </tr>
                            @else
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                
                                <th>MOVEOUT SINCE</th>   
                                         
                                <th></th>
                            </tr>
                            <?php
                                $ctr = 1;
                            ?>   
                        @foreach ($tenant_inactive as $item)
                            <tr>
                                <th class="text-center">{{ $ctr++ }}</th>
                                <td><a href="{{ route('show-tenant',['unit_id'=> $item->unit_id, 'tenant_id'=>$item->tenant_id]) }}">{{ $item->first_name.' '.$item->last_name }} </a></td>
                                
                                <td>{{ Carbon\Carbon::parse($item->moveout_date)->format('M d Y') }}</td>
                            </tr>
                        @endforeach
                            @endif                        
                        </table>
                          </div>
                        </div>
                      </div>
                    </div>        
                </div>
            
                    {{-- Modal to edit unit --}}
            
                    <div class="modal fade" id="editUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT UNIT/ROOM</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form id="editUnitForm" action="/units/{{$unit->unit_id }}" method="POST">
                                @method('put')
                                {{ csrf_field() }}
                            </form>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">UNIT/ROOM NO</label>
                                <input form="editUnitForm" type="text" value="{{ $unit->unit_no }}" name="unit_no" class="form-control" id="unit_no" >
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">FLOOR NO:</label>
                                <select form="editUnitForm" id="floor_no" name="floor_no" class="form-control">
                                    <option value="{{ $unit->floor_no }}" readonly selected class="bg-primary">{{ $unit->floor_no }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">5</option>
                                    <option value="5">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">BUILDING:</label>
                                    <input form="editUnitForm" type="text" value="{{ $unit->building }}" name="building" class="form-control">
                                    {{-- <select form="editUnitForm" id="building" name="building" class="form-control">
                                        <option value="{{ $unit->building }}" readonly selected class="bg-primary">{{ $unit->building }}</option>
                                        @foreach ($units_per_building as $item)
                                        <option value="{{ $item->building }}">{{ $item->building }}</option>
                                       @endforeach
                                    </select> --}}
                                    </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">ROOM TYPE</label>
                                <select form="editUnitForm" id="type_of_units" name="type_of_units" class="form-control">
                                    <option value="{{ $unit->type_of_units }}" readonly selected class="bg-primary">{{ $unit->type_of_units }}</option>
                                    <option value="leasing">leasing</option>
                                    <option value="commercial">commercial</option>
                                    <option value="residential">residential</option>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">NO OF BEDS</label>
                                <input form="editUnitForm" min="1" max="4" type="number" value="{{ $unit->beds }}" name="beds" class="form-control">
                                </div>
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">UNIT/ROOM STATUS</label>
                                <select form="editUnitForm" id="status" name="status" class="form-control">
                                    <option value="{{ $unit->status }}" readonly selected class="bg-primary">{{ $unit->status }}</option>
                                    <option value="vacant">vacant</option>
                                    <option value="occupied">occupied</option>
                                    <option value="pulled out">pulled out</option>
                                    <option value="reserved">reserved</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">MONTHLY RENT</label>
                                    <input form="editUnitForm" min="1" type="number" value="{{ $unit->monthly_rent }}" name="monthly_rent" class="form-control">
                                    </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> CLOSE</button>
                            <button form="editUnitForm" type="submit" class="btn btn-primary" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-check"></i> UPDATE UNIT/ROOM</button>
                            </div>oncl
                        </div>
                        </div>
                    </div>
            
                    {{-- Modal to add investor --}}
                    <div class="modal fade" id="addInvestor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ADD UNIT OWNER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form id="addInvestorForm" action="/units" method="POST">
                                {{ csrf_field() }}
                            </form>
                            <div class="modal-body">
                                <input form="addInvestorForm" type="hidden" value="{{ $unit->unit_id }}" name="unit_id">
                                {{-- <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Date Invested:</label>
                                <input form="addInvestorForm" type="date" value="{{ date("Y-m-d")  }}" class="form-control" name="date_invested" id="date_invested">
                                </div> --}}
            
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">NAME</label>
                                <input form="addInvestorForm" type="text"  value="{{ $unit->unit_owner }}" class="form-control" name="unit_owner" id="unit_owner" required>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">EMAIL</label>
                                    <input form="addInvestorForm" type="email" class="form-control" name="investor_email_address" id="investor_email_address">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">MOBILE</label>
                                    <input form="addInvestorForm" type="text" class="form-control" name="contact_no" id="contact_no">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">ADDRESS</label>
                                    <input form="addInvestorForm" type="text" class="form-control" name="investor_address" id="investor_address"    >
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">REPRESENTATIVE</label>
                                    <input form="addInvestorForm" type="text" class="form-control" name="investor_representative" id="investor_representative">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label"><b>CONTRACT PERIOD</b></label>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">START</label>
                                        <input form="addInvestorForm" type="date" class="form-control" name="contract_start" id="contract_start">
                                    </div>
                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">END</label>
                                        <input form="addInvestorForm" type="date" class="form-control" name="contract_end" id="contract_end">
                                    </div>
                                </div>
                             <br>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label"><b>BANK DETAILS</b></label>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">BANK NAME</label>
                                    <input form="addInvestorForm" type="text" class="form-control" name="bank_name" id="bank_name">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">ACCOUNT NAME</label>
                                    <input form="addInvestorForm" type="text" class="form-control" name="account_name" id="account_name">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">ACCOUNT NUMBER</label>
                                    <input form="addInvestorForm" type="text" class="form-control" name="account_number" id="account_number">
                                </div>
            
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> CLOSE</button>
                            <button form="addInvestorForm" type="submit" class="btn btn-primary" ><i class="fas fa-check"></i> SAVE</button>
                            </div>
                        </div>
                        </div>
                    </div>
            
            
                               {{-- Modal for warning message --}}
                               <div class="modal fade" id="warningTenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">CAN'T ADD TENANT</h5>
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                       <p class="text-center">
                                            THE UNIT/ROOM IS FULLY OCCUPIED!
                                       </p>
                                    </div>
                                    
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

</body>

</html>
