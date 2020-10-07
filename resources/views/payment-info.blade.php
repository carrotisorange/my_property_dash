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

  <script src="https://js.stripe.com/v3/"></script>

  <style>
    .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #8629f8 !important;
}
  </style>

<style>
/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}

</style>
</head>

<body class="">

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v8.0'
        });
      };
  
      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  
    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
      attribution=setup_tool
      page_id="580584885947359">
    </div>
    
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

  <div class="col-md-5 mx-auto">

   
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
       
        
        <!-- Nested Row within Card Body -->
        <div class="row">

          {{-- <div class="col-lg-7 d-none d-lg-block">
            <div class="p-5">
                <div class="">
                  <h1 class="h4 text-gray-900 mb-4">User and Company Profile</h1>
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
               
          </div> --}}
          <div class="col-md-12">
           
                
          @if(Auth::user()->account_type === null)

          <div class="p-5">
             
            <h1 class="h4 text-gray-900 mb-4">Select Your Plan</h1>
        
            <form id="selectingPlanForm" action="/users/{{ Auth::user()->id }}/plan" method="POST">
              @method('put')
              {{ csrf_field() }}

          
          <div class="form-group">
            <select class="form-control" name="account_type" id="">
              <option value="">Please select one</option>
              <option value="Free">Free | 20 rooms | ₱0/mo </option>
              <option value="Medium">Medium | 50 rooms | ₱950/mo</option>
              <option value="Large">Large | 100 rooms | ₱1800/mo</option>
              <option value="Enterprise">Enterprise | 200 rooms | ₱2400/mo </option>
              <option value="Corporate">Corporate | 500 rooms | ₱4800/mo </option>
            </select>
        </div>
        <button form="selectingPlanForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;"> 
          Submit
       </button>

      </form>
  
       <hr>
            </div>
          @else

          @if(Auth::user()->account_type === 'Free')
          <div class="p-5">
            
             
              <h1 class="h4 text-gray-900 mb-4">Select Your Plan</h1>
          
              <form id="selectingPlanForm" action="/users/{{ Auth::user()->id }}/plan" method="POST">
                @method('put')
                {{ csrf_field() }}
  
            
            <div class="form-group">
              <select class="form-control" name="account_type" id="" onchange='this.form.submit()'>
                <option value="{{ Auth::user()->account_type }}">{{ Auth::user()->account_type }}</option>
                <option value="Free">Free | 20 rooms | ₱0/mo </option>
                <option value="Medium">Medium | 50 rooms | ₱950/mo </option>
                <option value="Large">Large | 100 rooms | ₱1800/mo </option>
                <option value="Enterprise">Enterprise | 200 rooms | ₱2400/mo</option>
                <option value="Corporate">Corporate | 500 rooms | ₱4800/mo</option>
              </select>
          </div>
          {{-- <button form="selectingPlanForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;"> 
            Change Plan
         </button> --}}
  
        </form>
    
         <hr>
              
         
         <form action="/users/{{ Auth::user()->id }}/charge" method="POST" id="payment-form">
           @csrf
         
           <p class="text-right">  <button type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;"> Finish</button> </p>
         </form>

           </div>
          @else
          <div class="p-5">
        
             
              <h1 class="h4 text-gray-900 mb-4">Select Your Plan</h1>
          
              <form id="selectingPlanForm" action="/users/{{ Auth::user()->id }}/plan" method="POST">
                @method('put')
                {{ csrf_field() }}
  
            
            <div class="form-group">
              <select class="form-control" name="account_type" id="" onchange='this.form.submit()'>
                <option value="{{ Auth::user()->account_type }}">{{ Auth::user()->account_type }}</option>
                <option value="Free">Free | 20 rooms | ₱0/mo </option>
                <option value="Medium">Medium | 50 rooms | ₱950/mo</option>
                <option value="Large">Large | 100 rooms | ₱1800/mo</option>
                <option value="Enterprise">Enterprise | 200 rooms | ₱2400/mo</option>
                <option value="Corporate">Corporate | 500 rooms | ₱4800/mo </option>
              </select>
          </div>
          {{-- <button form="selectingPlanForm" type="submit" class="btn btn-primary btn-user btn-block" id="registerButton" onclick="this.form.submit(); this.disabled = true;"> 
            Change Plan
         </button> --}}
  
        </form>
    
         <hr>
             
           <h3 class="h4 text-gray-900 mb-4">Payment Details</h1>
         
         <form action="/users/{{ Auth::user()->id }}/charge" method="POST" id="payment-form" onsubmit="return checkForm(this);">
           @csrf
           <div class="form-group">
             <label for="card-element">
               Credit or debit card
             </label>
             <div id="card-element">
               <!-- A Stripe Element will be inserted here. -->
             </div>
         
             <!-- Used to display form errors. -->
             <div id="card-errors" role="alert"></div>
           </div>
           
           {{-- <small class="text-danger">Card won't be charge until {{ Carbon\Carbon::now()->addMonth()->format('M d Y')  }}.</small> --}}
           <br>
           @foreach (['danger', 'warning', 'success', 'info'] as $key)
           @if(Session::has($key))
          
             <strong class="text-danger">{{ Session::get($key) }}</strong>
         
           @endif
           @endforeach
           <br>
           
           <button type="submit" name="myButton" class="btn btn-primary btn-user btn-block"> Finish</button>
         </form>
   
           </div>

          @endif

          @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <br><br>
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

  <script>
   // Create a Stripe client.
var stripe = Stripe('pk_test_51HJukYJRwyQ1aYnqdaz49Eiy0wpOyvQRyc5Vy9mt314nJuwjt2XRepCxnum8BJSOlAhALLohFJFmr5Q98nEv4PM900opF4E895');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
  </script>

<script type="text/javascript">
    function checkForm(form) // Submit button clicked
  {
    form.myButton.disabled = true;
    form.myButton.value = "Please wait...";
    return true;
  }
  </script>

  
</body>

</html>
