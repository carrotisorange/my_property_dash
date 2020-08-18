</html>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>The Property Manager | Property Profile</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('/dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
       
        
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="">
                <h1 class="h4 text-gray-900 mb-4">Property Profile</h1>
              </div>
              
                <form id="addPropertyForm" action="/users/{{ Auth::user()->id }}" method="POST">
                @method('put')
                {{ csrf_field() }}
                <input form="addPropertyForm" type="hidden" name="action" value="adding_property" >
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
                  <input form="addPropertyForm" id="property" type="text" class="form-control @error('property') is-invalid @enderror" name="property" value="{{ old('property') }}" required autocomplete="property" placeholder="Name of your property">
              
                  @error('property')
                     <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                 @enderror
              
                </div>
                <hr>
              
                <div class="form-group row">
                 
                <div class="col-sm-6">
                  <small>Property Ownership</small>
                  <select form="addPropertyForm" id="property_ownership" class="form-control form @error('property_ownership') is-invalid @enderror" name="property_ownership" value="{{ old('property_ownership') }}" required autocomplete="property_ownership">
                    <option value="">Please select one</option>
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
                 <select form="addPropertyForm" id="property_type" type="text" class="form-control @error('property_type') is-invalid @enderror" name="property_type" value="{{ old('property_type') }}" required autocomplete="property_type" required>
                   <option value="">Please select one</option>
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
                  </div> 
                  <hr>

                    <button form="addPropertyForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;"> 
                       Next
                    </button>
    
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
