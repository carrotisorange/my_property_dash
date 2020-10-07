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
During the Free Trial, you are welcome to use all the features of The Property Online. Should you need help with setting up your property or with using any of the features of the application, feel free to send us a message through the messenger chatbot, located at the bottom left corner, available at any given time. 


Hope to hear from you soon!

Thanks,<br>
The Property Manager
@endcomponent
