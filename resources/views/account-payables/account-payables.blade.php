<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Account Payables</title>

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
          <li class="nav-item active">
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
        <!-- End of Topbar -->
        <div class="container-fluid">
          @foreach (['danger', 'warning', 'success', 'info'] as $key)
          @if(Session::has($key))
         <p class="alert alert-{{ $key }}"> <i class="fas fa-check-circle"></i> {{ Session::get($key) }}</p>
          @endif
          @endforeach
         
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Account Payables</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            @if(auth()->user()->user_type === 'ap' || auth()->user()->user_type === 'manager' )
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPayables" data-whatever="@mdo"><i class="fas fa-plus fa-sm text-white-50"></i> Add Entry</a>
            @endif
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#requestFunds" data-whatever="@mdo"><i class="fas fa-hand-holding-usd fa-sm text-white-50"></i> Request Funds</a>
          </div>
        </div>
        <br>
        <p>Payable Entries</p>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Entry</th>
                    <th>Added at</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $ctr = 1; ?>
                  @foreach ($entry as $item)
                     <tr>
                      <th>{{ $ctr++ }}</th>
                      <td>{{ $item->payable_entry }}</td>
                      <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                      <td> 
                        @if(auth()->user()->user_type === 'ap' || auth()->user()->user_type === 'manager')
                        <form action="/account-payable/{{ $item->id }}/" method="POST">
                          @csrf
                          @method('delete')
                          <button title="remove this entry" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                        </form>
                        @endif
                       </td>
                     </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <br>
        <p>Payable Requests</p>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Entry</th>
                    <th>Amount</th>
                    <th>Date Requested</th>
                    <th>Requested By</th>
                    <th>Status</th>
                    <th>Date Approved</th>
                  
                    <th colspan="2">Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                 
                  @foreach ($request as $item)
                     <tr>
                      <th>{{ $item->no }}</th>
                      <td>{{ $item->entry }}</td>
                      <td>{{ number_format($item->amt, 2) }}</td>
                      <td>{{ Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</td>
                      <td>{{ $item->requested_by }}</td>
                      <td>{{ $item->status }}</td>
                     
                       <td>{{ $item->updated_at? Carbon\Carbon::parse($item->updated_at)->format('M d Y'): '-' }}</td>
                      {{-- <td>{{ $item->approved_by? $item->approved_by: 'pending' }}</td> --}} 
                      @if($item->status === 'pending')
                      <td> 
                        <form action="/request-payable/disapprove/{{ $item->id }}/" method="POST">
                        @csrf
                        <button title="disapprove this request" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-times fa-sm text-white-50"></i></button>
                      </form>
                    </td>
                    <td>
                      <form action="/request-payable/approve/{{ $item->id }}/" method="POST">
                        @csrf
              
                        <button title="approve this request" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"  onclick="return confirm('Are you sure you want perform this action?');"><i class="fas fa-check fa-sm text-white-50"></i></button>
                      </form>
                    </td>
                      @else

                      @endif
                     </tr>
                  @endforeach
                </tbody>
              </table>
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

  <div class="modal fade" id="addPayables" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Add Entry</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form id="addPayableEntryForm" action="/account-payable/add/{{ Auth::user()->property }}" method="POST">
             @csrf
          </form>
          
          <div class="row">
            <div class="col">
           
              <p class="text-right">
                <span id='delete_entry' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove </span>
              <span id="add_entry" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add </span>     
              </p>
                <div class="table-responsive text-nowrap">
                <table class = "table table-bordered" id="tab_logic">
                    <tr>
                        <th>#</th>
                        <th>Entry</th>
                    </tr>
                        <input form="addPayableEntryForm" type="hidden" id="no_of_entry" name="no_of_entry" >
                    <tr id='addr1'></tr>
                </table>
              </div>
            </div>
          </div>
          
       </div>
        <div class="modal-footer">
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
            <button form="addPayableEntryForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check"></i> Save</button>
            </div>
    </div>
    </div>
  </div>

  <div class="modal fade" id="requestFunds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Request Funds</h5>
  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form id="requestFundsForm" action="/account-payable/request/{{ Auth::user()->property }}" method="POST">
             @csrf
          </form>
          
          <div class="row">
            <div class="col">
           
              <p class="text-right">
                <span id='delete_request' class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-minus fa-sm text-white-50"></i> Remove </span>
              <span id="add_request" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add </span>     
              </p>
                <div class="table-responsive text-nowrap">
                <table class = "table table-bordered" id="request_table">
                    <tr>
                        <th>#</th>
                        <th>Entry</th>
                        <th>Amount</th>
                    </tr>
                        <input form="requestFundsForm" type="hidden" id="no_of_request" name="no_of_request" >
                    <tr id='request1'></tr>
                </table>
              </div>
            </div>
          </div>
          
       </div>
        <div class="modal-footer">
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-dismiss="modal"><i class="fas fa-times fa-sm text-white-50"></i> Close</button>
            <button form="requestFundsForm" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="return confirm('Are you sure you want perform this action?'); this.disabled = true;"><i class="fas fa-check"></i> Save</button>
            </div>
    </div>
    </div>
  </div>
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

    //adding moveout charges upon moveout
      $(document).ready(function(){
          var i=1;
          
      $("#add_entry").click(function(){
          $('#addr'+i).html("<th>"+ (i) +"</th><td><input class='col-md-12' form='addPayableEntryForm' name='payable_entry"+i+"' type='text'></td> ");
  
  
       $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
       i++;
       
       document.getElementById('no_of_entry').value = i;
  
      });
  
      $("#delete_entry").click(function(){
          if(i>1){
          $("#addr"+(i-1)).html('');
          i--;
          
          document.getElementById('no_of_entry').value = i;
          }
      });

      var j=1;
          
          $("#add_request").click(function(){
              $('#request'+j).html("<th>"+ (j) +"</th><td><select form='requestFundsForm' name='entry"+j+"' >@foreach($entry as $item)<option value='{{ $item->payable_entry }}'>{{ $item->payable_entry }}</option> @endforeach</select></td><td><input form='requestFundsForm' name='amt"+j+"' type='number' step='0.001' required></td> ");
      
      
           $('#request_table').append('<tr id="request'+(j+1)+'"></tr>');
           j++;
           
           document.getElementById('no_of_request').value = j;
      
          });
      
          $("#delete_request").click(function(){
              if(j>1){
              $("#request"+(j-1)).html('');
              j--;
              
              document.getElementById('no_of_request').value = j;
              }
          });
    
  });
  </script>
  

</body>

</html>
