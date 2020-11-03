@extends('templates.webapp-new.dashboard')

@section('content')
<form   class="user" action="/property/select" method="POST">
  @csrf
{{-- <div class="text-center">
  @if($properties->count() <=0 )
  <h1 class="h4 text-gray-900 mb-4">Please add your property...</h1>
  @else
  <h1 class="h4 text-gray-900 mb-4">Select a property to manage...</h1>
  @endif
 
</div> --}}
@foreach ($properties as $item)
<input type="hidden" name="property_id" value="{{ $item->property_id }}">
<div class="row">
  <div class="col-md-12">
    <input class="form-check-input" type="hidden" name="selectedProperty" id="inlineRadio1" value="{{ $item->property_id }}" checked>
    <div class="card card-stats">
      <!-- Card body -->
      
      <div class="card-body">
        <div class="row">
          <div class="col">
            <span class="h2 font-weight-bold mb-0">{{ $item->name }}</span>
            <h5 class="card-title text-uppercase text-muted mb-0">{{ $item->type}} &#9671 {{ $item->ownership }} </h5>
          </div>
          <div class="col-auto">
            
            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
              @if($item->type=='Condominium Associations')
              <i class="fas fa-building fa-2x text-gray-300"></i>
              @elseif($item->type=='Commercial Complex')
              <i class="fas fa-store fa-2x text-gray-300"></i>
              @else
              <i class="fas fa-home fa-2x text-gray-300"></i>
              @endif
       
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
          {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> --}}
          <span class="text-nowrap">added on {{ Carbon\Carbon::parse( $item->created_at)->format('M d Y') }}</span>
        </p>
      </div>
    </div>
  </div>
</div>
@if(Auth::user()->trial_ends_at > Carbon\Carbon::today())
<p class="text-danger"><i class="fas fa-info-circle"></i> Trial ends at {{ Carbon\Carbon::parse(Auth::user()->trial_ends_at)->format('M d Y') }}</p>
@else
{{-- <p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Trial ended at {{ Carbon\Carbon::parse(Auth::user()->trial_ends_at)->format('M d Y') }}</p> --}}
@endif
<hr>
<div class="row">
  <div class="col">
    @if ($properties->count() <= 0)
    <a href="/property/create" class="btn btn-primary btn-user btn-block"><i class="fas fa-plus-circle"></i> Property </a>
    @else
    <a href="#" data-toggle="modal" data-target="#openProVersion" class="btn btn-secondary btn-user btn-block"> <i class="fas fas fa-plus-circle"></i> Property</a>
    @endif
   {{-- @if(Auth::user()->user_type === 'manager')
    
   @else
   <a title="Please get in touch with your manager..." href="#/" class="btn btn-secondary btn-user btn-block">Add </a>
   @endif --}}
  </div>

  @if ($properties->count() > 0)
 
  <div class="col">
    @if (Auth::user()->user_type === 'manager')
      @if($users > 1)
      <a title="Upgrade to Pro to add more users." href="/property/{{ $item->property_id }}/user/all" class="btn btn-warning btn-user btn-block"> <i class="fas fas fa-users"></i>  Users ({{ $users }}/2) </a>
      @else
      <a title="Limited to 2 users." href="/property/{{ $item->property_id }}/user/create" class="btn btn-warning btn-user btn-block"> <i class="fas fas fa-plus-circle"></i> Users ({{ $users }}/2)</a>
      @endif
    @else
    <a title="Reserved for manager." href="#/" class="btn btn-warning btn-user btn-block"> <i class="fas fas fa-plus-circle"></i>  User ({{ $users }}/2) </a>
    @endif
  </div>
 
  <div class="col">
    @if(Auth::user()->trial_ends_at > Carbon\Carbon::today())
    <button type="submit" class="btn btn-success btn-user btn-block" onclick="this.form.submit(); this.disabled = true;"><i class="fas fa-hand-point-up"></i> Manage</button>
    @else
    <a href="#" data-toggle="modal" data-target="#showWarning" class="btn btn-success btn-user btn-block"><i class="fas fa-hand-point-up"></i> Manage</a> 
  
    @endif
  
  </div>
  @endif
  
  

</div>
{{-- <br>
@if (Auth::user()->user_type === 'manager')
  @if($users <= 0)
  <div class="row">
    <div class="col">
        <a class="btn btn-info btn-user btn-block" href="/asa" >Import {{ $existing_users }} existing users.</a>
  
    </div>
  </div>
  @endif
@endif --}}
<hr>
<small>Need help?</small>
<br><br>
<div class="row">
  <div class="col">
    <a href="https://www.youtube.com/watch?v=5wxvKBkhDqQ" target="_blank" class="btn btn-danger btn-user btn-block"> <i class="fab fa-youtube"></i> Watch </a>
    </div>
    <div class="col">
      <a title="Please tap the bottom left side of your screen." href="#/"  class="btn btn-primary btn-user btn-block"> <i class="fab fa-facebook-messenger"></i> Chat </a>
      </div>
</div>

</form>


<div class="modal fade" id="showWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Trial period has expired!</h5>
  
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
   <div class="modal-body">
     <div class="row">
       <div class="col">
        <div id="paypal-button-container"></div>
        <script src="https://www.paypal.com/sdk/js?client-id=AS3b0Cqy_--ZSpoccAk2pjqoBhgX4nOlZw39M8gn1pZXfyJInpqCISDObLItpdQxwpFQCpRungfEVXKm&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
        <script>
          paypal.Buttons({
              style: {
                  shape: 'pill',
                  color: 'blue',
                  layout: 'vertical',
                  label: 'subscribe'
              },
              createSubscription: function(data, actions) {
                return actions.subscription.create({
                  'plan_id': 'P-22V02059X4829882AL6QOQ4I'
                });
              },
              onApprove: function(data, actions) {
                alert(data.subscriptionID);
              }
          }).render('#paypal-button-container');
        </script>
       </div>
     </div>
    {{-- <div class="row">
      <div class="col ">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" value="MHLEPETFFAZBQ">
         
          <input type="hidden" name="on0" value="Plans">Please select your plan
          <select class="form-control"  name="os0">
            <option value="Medium">Medium : P1.00 PHP - monthly</option>
            <option value="Large">Large : P1,800.00 PHP - monthly</option>
            <option value="Enterprise">Enterprise : P3,000.00 PHP - monthly</option>
          </select> 
          <br>
          <input class="text-center" type="hidden" name="currency_code" value="PHP">
          <input class="text-center" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
          <img class="text-center" alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
      </div>
        
     </div> --}}
   </div>
  <div class="modal-footer">
    {{-- <a href="/#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a> 
    <a href="#" data-toggle="modal" data-target="#openPaymentInfo" class="btn btn-success"><i class="fas fa-credit-card"></i> Proceed</a>  --}}


  </div> 
  </div>
  </div>
  
  </div>

  <div class="modal fade" id="openProVersion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-exclamation-primary"></i> Upgrade to Pro</h5>
    
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
     <div class="modal-body">
       <div class="row">
        <div class="col ">
          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="MHLEPETFFAZBQ">
           
            <input type="hidden" name="on0" value="Plans">Plans
            <select class="form-control"  name="os0">
              <option value="Medium">Medium : P950.00 PHP - monthly</option>
              <option value="Large">Large : P1,800.00 PHP - monthly</option>
              <option value="Enterprise">Enterprise : P3,000.00 PHP - monthly</option>
            </select> 
            <br>
            <input class="text-center" type="hidden" name="currency_code" value="PHP">
            <input class="text-center" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img class="text-center" alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
          
       </div>
     </div>
    <div class="modal-footer">
      {{-- <a href="/#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a>  --}}
      {{-- <a href="#" data-toggle="modal" data-target="#openPaymentInfo" class="btn btn-success"><i class="fas fa-credit-card"></i> Proceed</a>  --}}

  
    </div> 
    </div>
    </div>
    
    </div>

  <div class="modal fade" id="openPaymentInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-credit-card"></i> Payment Instructions</h5>
    
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
     <div class="modal-body">
       {{-- <p>
        Please select your <span> <a target="_blank" href="/#pricing">plan</a></span> and send your proof of payment to the email address <span class="font-italic font-weight-bold">thepropertymanager2020@gmail.com</span>
        <ul>
          <li>  GCash = 09752826318 </li>
          <li>  BDO = 0009 4037 3114</li>
        </ul>
       </p> --}}
     
     </div>
    <div class="modal-footer">

     <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-sm text-white-50"></i> Close </button>
  
    </div> 
    </div>
    </div>
    
    </div>
@endforeach
@endsection