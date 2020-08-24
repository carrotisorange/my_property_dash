@extends('layouts.app')
@section('title', 'My Property Dash')
@section('content')
<div class="container">
    <h5>Showing {{ $properties->count() }} properties...</h5>
    <br>
    <div class="row">
            @foreach ($properties as $item)
            <div class="col">
            <div class="card" style="width: 18rem;">
                {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                <div class="card-body">
                    <h5 class="card-title">{{ $item->unit_property }}</h5>
                    <p class="card-text">{{ $item->count_building }} buildings, {{ $item->count_unit_no }} rooms</p>
                    <a href="#" class="card-link">Visit FB Page</a>
                    <a href="/{{$item->unit_property}}/units" class="card-link btn btn-purple">Book a room</a>
                </div>
              </div>
              <br>
            </div>
             
              @endforeach
    </div>
</div>  
@endsection