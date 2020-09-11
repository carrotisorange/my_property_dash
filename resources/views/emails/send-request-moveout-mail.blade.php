<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>

<body>

    <p>
        <h3> Hello, {{ $name }}! </h3>
        Request for moveout contract in {{ $unit }} with contact {{ Carbon\Carbon::parse($contract_starts_at)->format('M d Y') }} - {{ Carbon\Carbon::parse($contract_ends_at)->format('M d Y') }} has been initiated.
        Please pay unpaid balance and moveout charges of ₱ {{ number_format($balance->sum('balance'),2) }} at the treasury office.
        <br><br>
        Breakdown of the unpaid balance and moveout charges:
        <div class="table-responsive text-nowrap">
            <table class="table">
              <tr>
                <th>Bill No</th>
                <th>Description</th>
                <th colspan="2">Period Covered</th>
                <th>Amount</th>
              </tr>
              @foreach ($balance as $item)
              <tr>
                  <td>{{ $item->billing_no }}</td>
                  <td>{{ $item->billing_desc }}</td>
                  <td>
                    {{ $item->billing_start? Carbon\Carbon::parse($item->billing_start)->format('M d Y') : null}} -
                  </td>
                  <td>
                    {{ $item->billing_end? Carbon\Carbon::parse($item->billing_end)->format('M d Y') : null }}
                  </td>
                  <td>{{ number_format($item->balance,2) }}</td>
                </tr>
              @endforeach
        
          </table>
          <table class="table">
            <tr>
             <th>TOTAL AMOUNT PAYABLE</th>
             <th colspan="4" class="text-right">{{ number_format($balance->sum('balance'),2) }} </th>
            </tr>
          </table>
        </div>
        <br>
        <p><b>This is a system generated message, and we do not receive emails from this account, please direct all your inquiries and concerns through this email {{ Auth::user()->email }} instead. </b></p>
        <br>
        Thanks,<br>
        {{ Auth::user()->property }}
    </p>
        

</body>

</html>
