<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ $tenant->first_name.' '.$tenant->last_name }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"><link href="{{ asset('index/assets/img/favicon.ico') }}" rel="icon">
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
        <a class="nav-link" href="/board">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury' )
      <li class="nav-item">
      <a class="nav-link" href="/tenants/search">
        <i class="fas fa-users"></i>
        <span>Tenants</span></a>
      </li>
      @endif
  
      @if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'manager' )
      <li class="nav-item">
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
           <!-- Nav Item - Tables -->
  <li class="nav-item active">
      <a class="nav-link" href="/concerns">
    <i class="far fa-comment-dots"></i>
        <span>Concerns</span></a>
  </li>

  <li class="nav-item">
      <a class="nav-link" href="/job-orders">
        <i class="fas fa-tools fa-table"></i>
        <span>Job Orders</span></a>
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
    
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
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
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- Begin Page Content -->
        <div class="container-fluid">
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
          @if(Session::has($key))
         <p class="alert alert-{{ $key }}"> <i class="fas fa-check-circle"></i> {{ Session::get($key) }}</p>
          @endif
          @endforeach
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Concern ID: {{ $concern->concern_id }}</h1>
          </div>
            <div class="row">
                <div class="col-md-6">
                            <div class="card shadow mb-4">
                               <div class="card-header py-3">
                                 <h6 class="m-0 font-weight-bold text-primary">TENANT INFORMATION</h6>
                               </div>
                               <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" width="100%" cellspacing="0">
                                   <tr>
                                        <th>TENANT</th>
                                        <td><a href="/units/{{ $unit->unit_id }}/tenants/{{ $tenant->tenant_id }}/">{{ $tenant->first_name.' '.$tenant->last_name }}</a></td>
                                   </tr>
                                   <tr>
                                        <th>MOBILE</th>
                                        <td>{{ $tenant->contact_no }}</td>
                                   </tr>
                                   <tr>
                                        <th>EMAIL</th>
                                        <td>{{ $tenant->email_address}}</td>
                                   </tr>
                                   <tr>
                                        <th>ROOM</th>
                                        <td><a href="/units/{{ $unit->unit_id }}">{{ $unit->building.' '.$unit->unit_no }}</a></td>
                                   </tr>
                               </table>
                              </div>
                               </div>
                             </div>
                     
                </div>

                <div class="col-md-6">
                            <div class="card shadow mb-4">
                                               <!-- Card Header - Dropdown -->
                              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">CONCERN INFORMATION</h6>
                                <!-- start -->
                                <div class="dropdown no-arrow">
                                  <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#editConcernDetails" >
                                  <i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
                                  </a>
                                  <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                  </div> -->
                                </div>
                                <!-- end -->
                              </div>
                               <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" width="100%" cellspacing="0">
                                    <tr>
                                        <th>DATE REPORTED</th>
                                        <td>{{ Carbon\Carbon::parse($concern->date_reported)->format('M d Y') }}</td>
                                   </tr>
                                   <tr>
                                        <th>DESCRIPTION</th>
                                        <td>{{ $concern->concern_item }}</td>
                                   </tr>
                                   <tr>
                                        <th>TYPE</th>
                                        <td>
                                          {{ $concern->concern_type }}
                                        </td>
                                   </tr>
                                   <!-- <tr>
                                        <th>UNDER WARRANTY</th>
                                        <td>{{ $concern->is_warranty }}</td>
                                   </tr> -->
                                   <tr>
                                        <th>URGENT</th>
                                        <td>
                                          @if($concern->concern_urgency === 'urgent')
                                          <span class="badge badge-danger">{{ $concern->concern_urgency }}</span>
                                          @elseif($concern->concern_urgency === 'major')
                                          <span class="badge badge-warning">{{ $concern->concern_urgency }}</span>
                                          @else
                                          <span class="badge badge-primary">{{ $concern->concern_urgency }}</span>
                                          @endif
                                        </td>
                                   </tr>
                                   <tr>
                                        <th>STATUS</th>
                                        <td>
                                            @if($concern->concern_status === 'pending')
                                            <span class="badge badge-warning">{{ $concern->concern_status }} for {{ number_format(Carbon\Carbon::parse($concern->date_reported)->DiffInDays(Carbon\Carbon::now()), 0) }} days</span>
                                            @elseif($concern->concern_status === 'active')
                                            <span class="badge badge-primary">{{ $concern->concern_status }} for {{ number_format(Carbon\Carbon::parse($concern->date_reported)->DiffInDays(Carbon\Carbon::now()), 0) }} days </span> 
                                            @else
                                            <span class="badge badge-secondary">{{ $concern->concern_status }} on {{ Carbon\Carbon::parse($concern->updated_at)->format('M d Y')}}</span> 
                                            @endif
                                        </td>
                                   </tr>
                                  
                               </table>
                              </div>
                               </div>
                             </div>
                     
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">DETAILS OF THE CONCERN</h6>
                                <!-- start -->
                                <div class="dropdown no-arrow">
                                  <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#editConcernFullDetails" >
                                  <i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
                                  </a>
                                  <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                  </div> -->
                                </div>
                                <!-- end -->
                              </div>
                    
                        <div class="card-body">
                            <p>{{ $concern->concern_desc }}</p>
                        </div>
                    </div>    
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">ACTION THAT HAS BEEN TAKEN TO ADDRESS THE CONCERN</h6>
                                <!-- start -->
                                <div class="dropdown no-arrow">
                                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Select Action:</div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editActionTakenForm" >Edit Details</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#createJobOrderModal">Create job order</a>
                                  </div> 
                                </div>
                                <!-- end -->
                              </div>
                    
                        <div class="card-body">
                        <p>{{ $concern->action_taken }}</p>
                        </div>
                    </div>   
                      
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">FEEDBACK BY THE TENANT TO THE CONCERN</h6>
                                <!-- start -->
                                <div class="dropdown no-arrow">
                                  <a href="#" class="dropdown-toggle" data-toggle="modal" data-target="#editFeedbackConcern" >
                                  <i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
                                  </a>
                                  <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                  </div> -->
                                </div>
                                <!-- end -->
                              </div>
                    
                        <div class="card-body">
                        <p>{{ $concern->feedback }}</p>
                        </div>
                    </div>   

                </div>
            </div>
          </div>
        <!-- /.container-fluid -->
        
        <div class="modal fade" id="editConcernDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Concern Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form id="editConcernDetailsForm" action="/concerns/{{ $concern->concern_id }}" method="POST">
                  @method('put')
                  {{ csrf_field() }}
                </form>
                  <div class="row">
                      <div class="col">
                          <small>Date reported</small>
                          <input type="date" form="editConcernDetailsForm" class="form-control" name="date_reported" value="{{ $concern->date_reported }}" required>
                      </div>
                  </div>
                  
                  <div class="row">
                      <div class="col">
                          <small>Description</small>
                          <input type="text" form="editConcernDetailsForm" class="form-control" name="concern_item" value="{{ $concern->concern_item }}" required>
                      </div>
                  </div>
                
                  <div class="row">
                      <div class="col">
                          <small>Type</small>
                          <select class="form-control" form="editConcernDetailsForm" name="concern_type" id="" required>
                              <option value="{{ $concern->concern_type }}" readonly selected class="bg-primary">{{ $concern->concern_type }}</option>
                              <option value="billing">billing</option>
                              <option value="internet">internet</option>
                              <option value="employee">employee</option>
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

                  <div class="row">
                      <div class="col">
                          <small>Urgency</small>
                          <select class="form-control" form="editConcernDetailsForm" name="concern_urgency" id="" required>
                              <option value="{{ $concern->concern_urgency }}" readonly selected class="bg-primary">{{ $concern->concern_urgency }}</option>
                             <option value="minor">minor</option>
                             <option value="major">major</option>
                             <option value="urgent">urgent</option>
                          </select>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col">
                          <small>Status</small>
                          <select class="form-control" form="editConcernDetailsForm" name="concern_status" id="" required>
                              <option value="{{ $concern->concern_status }}" readonly selected class="bg-primary">{{ $concern->concern_status }}</option>
                             <option value="pending">pending</option>
                             <option value="active">active</option>
                             <option value="closed">closed</option>
                          </select>
                      </div>
                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                    <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Update</button>
                </div>
            </div>
            </div>
        
        </div>

        <div class="modal fade" id="editConcernFullDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter the details of the concern</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form id="editConcernDetailsForm" action="/concerns/{{ $concern->concern_id }}" method="POST">
                  @method('put')
                  {{ csrf_field() }}
                </form>
                  <div class="row">
                      <div class="col">
                          <small></small>
                          <textarea form="editConcernDetailsForm" class="form-control" name="concern_desc" cols="30" rows="10">{{ $concern->concern_desc }}</textarea>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                    <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Update</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="editActionTakenForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter the action taken to address the concern</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form id="editConcernDetailsForm" action="/concerns/{{ $concern->concern_id }}" method="POST">
                  @method('put')
                  {{ csrf_field() }}
                </form>
                  <div class="row">
                      <div class="col">
                          <small></small>
                          <textarea form="editConcernDetailsForm" class="form-control" name="action_taken" cols="30" rows="10">{{ $concern->action_taken }}</textarea>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                    <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Update</button>
                </div>
            </div>
            </div>
        </div>

        
        <div class="modal fade" id="editFeedbackConcern" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter the feedback of the tenant to the concern</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form id="editConcernDetailsForm" action="/concerns/{{ $concern->concern_id }}" method="POST">
                  @method('put')
                  {{ csrf_field() }}
                </form>
                  <div class="row">
                      <div class="col">
                          <small></small>
                          <textarea form="editConcernDetailsForm" class="form-control" name="feedback" cols="30" rows="10">{{ $concern->feedback }}</textarea>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                    <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Update</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="createJobOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Job Order Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form id="editConcernDetailsForm" action="/joborders/{{ $concern->concern_id }}" method="POST">
                  @method('put')
                  {{ csrf_field() }}
                </form>
                
                  <div class="row">
                      <div class="col">
                          <small>Tenant</small>
                          <p>{{ $tenant->first_name.' '.$tenant->last_name }}</p>
                      </div>

                      <div class="col">
                        <small>Mobile</small>
                        <p>{{ $tenant->contact_no }}</p>
                      </div>
                    
                      <div class="col">
                          <small>Room</small>
                          <p>{{ $unit->building.' '.$unit->unit_no }}</p>
                      </div>
                     
                  </div>
                  <label for="">Concern/Request</label>
                  <div class="row">
                    <div class="col">
                        <small></small>
                        <textarea form="editConcernDetailsForm" class="form-control" name="concern_desc" cols="30" rows="10">{{ $concern->concern_desc }}</textarea>
                    </div>
                  </div>
                  <br>
                  <label for="">Request for materials</label>
                  <div class="row">
                    <div class="col">
                      <a id='delete_row' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i></a>
                          <a id="add_row" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i></a>     
                          <br>  
                          <br>
                          <table class = "table table-hover " id="tab_logic">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                                <input form="moveoutTenantForm" type="hidden" id="no_of_items" name="no_of_items" >
                            <tr id='addr1'></tr>
                          </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                    <button form="editConcernDetailsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Create Job Order</button>
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
        $('#addr'+i).html("<th>"+ (i) +"</th><td><input form='moveoutTenantForm' name='desc"+i+"' id='desc"+i+"' type='text' class='form-control input-md'></td><td><input form='moveoutTenantForm'   name='qty"+i+"' id='qty"+i+"' type='number' min='1' class='form-control input-md' required></td><td><input form='moveoutTenantForm'   name='price"+i+"' id='price"+i+"' type='number' min='1' class='form-control input-md' required></td><td><input form='moveoutTenantForm' step='0.01' name='amt"+i+"' id='amt"+i+"' type='number' min='1' class='form-control input-md' readonly required></td>");


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
  });
</script>

</body>

</html>
