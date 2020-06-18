<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/77bb6f2aef.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- ChartStyle --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    <b>The Property Manager</b>
                    <h6>The Property Management System of GoDi</h6>
                </a> 
                @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{Auth::user()->property }}
                </a>
                
                @endguest
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <h5><a class="nav-link  btn" href="/register">Register your property <i class="fas fa-user-circle"></i></a></h5>
                            </li>
                            <li class="nav-item">
                                <h5><a class="nav-link  btn" href="/properties">Make a reservation <i class="far fa-calendar-check"></i></a></h5>
                            </li>
                            <li class="nav-item">
                                <h5><a class="nav-link btn " href="/faq">FAQ <i class="fas fa-question-circle"></i></a></h5>
                            </li>
                           
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{  explode(' ',trim(Auth::user()->name))[0] }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="users/{{ Auth::user()->id }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                   

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('notifications')
            @yield('content')
        </main>
    </div>
    <footer class="page-footer font-small blue-grey lighten-5">
        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5">
      
        <!-- Footer Links -->
      
        <!-- Copyright -->
        <div class="footer-copyright text-center text-black-50 py-3">© 2020 Copyright:
          <a class="dark-grey-text" href="#">DormRun.com</a>
        </div>
        <!-- Copyright -->
      
      </footer>
</body>
<script>
    $(document).ready(function() {
        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
        });
    });
</script>
    
</html>