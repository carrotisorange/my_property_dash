
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  </head>
  <body>
    <div class="container-fluid">
          
      <!-- 404 Error Text -->
      <h4 class="text-center">ACCOUNTING DEPARTMENT</h4>
      <p class="text-center">
          Bareng Drive, Purok 11 Bakakeng Sur, Baguio City, 2600 Philippines
          <br>
          E-mail add: marthagoshenland@yahoo.com.ph; CP No. 09467576159/ 09068758142
      </p>
      <h5 class="text-center">{{strToUpper( Auth::user()->property) }}</h5>
      <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
          <tr>
              <td>Tenant: <b>{{ $tenant }}</b></td>
              <td class="text-right" colspan="2">Date: <b>{{ Carbon\Carbon::parse( $payment_date )->format('M d Y') }}</b></td>
          </tr>
          <tr>
              <td>Unit/Room: 
                  <b>
                       {{ $unit }} 
                  </b>
              </td>
              <td>
                |
              </td>
            </tr>
      </table>
       <table class="table table-bordered" width="100%" cellspacing="0">
        <tr>
          <th class="text-center" colspan="2">ACKNOWLEDGMENT RECEIPT</th>
      </tr>
      <tr>
         <th>Description</th>
          <th>Amount</th>
      </tr>
      <tr>
         <td>{{ $payment_desc }}</td>
          <td>{{ number_format($payment ,2) }} </td>
      </tr>
      </table>
      <br>
      <div class=card">
          <div class="card-body">
              <b class="text-center ">Notice to All Tenants: </b>
                  <br>
                  Failure to pay the amount due on 7th of the month there will be a 10% surcharge and subject your unit to DISCONNECTION of utilities (water & electric)
                  <br>
                  THIS SERVES AS YOUR INITIAL NOTICE (DEMAND LETTER)
                  You can also deposit your cash/check payment to any BDO Branch:
                  <br>
                  <b class="text-center ">BDO Account</b>
                  <br>
                  Account Name: Martha GoshenLand Property Management Inc.
                  <br>
                  Account Number: 0009-4032-9085
          </div>
      </div>
   </div>

      

  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

