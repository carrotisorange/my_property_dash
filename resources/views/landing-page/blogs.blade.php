@extends('layouts.arsha.template')

@section('title', 'Blogs | The Property Manager')

@section('nav-bar')
<header id="header" class="fixed-top header-inner-pages">
  <div class="container d-flex align-items-center">
      <h3 class="logo mr-auto"><img src="{{ asset('/arsha/assets/img/logo.png') }}" alt="" class=""><a href="/">Blogs</a></h3> 
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="/" class="logo mr-auto"></a> 
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="/">Home</a></li>
          <li class="active"><a target="_blank" href="/blogs">Blogs</a></li>
          <li><a target="_blank" href="/listings">Listings</a></li>
          <li><a target="_blank" href="/pricing">Payment</a></li>
        </ul>
      </nav>
      <!-- .nav-menu -->
      <a href="/login"  target="_blank" class="get-started-btn scrollto">Login</a>
    </div>
</header>
@endsection

@section('content')
<br><br><br><br><br><br>
  <div class="col-md-9 mx-auto">
    <h5>Guidelines on Concessions on Residential and Commercial Rents During Covid 19 in the Philippines.</h5>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{ asset('/arsha/assets/img/blog1.jpg') }}" alt="First slide">
          
        </div>
        
      </div>
      
    </div>
    <br>
    <footer class="blockquote-footer">Pamela Tecson <cite title="Source Title">on {{ Carbon\Carbon::now()->format('M d Y') }}</cite></footer>
  </div>

@endsection
@section('scripts')

@endsection



