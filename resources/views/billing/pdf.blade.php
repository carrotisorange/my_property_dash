<!DOCTYPE html>
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

<body id="page-top">

    <!-- End of Topbar -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h5 class="text-black-50">{{ Auth::user()->property }}</h5>
          {{-- <p class="text-right"> <b>AR #:</b> </p> --}}
          <ul style="list-style-type: none">
            <li><b>Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}</li>
            <li class="text-danger"><b>Due Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->addDays(7)->format('M d Y') }}</li>
            <li><b>To:</b> {{ $tenant }}</li>
            <li><b>Unit/Room:</b> {{ $unit }}</li>
          </ul>
          <p class="text-right">Statment of Accounts</p>
            <table class="table text-right" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Date</th>
                <th>Amount</th>
              </tr>
              @foreach ($rent_bills as $item)
              <tr>
                  <th>{{ $item->billing_id }}</th>
                  <td>{{ $item->billing_desc }}</td>
                  <td>{{ $item->details }}</td>
                  <th class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</th>
              </tr>
              @endforeach
              
              @foreach ($other_bills as $item)
              <tr>
                <th>{{ $item->billing_id }}</th>
                  <td>{{ $item->billing_desc }}</td>
                  <td>{{ $item->details }}</td>
                  <th class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</th>
              </tr>
              @endforeach
        
          </table>
          <table class="table" width="100%" cellspacing="0">
            <tr>
             <th>TOTAL AMOUNT PAYABLE</th>
             <th class="text-right">{{ number_format($total_bills,2) }} </th>
            </tr>
            <tr>
              <th class="text-danger">TOTAL AMOUNT PAYABLE AFTER DUE DATE (+10%)</th>
              <th class="text-right text-danger">{{ number_format($total_bills + ($total_bills * .1) ,2) }}</th>
             </tr>
          </table>
          <ul style="list-style-type: none">
            <li><b>Posted by:</b> {{ Auth::user()->name }}</li>
            <li>{{ Auth::user()->user_type.' of '. Auth::user()->property }}</li>
          </ul>
        
        </div>
      </div>

    </div>
</body>

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
</body>

</html>
