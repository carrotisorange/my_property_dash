<p>
<h3> Welcome, {{ $name }}! </h3>
You're now officially a resident of {{ Auth::user()->property }}.
<br><br>
Your contract in unit {{ $unit }} is from {{ Carbon\Carbon::parse($contract_starts_at)->format('M d Y') }} to {{ Carbon\Carbon::parse($contract_ends_at)->format('M d Y') }}.
Please take note that the billing cycle starts every 1st day of the month. If your movein date happens to be not on the first day of the month, then
your first bill is prorated, which means that you'll only have to pay from the date of your movein to the last day of the current month.
<br>
<br>
<b> Formula for computation of prorated rent:</b>
<small>
    <br>
    x = Movein date.
    <br>
    y = Last date of the month.
    <br>
    z = Monthly rent
    <br>
    n = Number of days of the month of you move in.
    <br>
    =====================================
    <br>
   <b>Prorated Rent = (( y - x ) / n ) * z  </b>
</small>

<br><br>
For the succeeding months your rent will be Php {{ number_format($monthly_rent,2) }}, until the last month of your contract, which will again be prorated.
<br><br>
<b>Extension/Moveout Process</b>
<br>
1. Tenant receives a 1 month notice regarding contract expiration.
<br>
2. Tenant responds to the email {{ Auth::user()->email }}. Otherwise, contract will be automatically extended to another month.
<br><br>
Thank you for staying in {{ Auth::user()->property.' '.Auth::user()->property_type }}!
<br>
<br>
<p><b>This is a system generated message, and we do not receive emails from this account. Please send all your inquiries and concerns through this email {{ Auth::user()->email }} instead. </b></p>
<br>
Thanks,<br>
{{ Auth::user()->property.' '.Auth::user()->property_type}}
</p>
