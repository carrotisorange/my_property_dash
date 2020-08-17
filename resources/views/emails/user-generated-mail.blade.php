@component('mail::message')
# Welcome, new tenant!

You're now officially a resident of {{ Auth::user()->property.' '.Auth::user()->property_type }}.

The billing cycle starts every 1st day of the month, and if your movein date happens to be not on the first day of the month, 
expect you're first bill to be prorated, meaning that you'll only have to pay only from the date of you're movein 
till last day of the current month.

 For the next succeeding months you're rent will be the rent you signed in the contract
except for the last month of your stay, which will again be prorated.

Please inform us atleast 1 month before your contract expires, otherwise your contract will be automatically 
extended to another month.

For any concerns please send it to {{ Auth::user()->email }}.

Thank you for choosing {{ Auth::user()->property }}.Enjoy your stay!


Thanks,<br>
{{ Auth::user()->property }}
@endcomponent
