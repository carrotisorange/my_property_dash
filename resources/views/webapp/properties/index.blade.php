@extends('templates.website.arsha-login')

@section('title', 'Properties')

@section('sidebar')


@endsection

@section('css')

@endsection

@section('content')

<form   class="user" action="/property/select" method="POST">
    @csrf
      <div class="text-center">
        @if($properties->count() <=0 )
        <h1 class="h4 text-gray-900 mb-4">Please add your property...</h1>
        @else
        <h1 class="h4 text-gray-900 mb-4">Select a property to manage...</h1>
        @endif
       
      </div>

      @foreach ($properties as $item)
      <div class="form-check form-check-inline">

        <input class="form-check-input" type="radio" name="selectedProperty" id="inlineRadio1" value="{{ $item->property_id }}" checked>

          <div class="col-xl-12 col-md-12 mb-4 mx-auto">
            <div class="card shadow h-100 py-3">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1"> {{ $item->name }}</div>
                    {{-- <small>{{ number_format($item->total_units, 0) }} rooms</small> --}}
                      <small>{{ $item->type}} &#9671 {{ $item->ownership }} </small>
                  </div>

                  <div class="col-auto">
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
              <div class="col mr-2 ">
                <small><p class="text-right">added on {{ Carbon\Carbon::parse( $item->created_at)->format('M d Y') }}</p> </small>
              </div>

            </div>
            <input type="hidden" name="property_id" value="{{ $item->property_id }}">
           

          </div>

      </div>
 
      @endforeach
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
            <a title="Upgrade to Pro to add more users." href="/property/{{ $item->property_id }}/user/all" class="btn btn-warning btn-user btn-block"> <i class="fas fas fa-users"></i>  User ({{ $users }}/2) </a>
            @else
            <a title="Limited to 2 users." href="/property/{{ $item->property_id }}/user/create" class="btn btn-warning btn-user btn-block"> <i class="fas fas fa-plus-circle"></i> User ({{ $users }}/2)</a>
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
      <br>
      @if (Auth::user()->user_type === 'manager')
      @if($users <= 1)
      <div class="row">
        <div class="col">
            <a class="btn btn-info btn-user btn-block" href="/asa" >Import {{ $existing_users }} existing users.</a>
      
        </div>
      </div>
      @endif
      @endif
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
        <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Trial period has expired</h5>
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
       <div class="modal-body">
         <p class="text-center">
           Would you like to proceed with the payment?
           <br>
         
         </p>
       </div>
      <div class="modal-footer">
        <a href="/#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a> 
        <a href="#" data-toggle="modal" data-target="#openPaymentInfo" class="btn btn-success"><i class="fas fa-credit-card"></i> Proceed</a> 

    
      </div> 
      </div>
      </div>
      
      </div>

      <div class="modal fade" id="openProVersion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-info" id="exampleModalLabel"><i class="fas fa-exclamation-info"></i> Upgrade to Pro</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
         <div class="modal-body">
           <p class="text-center">
            <span class="font-italic font-weight-bold">Upgrade to Pro to add more properties.</span>
            <br>
             Would you like to proceed with the payment?
             <br>
           
           </p>
         </div>
        <div class="modal-footer">
          <a href="/#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a> 
          <a href="#" data-toggle="modal" data-target="#openPaymentInfo" class="btn btn-success"><i class="fas fa-credit-card"></i> Proceed</a> 
  
      
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
           <p>
            Please select your <span> <a target="_blank" href="/#pricing">plan</a></span> and send your proof of payment to the email address <span class="font-italic font-weight-bold">thepropertymanager2020@gmail.com</span>
            <ul>
              <li>  GCash = 09752826318 </li>
              <li>  BDO = 0009 4037 3114</li>
            </ul>
           </p>
         
         </div>
        <div class="modal-footer">

         <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-sm text-white-50"></i> Close </button>
      
        </div> 
        </div>
        </div>
        
        </div>
  
@endsection

@section('scripts')

@endsection



