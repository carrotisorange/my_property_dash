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
        <li class="nav-item active">
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
          @foreach (['danger', 'warning', 'success', 'info'] as $key)
          @if(Session::has($key))
         <p class="alert alert-{{ $key }}"> <i class="fas fa-check-circle"></i> {{ Session::get($key) }}</p>
          @endif
          @endforeach

          <a href="/board" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back Dashboard</a>

          @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
          <a href="/tenants/search" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back to Tenants</a>
          @else
          <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back to Tenant</a>
          @endif
        
          @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
          <a href="#" data-toggle="modal" data-target="#addBill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</a>
          @endif

            @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager' || Auth::user()->user_type === 'billing')
            <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/payments" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-dollar-sign fa-sm text-white-50"></i> Show Payments <span class="badge badge-light">{{ $payments }}</span></a>
            <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/download" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Bills</span></a>
           @if($tenant->email_address !== null)
           <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/bills/send" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-paper-plane  fa-sm text-white-50"></i> Send Bills</span></a>
           @endif
     
          @endif
          <br><br>
          <div class="row">
            <div class="col-md-12">
              <p>
                <b>Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}
                <br>
                <span class="text-danger"><b>Due Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->addDays(7)->format('M d Y') }}</span>
                <br>
                <b>To:</b> {{ $tenant->first_name.' '.$tenant->last_name }}
                <br>
                <b>Room:</b> {{ $room->building.' '.$room->unit_no }}</b>
               
              </p>
              <p class="text-right">Statement of Accounts</p>
              <div class="table-responsive text-nowrap">
                <table class="table">
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
                      @if(Auth::user()->user_type === 'manager')

                      <form action="/tenants/{{ $item->billing_tenant_id }}/billings/{{ $item->billing_id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button title="remove this bill" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                      </form>
                      @endif
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
                @if($tenant->tenant_status === 'pending')

                @else
                 <tr>
                  <th class="text-danger">TOTAL AMOUNT PAYABLE AFTER DUE DATE (+10%)</th>
                  <th class="text-right text-danger">{{ number_format($balance->sum('balance') + ($balance->sum('balance') * .1) ,2) }}</th>
                 </tr> 
                @endif
                 @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
                 <tr>
                   <td colspan="2" class="text-right"><a href="#" data-toggle="modal" data-target="#acceptPayment" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Payment</a> </td>
                 </tr>
                 @endif     
              </table>
            </div>
            </div>
          </div>

            <pre>
              {{ Auth::user()->note }}       
            </pre>


          
          @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
          <button data-toggle="modal" data-target="#editPaymentFooter" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit Footer Message</button>
          @endif
          <br>
          <br>
          {{-- Modal for editing payment footer message --}}
        <div class="modal fade" id="editPaymentFooter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enter Footer Message</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                   <form id="editPaymentFooterForm" action="/users/{{ Auth::user()->id }}" method="POST">
                    @method('put')
                    {{ csrf_field() }}
                   </form>
                    <textarea form="editPaymentFooterForm" class="form-control" name="note" id="" cols="30" rows="10">
                    {{ Auth::user()->note }}
                    </textarea>
                  <input form="editPaymentFooterForm" type="hidden" name="action" value="change_footer_message">
                </div>
                <div class="modal-footer">
                      {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
                      <button form="editPaymentFooterForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
                  </div>
            </div>
            </div>
        
        </div>

        {{-- modal for adding payments. --}}
        
        <div class="modal fade" id="acceptPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Enter Payment Information</h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <form id="acceptPaymentForm" action="/payments" method="POST">
                  {{ csrf_field() }}
                  </form>
           
                  {{-- @foreach ($movein_charges as $item)
                      <input form="acceptPaymentForm"  type="hidden" name="ctr" value="{{ $ctr++ }}">
                      <input form="acceptPaymentForm"  type="hidden" name="desc{{ $desc++ }}" value="{{ $item->billing_desc }}">
                      <input form="acceptPaymentForm"  type="hidden" name="billno{{ $billno++ }}" value="{{ $item->billing_no }}">
                      <input form="acceptPaymentForm"  type="hidden" step="0.01" name="amt{{ $amt++ }}" value="{{ $item->billing_amt}}">
                  @endforeach --}}
                  
                  <div class="row">
                      <div class="col-md-6">
                          <small for="">Date</small>
                      {{-- <input form="acceptPaymentForm" type="date" class="form-control" name="payment_created" value={{date('Y-m-d')}} required> --}}
                      <input type="date" form="acceptPaymentForm" class="" name="payment_created" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required >
                      </div>
                      <div class="col-md-6">
                        <small for="">Acknowledgment Receipt No</small>
                        <input form="acceptPaymentForm" type="text" class="" id="" name="ar_number" value="{{ Carbon\Carbon::now()->getPreciseTimestamp(3) }}" required readonly>
                    </div>
                  </div>
                
              <hr>

                  <div class="row">
                    <div class="col-md-12">
                   
                      <p class="text-left">
                        <span id='delete_payment' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove Payment</span>
                      <span id="add_payment" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-plus fa-sm text-white-50"></i> Add Payment</span>     
                      </p>
                        <div class="table-responsive text-nowrap">
                        <table class = "table table-bordered" id="payment">
                            <tr>
                                <th>#</th>
                                <th>Bill</th>
                                <th>Amount</th>
                                <th>Form of Payment</th>
                                <th>Bank Name</th>
                                <th>Cheque No</th>
                            </tr>
                                <input form="acceptPaymentForm" type="hidden" id="no_of_payments" name="no_of_payments" >
                            <tr id='payment1'></tr>
                        </table>
                      </div>
                    </div>
                  </div>        
               
                  <input type="hidden" form="acceptPaymentForm" id="payment_tenant_id" name="payment_tenant_id" value="{{ $tenant->tenant_id }}">
                  <input type="hidden" form="acceptPaymentForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}">
                  <input type="hidden" form="acceptPaymentForm" id="tenant_status" name="tenant_status" value="{{ $tenant->tenant_status }}">
                <hr>
                 
              </div>
              <div class="modal-footer">
                  {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button> --}}
                  <button form="acceptPaymentForm" id ="addPaymentButton" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50f"></i> Submit</button>
              </div>
       
          </div>
          </div>


      </div>

      <div class="modal fade" id="addBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter Bill Information </h5>
    
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
           <div class="modal-body">
            <form id="addBillForm" action="/billings/" method="POST">
               @csrf
            </form>
            {{-- <div class="row">
              <div class="col">
                  <small>Bill No</small>
                  <input type="number" form="addBillForm" class="form-control" name="billing_no" value="{{ $current_bill_no }}" required readonly>
                
              </div>
            </div> --}}
            <input type="hidden" form="addBillForm" name="action" value="add_move_in_charges" required>
            <input type="hidden" form="addBillForm" name="tenant_id" value="{{ $tenant->tenant_id }}" required>
            
            <div class="row">
              <div class="col">
                  <small>Billing Date</small>
                  {{-- <input type="date" form="addBillForm" class="form-control" name="billing_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required > --}}
                  <input type="date" form="addBillForm" class="" name="billing_date" value="{{ Carbon\Carbon::parse($tenant->movein_date)->format('Y-m-d') }}" required >
              </div>
            </div>
            {{-- <div class="row">
              <div class="col">
                  <small>Tenant</small>
                  <input type="text" form="addBillForm" class="form-control" name="tenant" value="{{ $tenant->first_name.' '.$tenant->last_name }}" required readonly>
                  <input type="hidden" form="addBillForm" class="form-control" name="billing_tenant_id" value="{{ $tenant->tenant_id }}" required readonly>
              </div>
            </div>
            <div class="row">
              <div class="col">
                  <small>Room</small>
                  <input type="text" form="addBillForm" class="form-control" name="room" value="{{ $room->building.' '.$room->unit_no }}" required readonly>
                  <input type="hidden" form="addBillForm" class="form-control" name="room_id" value="{{ $room->unit_id }}" required readonly>
              </div>
            </div> --}}
            <br>
            <div class="row">
              <div class="col">
             
                <p class="text-left">
                  <span id='delete_row' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove Bill</span>
                <span id="add_row" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</span>     
                </p>
                  <div class="table-responsive text-nowrap">
                  <table class = "table table-bordered" id="tab_logic">
                      <tr>
                          <th>#</th>
                          <th>Description</th>
                          <th colspan="2">Period Covered</th>
                          <th>Amount</th>
                          
                      </tr>
                          <input form="addBillForm" type="hidden" id="no_of_items" name="no_of_items" >
                      <tr id='addr1'></tr>
                  </table>
                </div>
              </div>
            </div>
            {{-- <div class="row">
              <div class="col">
                  <small>Description</small>
                  <select form="addBillForm" name="billing_desc" class="form-control" required>
                    <option value="">Please select one</option>
                    <option value="Advance Rent">Advance Rent</option>
                    <option value="Security Deposit (Utilities)" >Security Deposit (Utilities)</option>
                    <option value="Security Deposit (Rent)" >Security Deposit (Rent)</option>
                    <option value="General Cleaning" >General Cleaning</option>
                    <option value="Management Fee" >Management Fee</option>
                    <option value="Rent">Rent</option>
                    <option value="Electric">Electric</option>
                    <option value="Water">Water</option>
                  </select>
              </div>
            </div>
            
            <div class="row">
              <div class="col">
                  <small>Period Covered</small >
                  <br>
                  <small>From</small>
                  {{-- <input type="date"  form="addBillForm" class="form-control" name="billing_start"> --}}
{{--                  
                  <input type="date"  form="addBillForm" class="form-control" name="billing_start" value="{{ Carbon\Carbon::parse($tenant->movein_date)->format('Y-m-d') }}">
                 
                  <small>To</small> --}}
                  {{-- <input type="date"  form="addBillForm" class="form-control" name="billing_end"> --}}
{{--                   
                  <input type="date"  form="addBillForm" class="form-control" name="billing_end"  value="{{ Carbon\Carbon::parse($tenant->moveout_date)->format('Y-m-d') }}"> 
              </div> 
            </div>
            <div class="row">
              <div class="col">
                  <small>Amount</small>
                  <input type="number" step="0.01" form="addBillForm" class="form-control" name="billing_amt" value="{{ $tenant->tenant_monthly_rent }}" required>
                 
              </div> 
            </div>--}}
            
         </div>
         <div class="modal-footer">
           {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button> --}}
           <button form="addBillForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
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

<script>
    $(document).ready(function () {

        $("#addPaymentButton").submit(function (e) {

            //disable the submit button
            $("#addPaymentButton").attr("disabled", true);
         
            return true;

        });
    });
</script>

<script type="text/javascript">

  //adding moveout charges upon moveout
    $(document).ready(function(){
        var i=1;
        
    $("#add_row").click(function(){
        $('#addr'+i).html("<th>"+ (i) +"</th><td><select name='billing_desc"+i+"' form='addBillForm' id='billing_desc"+i+"'><option value='Security Deposit (Rent)'>Security Deposit (Rent)</option><option value='Security Deposit (Utilities)'>Security Deposit (Utilities)</option><option value='Advance Rent'>Advance Rent</option><option value='Rent'>Rent</option><option value='Electric'>Electric</option><option value='Water'>Water</option></select> <td><input form='addBillForm' name='billing_start"+i+"' id='billing_start"+i+"' type='date' value='{{ Carbon\Carbon::parse($tenant->movein_date)->format('Y-m-d') }}'></td> <td><input form='addBillForm' name='billing_end"+i+"' id='billing_end"+i+"' type='date' value='{{ Carbon\Carbon::parse($tenant->moveout_date)->format('Y-m-d') }}'></td> <td><input form='addBillForm'   name='billing_amt"+i+"' id='billing_amt"+i+"' type='number' min='1' step='0.01' value='{{ $tenant->tenant_monthly_rent }}' required></td>");


     $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
     i++;
    
     document.getElementById('no_of_items').value = i;

    });

    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        current_bill_no--;
        document.getElementById('no_of_items').value = i;
        }
    });

    var j=1;
    $("#add_payment").click(function(){
        $('#payment'+j).html("<th>"+ (j) +"</th><td><select form='acceptPaymentForm' name='billing_no"+j+"' id='billing_no"+j+"' required> @foreach ($balance as $item)<option value='{{ $item->billing_no.'-'.$item->billing_id }}'> Bill No {{ $item->billing_no }} | {{ $item->billing_desc }} | {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} - {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }} | {{ number_format($item->balance,2) }} </option> @endforeach </select></td><td><input form='acceptPaymentForm' name='amt_paid"+j+"' id='amt_paid"+j+"' type='number' min='1' step='0.01' required></td><td><select form='acceptPaymentForm' name='form_of_payment"+j+"' required><option value='Cash'>Cash</option><option value='Bank Deposit'>Bank Deposit</option><option value='Cheque'>Cheque</option></select></td><td>  <input form='acceptPaymentForm' type='text' name='bank_name"+j+"'></td><td><input form='acceptPaymentForm' type='text' name='cheque_no"+j+"'></td>");


     $('#payment').append('<tr id="payment'+(j+1)+'"></tr>');
     j++;
     document.getElementById('no_of_payments').value = j;

    });

    $("#delete_payment").click(function(){
        if(j>1){
        $("#payment"+(j-1)).html('');
        j--;
        document.getElementById('no_of_payments').value = j;
        }
    });

    
});
</script>


</body>

</html>
