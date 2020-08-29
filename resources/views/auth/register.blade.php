<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>The Property Manager | Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/assets/img/favicon.ico') }}" rel="icon">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <form class="user" id="registrationForm" method="POST" action="/register">
            @csrf
        
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register your property now!</h1>
              </div>
              
                <div class="form-group row">
                  <div class="col-sm-12 mb-6 mb-sm-0">
                    <input form="registrationForm"  id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Full Name" required>

                     @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                    <input form="registrationForm"  id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email" required>

                     @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input form="registrationForm" id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                  </div>
                  <div class="col-sm-6">
                    <input form="registrationForm" id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
                  </div>
                </div>
                <hr>
             
                {{-- <div class="form-group">
                  <input form="registrationForm" id="property" type="text" class="form-control @error('property') is-invalid @enderror" name="property" value="{{ old('property') }}" required autocomplete="property" placeholder="Name of your property">
              
                  @error('property')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
              
                </div>
              
                <div class="form-group row">
                 
                <div class="col-sm-6">
                  <small>Property Ownership</small>
                  <select form="registrationForm" id="property_ownership" class="form-control @error('property_ownership') is-invalid @enderror" name="property_ownership" value="{{ old('property_ownership') }}" required autocomplete="property_ownership">
              
                    <option value="Single Owner">Single Owner</option>
                    <option value="Multiple Owners">Multiple Owners</option>
                  </select>
              
                     @error('property_ownership')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
              
              
               <div class="col-sm-6">
                 <small>Property Type</small>
                 <select form="registrationForm" id="property_type" type="text" class="form-control @error('property_type') is-invalid @enderror" name="property_type" value="{{ old('property_type') }}" required autocomplete="property_type">
                   
                   <option value="Dormitory">Dormitory</option>
                   <option value="Apartment Rentals">Apartment Rentals</option>
                   <option value="Commercial Complex">Commercial Complex</option>
                   <option value="Condominium Associations">Condominium Associations</option>
                 </select>
              
                    @error('property_type')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                   @enderror
                   </div>
                  </div> --}}
               <div class="form-group">
                 <small>
                   <input type="checkbox" name="terms" checked>
                   By selecting Agree and Register below, I agree to The Property Manager <a href="/terms-of-service" target="_blank">Terms and Conditions</a>, <a href="/privacy-policy" target="_blank">Privacy Policy</a>, and <a href="/acceptable-use-policy" target="_blank">Acceptable Use Policy</a>.</small>
                   @error('terms')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
                  </div>
               
                <button form="registrationForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;">
                    <i class="fas fa-check"></i> Register
            </button>

          </form>
                {{-- <hr>
                <a href="login/google" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="login/facebook" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> --}}
              
              <hr> 
              <div class="text-center">
                @if (Route::has('password.request'))
                    <a class="small btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
              </div>
              <div class="text-center">
                <a class="small" href="/login">Already have an account? Login!</a>
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
