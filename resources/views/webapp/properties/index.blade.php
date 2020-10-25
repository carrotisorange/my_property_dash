@extends('templates.website.arsha-login')

@section('title', 'Properties')

@section('sidebar')


@endsection

@section('css')

@endsection

@section('content')

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
      <hr>
      <div class="row">
        <div class="col">
          @if ($properties->count() <= 0)
         <a href="/property/create" class="btn btn-primary btn-user btn-block"> Add </a>
         @else
          <a title="Upgrade to Pro" href="#/" class="btn btn-secondary btn-user btn-block"> <i class="fas fa-user-lock"></i> Add </a>
         @endif
        </div>

        @if ($properties->count() > 0)
        @if (Auth::user()->user_type === 'manager')
        <div class="col">
        <a title="Limited to 5 users only" href="/property/{{ $item->property_id }}/user/create" class="btn btn-warning btn-user btn-block"> <i class="fas fa-user-clock"></i> Users </a>
        </div>
        @endif
        <div class="col">
           
          <button type="submit" class="btn btn-success btn-user btn-block" onclick="this.form.submit(); this.disabled = true;"><i class="far fa-hand-point-up"></i> Manage</button>
        </div>
        @endif
        
        

      </div>
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

@endsection

@section('scripts')

@endsection



