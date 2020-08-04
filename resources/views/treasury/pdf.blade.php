<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
      body {
        font: normal 8px Verdana, Arial, sans-serif;
          }
    </style>
    
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h5 class="text-black-50">{{ Auth::user()->property }}</h5>
          <p class="text-right"> <b>AR No:</b> {{ $payment_ar }}</p>
          <ul style="list-style-type: none">
            <li><b>Date:</b> {{ Carbon\Carbon::parse($payment_date)->format('M d Y') }}</li>
            <li><b>To:</b> {{ $tenant }}</li>
            <li><b>Room:</b> {{ $unit }} </li>
          </ul>
          <p class="text-right">Acknowledgment Receipt</p>
            <table class="table text-right" width="100%" cellspacing="0" cellpadding="0">
              <tr>
              
                <th>Bill No</th>
                <th>Description</th>
                <th>Date</th>
                <th>Amount</th>
              </tr>
              @foreach ($payment_breakdown as $item)
              <tr>
                
                <td>{{ $item->payment_billing_no }}</th>
                <td>{{ $item->payment_note }}</td>
                <td>
                  @if($item->or_number === null)
                  -
                  @else
                  {{ $item->or_number }}
                  @endif
                <td >{{ number_format($item->amt_paid,2) }}</td>
              </tr>
              @endforeach
          </table>
          <table class="table" width="100%" cellspacing="0">
            <tr>
             <th>TOTAL</th>
             <th class="text-right">{{ number_format($payment_amt,2) }}</th>
            </tr>
            <tr>
              <th>RUNNING BALANCE</th>
              <th class="text-right">{{ number_format($running_balance,2) }}</th>
             </tr>
          </table>
          <ul style="list-style-type: none">
            <li><b>Issued by:</b> {{ Auth::user()->name }}</li>
            <li>{{ ucfirst(Auth::user()->user_type).' of '. Auth::user()->property }}</li>
          </ul>
        
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