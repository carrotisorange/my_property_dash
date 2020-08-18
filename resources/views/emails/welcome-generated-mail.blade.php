@component('mail::message')
# Hello, <b> {{ Auth::user()->name  }} </b>

Thank you for using The Property Manager to manage <b> {{ Auth::user()->property.' '.Auth::user()->property_type }} </b>. 

You have 30 days to enjoy our platform in <b> {{ Auth::user()->account_type }} </b> plan for free.

Your free subscription will expire on <b> {{ Carbon\Carbon::parse(Auth::user()->created_at)->addMonth()->format('M d Y') }} </b>.


Thanks,<br>
The Property Manager
@endcomponent
