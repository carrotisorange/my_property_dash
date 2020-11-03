@extends('templates.webapp-new.dashboard')


@section('welcome')

@if ($properties->count() > 0)
<h1 class="text-white">Welcome, {{ Auth::user()->name }}!</h1>
<p class="text-lead text-white">Simplifying property management.</p>
@else
<h1 class="h4 text-gray-900 mb-4">Please add your property...</h1>
<a href="/property/create" class="btn btn-primary btn-user btn-block"><i class="fas fa-plus-circle"></i> Property </a>

@endif
@endsection

@section('content')

<form   class="user" action="/property/select" method="POST">
  @csrf
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
<p class="text-danger"><i class="fas fa-info-circle"></i> Trial ends on {{ Carbon\Carbon::parse(Auth::user()->trial_ends_at)->format('M d Y') }}</p>
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
 <a title="Please get in touch with your manager..." href="#/" class="btn btn-secondary btn-user btn-block">Add </a>
   @else
   <a title="Please get in touch with your manager..." href="#/" class="btn btn-secondary btn-user btn-block">Add </a>
   @endif --}}
  </div>



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
    <p class="text-center">
      Would you like proceed with the payment?
    </p>
   </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-sm text-white-50"></i>No, cancel </button>
    <a href="/subscription/create" target="_blank" class="btn btn-primary"><i class="fas fa-arrow"></i> Yes, proceed</a>

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
  
     </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><i class="fas fa-times fa-sm text-white-50"></i> Close </button>
      <a href="/#pricing" target="_blank" class="btn btn-info"><i class="fas fa-tags"></i> See pricing</a> 


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
@endif
@endsection

@section('scripts')

@endsection