<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"><link href="{{ asset('index/assets/img/favicon.ico') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- Custom styles for this template-->
  <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('/arsha/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  
  <script src="https://js.stripe.com/v3/"></script>

  <style>
    .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
        background-color: #8629f8 !important;
    }
  </style>

</head>

<body>
  @include('layouts.arsha.messenger-chatbot')

  <div class="col-md-5 mx-auto">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-lg my-5 rounded">
            <div class="card-body p-1">
                <div class="p-5">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('dashboard/js/sb-admin-2.min.js') }}"></script>

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



