<p>
<h3> Welcome, {{ $name }}! </h3>
You're now officially a resident of {{ Auth::user()->property }}.
<br><br>
Your contract in unit {{ $unit }} starts from {{ Carbon\Carbon::parse($contract_starts_at)->format('M d Y') }} to {{ Carbon\Carbon::parse($contract_ends_at)->format('M d Y') }}.
<br><br>
The billing cycle starts every 1st day of the month, and if your movein date happens to be not on the first day of the month, 
expect you're first bill to be prorated, meaning that you'll only have to pay from the date of you're movein 
till last day of the current month.
<br>
<br>
<b> Formula for computation of prorated rent:</b>
<small>
    <br>
    x = Last day of the month of your move in date.
    <br>
    y = Actual move in date.
    <br>
    z = Monthly Rent
    <br>
    n = Number of days of the month of you move in.
    <br>
    =====================================
    <br>
   <b>Prorated Rent = (( x- y ) / n ) * z  </b>
</small>

<br><br>
For the next succeeding months your rent will be Php {{ number_format($monthly_rent,2) }}except for the last month of your, which will again be prorated.
<br><br>
Please inform us atleast 1 month before your contract expires, otherwise your contract will be automatically extended to another month.
<br><br>
Thank you for choosing {{ Auth::user()->property }}. Enjoy your stay!
<br>
<br>
<p><b>This is a system generated message, and we do not receive emails from this account, please direct all your inquiries and concerns through this email {{ Auth::user()->email }} instead. </b></p>
<br>
Thanks,<br>
{{ Auth::user()->property }}
</p>
