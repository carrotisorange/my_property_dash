</html>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>The Property Manager | Checkout</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <script src="https://js.stripe.com/v2/"></script>
 <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="bg-gradient-primary">
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
     <!-- Nav Item - Dashboard -->
  
     <span class="mx-3">The Property Manager</span>
  
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
          <div class="col-lg-7 d-none d-lg-block">
            <div class="p-5">
                <div class="">
                  <h1 class="h4 text-gray-900 mb-4">Checkout</h1>
                </div>
        
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
                     <p> {{ Auth::user()->property }}</p>
                  </div>
                  <hr>
                  <div class="form-group">
                      <small>Property Type</small>
                      <p>{{ Auth::user()->property_type }}</p>
                  </div>
                  <hr>
                  <div class="form-group">
                      <small>Property Ownership</small>
                      <p>{{ Auth::user()->property_ownership }}</p>
                  </div>
      
                </div>
               
          </div>
          <div class="col-lg-5">
            <div class="p-5">
                <div class="">
                  <h1 class="h4 text-gray-900 mb-4">Selected Plan: <b>{{ Auth::user()->account_type }}</b> </h1>
                </div>
                <form action="/charge" class="fo" method="post" id="payment-form">
                    <div class="card-errors"></div>
                  
                    <div class="form-row">
                      <label>
                        <span>Card number</span>
                        <input type="text" size="20" data-stripe="number">
                      </label>
                    </div>
                  
                    <div class="form-row">
                      <label>
                        <span>Expiration (MM/YY)</span>
                        <input type="text" size="2" data-stripe="exp_month">
                      </label>
                      <span> / </span>
                      <input type="text" size="2" data-stripe="exp_year">
                    </div>
                  
                    <div class="form-row">
                      <label>
                        <span>CVC</span>
                        <input type="text" size="4" data-stripe="cvc">
                      </label>
                    </div>
                  
                    <div class="form-row">
                      <label>
                        <span>Billing Zip</span>
                        <input type="text" size="6" data-stripe="address_zip">
                      </label>
                    </div>
                  
                    <input type="submit" class="submit" value="Submit Payment">
                  </form>
        
      
                </div>
            </div>
            
          </div>
         
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
