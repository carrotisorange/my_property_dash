<p>
<h3> Welcome, {{ $name }}! </h3>
You're now officially a resident of {{ Auth::user()->property.' '.Auth::user()->property_type }}.
<br><br>
Your contract starts in unit {{ $unit }} from {{ Carbon\Carbon::parse($contract_starts_at)->format('M d Y') }} to {{ Carbon\Carbon::parse($contract_ends_at)->format('M d Y') }}.
<br><br>
The billing cycle starts every 1st day of the month, and if your movein date happens to be not on the first day of the month, 
expect you're first bill to be prorated, meaning that you'll only have to pay from the date of you're movein 
till last day of the current month.
<br><br>
For the next succeeding months you're rent will be the rent you signed in the contract ({{ $monthly_rent }})
except for the last month of your stay, which will again be prorated.
<br><br>
Please inform us atleast 1 month before your contract expires, otherwise your contract will be automatically 
extended to another month.
<br><br>
For any concerns please send it to {{ Auth::user()->email }}.
<br><br>
Thank you for choosing {{ Auth::user()->property }}. Enjoy your stay!
<br>
<br>
Thanks,<br>
{{ Auth::user()->property }}
</p>
