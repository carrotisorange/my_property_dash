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

<body>

    <!-- End of Topbar -->
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h5 class="text-black-50">{{ Auth::user()->property }}</h5>
          {{-- <p class="text-right"> <b>AR #:</b> </p> --}}
          <ul style="list-style-type: none">
            <li><b>Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->format('M d Y') }}</li>
            <li class="text-danger"><b>Due Date:</b> {{ Carbon\Carbon::now()->firstOfMonth()->addDays(7)->format('M d Y') }}</li>
            <li><b>To:</b> {{ $tenant }}</li>
            <li><b>Unit/Room:</b> {{ $unit }}</li>
          </ul>
          <p class="text-right">Statement of Accounts</p>
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
                  <td>
                    @if($item->details === null)
                    {{ $item->details }}
                    @else
                     -
                    @endif
                  </td>
                  <th class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</th>
              </tr>
              @endforeach
              
              @foreach ($other_bills as $item)
              <tr>
                <th>{{ $item->billing_id }}</th>
                  <td>{{ $item->billing_desc }}</td>
                  <td> 
                    @if($item->details === null)
                    {{ $item->details }}
                    @else
                     -
                    @endif
                  </td>
                  <th class="text-right" colspan="3">{{ number_format($item->billing_amt,2) }}</th>
              </tr>
              @endforeach
        
          </table>
          <table class="table" width="100%" cellspacing="0">
            <tr>
             <th>TOTAL AMOUNT PAYABLE</th>
             <th class="text-right">{{ number_format($total_bills,2) }} </th>
            </tr>
            @if($tenant_status === 'pending')

            @else
            <tr>
              <th class="text-danger">TOTAL AMOUNT PAYABLE AFTER DUE DATE (+10%)</th>
              <th class="text-right text-danger">{{ number_format($total_bills + ($total_bills * .1) ,2) }}</th>
             </tr>
            @endif  
          </table>
          <ul style="list-style-type: none">
            <li><b>Posted by:</b> {{ Auth::user()->name }}</li>
            <li>{{ Auth::user()->user_type.' of '. Auth::user()->property }}</li>
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
