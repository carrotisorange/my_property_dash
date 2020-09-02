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
          font: normal 7px Verdana, Arial, sans-serif;
          }
    </style>

</head>

<body>

    <!-- End of Topbar -->
    <div class="container">
          <h5 class="text-black-50">{{ Auth::user()->property }}</h5>
          {{-- <p class="text-right"> <b>AR #:</b> </p> --}}
          <p>
            <b>Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}
            <br>
            <span class="text-danger"><b>Due Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->addDays(7)->format('M d Y') }}</span>
            <br>
            <b>To:</b> {{ $tenant }}
            <br>
            <b>Room:</b> {{ $unit }}</b>
          </p>
       
          <p class="text-right">Statement of Accounts</p>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <tr>
                <th>Bill No</th>
                <th>Description</th>
                <th colspan="2">Period Covered</th>
                <th class="text-right" colspan="3">Amount</th>
              </tr>
              @foreach ($bills as $item)
              <tr>
                  <td>{{ $item->billing_no }}</th>
                  <td>{{ $item->billing_desc }}</td>
                  <td colspan="2">
                    {{ Carbon\Carbon::parse($item->billing_start)->format('M d Y') }} -
                    {{ Carbon\Carbon::parse($item->billing_end)->format('M d Y') }}
                  </td>
                  <th class="text-right" colspan="3">{{ number_format($item->balance,2) }}</th>
              </tr>
              @endforeach
        
          </table>
          <table class="table" >
            <tr>
             <th>TOTAL AMOUNT PAYABLE</th>
             <th class="text-right">{{ number_format($bills->sum('balance'),2) }} </th>
            </tr>
            @if($tenant_status === 'pending')

            @else
            <tr>
              <th class="text-danger">TOTAL AMOUNT PAYABLE AFTER DUE DATE (+10%)</th>
              <th class="text-right text-danger">{{ number_format($bills->sum('balance') + ($bills->sum('balance') * .1) ,2) }}</th>
             </tr>
            @endif  
          </table>
          </div>
         
  
            <pre>
              {{ Auth::user()->note }}
            <br>
            <b>Posted by:</b> {{ Auth::user()->name }}
            <br>
            {{ ucfirst(Auth::user()->user_type).' of '. Auth::user()->property }}
          </pre>


</body>

</html>
