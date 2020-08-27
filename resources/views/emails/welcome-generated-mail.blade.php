@component('mail::message')
# Dear,  {{ Auth::user()->name }} 

Welcome to the The Property Manager!

<br>
Below are your property details:
<br>
Email: {{ Auth::user()->email }}
<br>
Property: {{ Auth::user()->property }}
<br>
Property Type: {{ Auth::user()->property_type }}
<br>
Property Ownership: {{ Auth::user()->property_ownership }}
<br>
Plan: {{ Auth::user()->account_type }}

<br><br>
During the Free Trial, you are welcome to use all the features in The Property Management System. Should you need help with setting up your property or with using any of the features, please let me know. 

            
I am available to take your call anytime from 8am to 8pm at this number 09752826318.

Hope to hear from you soon!

Thanks,<br>
The Property Manager
@endcomponent
