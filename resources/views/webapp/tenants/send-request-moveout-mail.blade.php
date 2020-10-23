

    <p>
        <h3> Hello, {{ $name }}! </h3>
        Your moveout in {{ $unit }} with contract from {{ Carbon\Carbon::parse($contract_starts_at)->format('M d Y') }} to {{ Carbon\Carbon::parse($contract_ends_at)->format('M d Y') }} has been initiated.
        Please pay your unpaid balance and moveout charges of ₱ {{ number_format($balance->sum('balance'),2) }} at the treasury office.
        <br><br>
        Breakdown of the unpaid balance and moveout charges:
        
            <table class="table table-bordered">
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
        
        <br>
        <p><b>This is a system generated message, and we do not receive emails from this account, please direct all your inquiries and concerns through this email {{ Auth::user()->email }} instead. </b></p>
        <br>
        Thanks,<br>
        {{ Auth::user()->property }}
    </p>
        