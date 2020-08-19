</html>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>The Property Manager | Select Plan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
         <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

   {{ Auth::user()->property.' '.Auth::user()->property_type }}

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

        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
       
        
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">Select Your Plan</h1>
              </div>
              
                <form id="selectingPlanForm" action="/users/{{ Auth::user()->id }}" method="POST">
                @method('put')
                {{ csrf_field() }}
                <input form="selectingPlanForm" type="hidden" name="action" value="selecting_plan" >
                </form>
                <div class="form-group">
                  <small>Name</small>
                  <p>{{ Auth::user()->name }}</p>
              </div>
              <hr>
              <div class="form-group">
                  <small>Email</small>
                  <p>{{ Auth::user()->email }}</p>
              </div>
              <hr>
                <div class="form-group">
                    <small>Name of your property</small>
                    <p>{{ Auth::user()->property }}</p>
                </div>
                <hr>
                <div class="form-group">
                    <small>Property Type</small>
                   <p><p>{{ Auth::user()->property_type }}</p></p>
                </div>
                <hr>
                <div class="form-group">
                    <small>Property Ownership</small>
                    <p>{{ Auth::user()->property_ownership }}</p>
                </div>
                <hr>
                <div class="form-group">
                      <small>Plan</small>
                      <select form="selectingPlanForm" id="account_type" class="form-control form @error('account_type') is-invalid @enderror" name="account_type" value="{{ old('account_type') }}" required autocomplete="account_type">
                        <option value="">Please select one</option>
                        <option value="Basic">Basic | 20 rooms | 450/mo</option>
                        <option value="Medium">Medium | 50 rooms | 950/mo</option>
                        <option value="Large">Large | 100 rooms | 1800/mo</option>
                        <option value="Enterprise">Enterprise | 200 rooms | 2400/mo</option>
                        <option value="Corporate">Corporate | 500 rooms | 4800/mo</option>
                      </select>
                  
                         @error('account_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      
                </div>

                <hr>
                    <button form="selectingPlanForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;"> 
                       Next
                    </button>
    
              </div>
             
            </div>
          </div>
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

</body>

</html>
