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

      @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury' )
      <li class="nav-item active">
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
  
      <li class="nav-item active">
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

          <a href="/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back Dashboard</a>

          @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'treasury')
          <a href="/tenants/search" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back to Tenants</a>
          @else
          <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Go Back to Tenant</a>
          @endif
        
          @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
          <a href="#" data-toggle="modal" data-target="#addBill" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Bill</a>
          @endif

          @if(Auth::user()->user_type === 'treasury' || Auth::user()->user_type === 'manager')
          <a href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/payments" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-dollar-sign fa-sm text-white-50"></i> Payment History <span class="badge badge-light">{{ $payments }}</span></a>
          <a  target="_blank" href="/units/{{ $tenant->unit_tenant_id }}/tenants/{{ $tenant->tenant_id }}/billings/export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Bills</span></a>
         @endif
          <br><br>
          <div class="row">
            <div class="col-md-12">
              <ul style="list-style-type: none">
                <li><b>Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}</li>
                <li class="text-danger"><b>Due Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->addDays(7)->format('M d Y') }}</li>
                <li><b>To:</b> {{ $tenant->first_name.' '.$tenant->last_name }}</li>
                <li><b>Room:</b>   
                  @foreach($unit_no as $item)
                  {{ $item->building.' '.$item->unit_no }}
                  @endforeach
               </li>
              </ul>
              <p class="text-right">Statement of Accounts</p>
              <p class="text-right"></p>
                <table class="table text-right" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <th>Bill No</th>
                    <th>Description</th>
                    <th>Period Covered</th>
                    <th>Amount</th>
                  </tr>
                  @foreach ($bills as $item)
                  <tr>
                      <td>{{ $item->billing_no }}</td>
                      <td>{{ $item->billing_desc }}</td>
                      <td>
                        @if($item->details === null)
                        -
                        @else
                        {{ $item->details }}
                        @endif
                      </td>
                      <td class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</td>
                  </tr>
                  @endforeach
            
              </table>
              <table class="table" width="100%" cellspacing="0">
                <tr>
                 <th>TOTAL AMOUNT PAYABLE</th>
                 <th class="text-right">{{ number_format($total_bills,2) }} </th>
                </tr>
                @if($tenant->tenant_status === 'pending')

                @else
                <tr>
                  <th class="text-danger">TOTAL AMOUNT PAYABLE AFTER DUE DATE (+10%)</th>
                  <th class="text-right text-danger">{{ number_format($total_bills + ($total_bills * .1) ,2) }}</th>
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
  
          <div class="card-body">
            <p class="text-center">
                  {{ Auth::user()->note }}
            </p>
          </div>
          
          @if(Auth::user()->user_type === 'billing' || Auth::user()->user_type === 'manager')
          <button data-toggle="modal" data-target="#editPaymentFooter" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-sm text-white-50"></i> Edit Footer Message</button>
          @endif
          {{-- Modal for editing payment footer message --}}
        <div class="modal fade" id="editPaymentFooter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Footer Message</h5>
        
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
                      <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                      <button form="editPaymentFooterForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want to perform this action?');" ><i class="fas fa-check fa-sm text-white-50"></i> Submit</button>
                  </div>
            </div>
            </div>
        
        </div>

        {{-- modal for adding payments. --}}
        
        <div class="modal fade" id="acceptPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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
                    <?php 
                          $billno = 1;
                          $amt = 1;
                          $desc = 1;
                          $ctr =1;      
                    ?>
                    @foreach ($movein_charges as $item)
                        <input form="acceptPaymentForm"  type="hidden" name="ctr" value="{{ $ctr++ }}">
                        <input form="acceptPaymentForm"  type="hidden" name="desc{{ $desc++ }}" value="{{ $item->billing_desc }}">
                        <input form="acceptPaymentForm"  type="hidden" name="billno{{ $billno++ }}" value="{{ $item->billing_no }}">
                        <input form="acceptPaymentForm"  type="hidden" step="0.01" name="amt{{ $amt++ }}" value="{{ $item->billing_amt}}">
                    @endforeach

                    {{-- @for ($i = 0; $i < 3; $i++)

                    @endfor   --}}
                    
                    <div class="form-group row">
                        <div class="col-md-9">
                            <label for="">Date</label>
                        <input form="acceptPaymentForm" type="date" class="form-control" name="payment_created" value={{date('Y-m-d')}} required>
                        </div>
                        <div class="col-md-3">
                          <label for="">AR #</label>
                          <input form="acceptPaymentForm" type="text" class="form-control" id="" name="ar_number" value="{{ $payment_ctr+1 }}" required readonly>
                      </div>
                    </div>
                    @if($tenant->tenant_status === 'pending')

                    @else
                    <div class="form-group row">
                      <div class="col">
                          <label for="">Payment Description</label>
                          <select form="acceptPaymentForm" class="form-control" name="payment_note" id="" required>
                            <option value="" selected>Please select one</option>
                            <option value="Electric">Electric</option>
                              <option value="Rent">Rent</option>
                              <option value="Surcharge">Surcharge</option>
                              <option value="Water">Water</option>
                          </select>
                      </div>

                      <div class="col">
                        <label for="">Period Covered</label>
                        <div class="col">
                          <select form="acceptPaymentForm" class="form-control" name="details" required>
                            @foreach ($bills as $item)
                            <option value="{{ $item->details }}">{{ $item->details }}</option>
                            @endforeach
                          </select>
                         
                        </div>
                    </div>
                  </div>
                    @endif
                   
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="">Form of Payment</label>
                            <select form="acceptPaymentForm" class="form-control" name="form_of_payment" id="" required>
                              <option value="" selected>Please select one</option>
                                <option value="Cash">cash</option>
                                <option value="Bank Deposit">bank deposit</option>
                                <option value="Cheque">cheque</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Amount</label>
                            @if(Carbon\Carbon::now()->startOfMonth()->addDays(7)->format('d') <= Carbon\Carbon::now()->format('d') && $tenant->tenant_status !== 'pending')
                            <input form="acceptPaymentForm" type="number" class="form-control" id="" step="0.01" min="1" name="amt_paid" value="{{ $total_bills+($total_bills*.1) }}" required>
                            @else
                            <input form="acceptPaymentForm" type="number" class="form-control" id="" step="0.01" min="1" name="amt_paid" value="{{ $total_bills }}" required>
                            @endif
                        </div>
                     
                    </div>
                 
                    <input type="hidden" form="acceptPaymentForm" id="payment_tenant_id" name="payment_tenant_id" value="{{ $tenant->tenant_id }}">
                    <input type="hidden" form="acceptPaymentForm" id="unit_tenant_id" name="unit_tenant_id" value="{{ $tenant->unit_tenant_id }}">
                    <input type="hidden" form="acceptPaymentForm" id="tenant_status" name="tenant_status" value="{{ $tenant->tenant_status }}">
                
                    <div class="form-group row">
                      <div class="col">
                          <label for="">Bank Name</label>
                          <input form="acceptPaymentForm" class="form-control" type="text" name="bank_name">
                          <small class="text-danger">For bank deposit only</small>
                      </div>
                      <div class="col">
                          <label for="">Cheque No</label>
                          <input form="acceptPaymentForm" class="form-control" type="text" name="cheque_no">
                          <small class="text-danger">For cheque only</small>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                    <button form="acceptPaymentForm" id ="addPaymentButton" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?');" ><i class="fas fa-check fa-sm text-white-50f"></i> Add Payment</button>
                </div>
         
            </div>
            </div>


            <div class="modal fade" id="addBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Enter Bill Information</h5>
                  
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                      <form id="addBillForm" action="/billings" method="POST">
                      {{ csrf_field() }}
                      </form>
                    
                     
                     
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Cancel</button>
                      <button form="addBillForm" id ="addPaymentButton" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?');" ><i class="fas fa-check fa-sm text-white-50f"></i> Add Payment</button>
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

<script>
    $(document).ready(function () {

        $("#addPaymentButton").submit(function (e) {

            //disable the submit button
            $("#addPaymentButton").attr("disabled", true);
         
            return true;

        });
    });
</script>

</body>

</html>
