<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>The Property Manager</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/arsha/assets/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('/arsha/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/arsha/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/arsha/assets/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/arsha/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v2.2.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    .center-screen {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
}

  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      {{-- <h3 class="logo mr-auto"><a href="/" title="The Property Manager">The Property Manager</a></h3> --}}
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="/" class="logo mr-auto"><img src="{{ asset('/arsha/assets/img/logo.png') }}" alt="" class=""></a> 

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Features</a></li>
          <li><a href="#pricing">Pricing</a></li>
         
          <li><a href="/resources">Resources</a></li>
          {{-- <li class="drop-down"><a href="">Resources</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
          <li><a  href='#contact'>Contact</a></li>
          {{-- <li><a href="/properties" target="_blank">Tenant Portal</a></li> --}}
          <li><a href="/login" target="_blank">Owner Portal</a></li>
          {{-- <li class="drop-down"><a href="">Login</a>
            <ul>
              <li><a href="/login" target="_blank">System User</a></li>
              <li><a href="/properties" target="_blank">Tenant Portal</a></li>
              <li><a href="/login" target="_blank">Owner Portal</a></li>
             
            </ul>
          </li> --}}

        </ul>
      </nav><!-- .nav-menu -->

      {{-- <a href="#about" class="get-started-btn scrollto">Get Started</a> --}}

      <a href="/login"  target="_blank" class="get-started-btn scrollto">Login</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Simplifying Property Management</h1>
          <h2>Online resources and tools for landlords and property managers</h2>
          <div class="d-lg-flex">
            <a href="/register" class="btn-get-started scrollto">Get Started For Free</a>
            <a href="https://youtu.be/JLPH5mDWCxA" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> Watch Video <i class="icofont-play-alt-2"></i></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{ asset('/arsha/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-1.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-2.png') }}" class="img-fluid" alt="">
          </div>

          {{-- <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-3.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-4.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-5.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-6.png') }}" class="img-fluid" alt="">
          </div> --}}

        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="50">
            <img src="{{ asset('/arsha/assets/img/about.png') }}" class="img-fluid" alt="">
          </div>
          
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p class="text-justify">

              We are property managers with about a thousand listings, we were using traditional marketing and many steps of leasing procedures, 
              paper and pen to sign up tenant info sheets, contracts, billing statements and receipts. We monitor transactions through spreadsheets 
              and it takes a day to process a report. At one point, our operations are so wrapped up into administrative work that we are spending less 
              time strengthening our customer relations. We spend so much time looking for documents and less time on satisfying customer requests. 
              We realize that if we want to stay in this business and grow, we need to automate our processes so we can focus on the more important 
              aspects of the business like providing good customer service experience while maintaining efficient operations and that’s how thepropertymanager.online was born. 
            </p>
            {{-- <a href="#quick" class="btn-learn-more">Quick Start</a> --}}
           
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="quick" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>How it works?</strong></h3>
              <p>
               
              </p> 
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-toggle="collapse" class="collapse" href="#accordion-list-1"><span>01</span> Register your property <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                    <p>
                        as dorm, apartments, commercial spaces, residential units, or condominiums
                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-2" class="collapsed"><span>02</span> Add units, rooms, or beds <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                    <p>
                          set up monthly rent, deposit requirements, room, features, and etc.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-3" class="collapsed"><span>03</span> Add tenants <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                    <p>
                            Add tenant names, contact numbers, email, contract period, and etc.
                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-4" class="collapsed"><span>04</span> Manage your tenants <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-4" class="collapse" data-parent=".accordion-list">
                    <p>
                       manage concerns, requests, create job orders, assign jobs, and monitor up to completion.   
                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-5" class="collapsed"><span>05</span> Bill and collect rent and utilities <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-5" class="collapse" data-parent=".accordion-list">
                    <p>
                          bill rent, water, lights, and other charges then email to tenant or print for distribution.
                    </p>
                  </div>
                </li>
{{-- 
                <li>
                  <a href="#pricing" class="text-center text-primary get-started-btn scrollto"> See Pricing </a>
              
                </li> --}}
                <br>
               

                {{-- <li>
                  <a data-toggle="collapse" href="#accordion-list-3" class="collapsed"><span>03</span> Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                    <p>
                      Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                    </p>
                  </div>
                </li> --}}

              </ul>
              
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("{{ asset('/arsha/assets/img/quick.png') }}");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
      
    </section><!-- End Why Us Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
            <img src="{{ asset('/arsha/assets/img/skills.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
             <h3>Current Statistics</h3> 
            <p class="font-italic">
              {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua. --}}
            </p>

            <div class="skills-content">

              <div class="progress">
                <h4 class="skill">Properties <i class="val">{{ number_format($properties,0) }}</i></h4>
                {{-- <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
              </div>

              <div class="progress">
                <h4 class="skill">Buildings <i class="val">{{ number_format($buildings,0) }}</i></h4>
                {{-- <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
              </div>

              <div class="progress">
                <h4 class="skill">Rooms <i class="val">{{ number_format($rooms,0) }}</i></h4>
                {{-- <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
              </div>

              <div class="progress">
                <h4 class="skill">Active Tenants <i class="val">{{ number_format($tenants,0) }}</i></h4>
                {{-- <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
              </div>

            </div>

          </div>
        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container text-center" data-aos="fade-up">

        <div class="section-title">
          <h2>Features</h2>
          <p>We offer a full suite of property management tools to  rental property owners and landlords. Let us help you make your work simple so you can relax knowing your property is running smoothly.</p>
        </div>

        <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-building-house"></i></div>
              <h4><a href="">Room Management</a></h4>
              <p></p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-user-plus"></i></div>
              <h4><a href="">Tenant Management</a></h4>
              {{-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p> --}}
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-user"></i></div>
              <h4><a href="">Owner Management </a></h4>
              {{-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p> --}}
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-store-alt"></i></div>
              <h4><a href="">Marketing Services</a></h4>
              {{-- <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p> --}}
            </div>
          </div>

        </div>
        <br>

        <div class="row">
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-file"></i></div>
                <h4><a href="">Billing Rent and Utilities</a></h4>
                <p></p>
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-collection"></i></div>
                <h4><a href="">Collecting Rent and Utilities</a></h4>
                {{-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p> --}}
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-credit-card"></i></div>
                <h4><a href="">Online Payment Integration</a></h4>
                {{-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p> --}}
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-tachometer"></i></div>
                <h4><a href="">Revenue and Expense Monitoring</a></h4>
                {{-- <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p> --}}
              </div>
            </div>
  
          </div>

          <br>

          <div class="row">
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-user-voice"></i></div>
                <h4><a href="">Concern and Violation Reporting</a></h4>
                <p></p>
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-user-circle"></i></div>
                <h4><a href="">Portal for Owner</a></h4>
                {{-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p> --}}
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-user-circle"></i></div>
                <h4><a href="">Portal for Tenant</a></h4>
                {{-- <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p> --}}
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-help-circle"></i></div>
                <h4><a href="">Concierge Services</a></h4>
                {{-- <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p> --}}
              </div>
            </div>
  
          </div>

          <br>
          
          <div class="row">
             <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-folder-open"></i></div>
                <h4><a href="">Portfolio Management</a></h4>
                <p></p>
              </div>
            </div>
  
            {{-- <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-user-circle"></i></div>
                <h4><a href="">Portforlio Management</a></h4>
               <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p> 
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-user-circle"></i></div>
                <h4><a href="">Portal for Tenant</a></h4>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p> 
              </div>
            </div>
  
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
              <div class="icon-box">
                <div class="icon"><i class="bx bx-help-circle"></i></div>
                <h4><a href="">Concierge Services</a></h4>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p> -
              </div>
            </div> --}}
  
          </div>
  
  
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          {{-- <div class="col-lg-9 text-center text-lg-left">
            <h3>Call To Action</h3> 
             <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> 
          </div> --}}
          <div class="col-lg-12 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="/register">Register your property now!</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

    {{-- <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">App</li>
          <li data-filter=".filter-card">Card</li>
          <li data-filter=".filter-web">Web</li>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="{{ asset('/arsha/assets/img/portfolio/portfolio-1.jpg') }}" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>App</p>
              <a href="assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <a href="assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/portfolio-5.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <a href="assets/img/portfolio/portfolio-6.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-7.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <a href="assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section --> --}}
{{-- 
    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
              <div class="pic"><img src="assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
              <div class="pic"><img src="assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>CTO</span>
                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
              <div class="pic"><img src="assets/img/team/team-4.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                <div class="social">
                  <a href=""><i class="ri-twitter-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section --> --}}

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pricing</h2>
          <p></p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="box featured">
              <h3>Free</h3>
              <h4><sup>₱</sup>0<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> 10 rooms</li>
                <li><i class="bx bx-check"></i> Room management</li>
                <li><i class="bx bx-check"></i> Tenant management</li>
                <li><i class="bx bx-check"></i> Marketing services</li>
                <li><i class="bx bx-check"></i> Billing rents and utilities</li>
                <li><i class="bx bx-check"></i> Concern and violation tracker</li>
                <li class="na"><i class="bx bx-x"></i> <span>Job order</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Portal for owner</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Portal for tenant</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Online payment</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Concierge services</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Portforlio management</span></li>
              </ul>
              <a href="/register" class="buy-btn">Get Started for Free</a>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <h3>Medium</h3>
              <h4><sup>₱</sup>950<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> 20 rooms</li>
                <li><i class="bx bx-check"></i> Room management</li>
                <li><i class="bx bx-check"></i> Tenant management</li>
                <li><i class="bx bx-check"></i> Marketing services</li>
                <li><i class="bx bx-check"></i> Billing rent and utilities</li>
                <li><i class="bx bx-check"></i> Concern and violation tracker</li>
                <li><i class="bx bx-check"></i> Job order</li>
                <li class="na"><i class="bx bx-x"></i> <span>Portal for owner</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Portal for tenant</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Online payment</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Concierge services</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Portforlio management</span></li>
              </ul>
              <a href="/register" class="buy-btn">Get Started</a>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <h3>Large</h3>
              <h4><sup>₱</sup>1800<span>per month</span></h4>
              <ul>
                <li><i class="bx bx-check"></i> 50 rooms</li>
                <li><i class="bx bx-check"></i> Room management</li>
                <li><i class="bx bx-check"></i> Tenant management</li>
                <li><i class="bx bx-check"></i> Marketing services</li>
                <li><i class="bx bx-check"></i> Billing rent and utilities</li>
                <li><i class="bx bx-check"></i> Concern and violation tracker</li>
                <li><i class="bx bx-check"></i> Job order</li>
                <li><i class="bx bx-check"></i> <span>Portal for owner</span></li>
                <li><i class="bx bx-check"></i> <span>Portal for tenant</span></li>
                <li><i class="bx bx-check"></i> <span>Online payment</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Concierge services</span></li>
                <li class="na"><i class="bx bx-x"></i> <span>Portforlio management</span></li>
              </ul>
              </ul>
              <a href="/register" class="buy-btn">Get Started</a>
            </div>
          </div>

        </div>

        <br>

        
        <div class="row center-screen">

            <div class=" col-lg-6" data-aos="fade-up" data-aos-delay="400">
              <div class="box">
                <h3>Enterprise</h3>
                <h4><sup>₱</sup>N<span>per month</span></h4>
                <ul>
                  <li><i class="bx bx-check"></i> 100 rooms</li>
                  <li><i class="bx bx-check"></i> Room management</li>
                <li><i class="bx bx-check"></i> Tenant management</li>
                <li><i class="bx bx-check"></i> Marketing services</li>
                <li><i class="bx bx-check"></i> Billing rent and utilities</li>
                <li><i class="bx bx-check"></i> Concern and violation tracker</li>
                <li><i class="bx bx-check"></i> Job order</li>
                <li><i class="bx bx-check"></i> <span>Portal for owner</span></li>
                <li><i class="bx bx-check"></i> <span>Portal for tenant</span></li>
                <li><i class="bx bx-check"></i> <span>Online payment</span></li>
                <li><i class="bx bx-check"></i> <span>Concierge services</span></li>
                <li><i class="bx bx-check"></i> <span>Portforlio Management</span></li>
                </ul>
                <a href="#contact" class="buy-btn">Give us a message</a>
              </div>
              
            </div>
            
  

            
            {{-- <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="500">
              <div class="box">
                <h3>Corporate Plan</h3>
                <h4><sup>₱</sup>4800<span>per month</span></h4>
                <ul>
                  <li><i class="bx bx-check"></i> Room management</li>
                  <li><i class="bx bx-check"></i> Tenant management</li>
                  <li><i class="bx bx-check"></i> Marketing Available Rooms</li>
                  <li><i class="bx bx-check"></i> Billing Rents and Utilities</li>
                  <li><i class="bx bx-check"></i> Concern and Violation Tracker</li>
                  <li><i class="bx bx-check"></i> Job Order</li>
                  <li><i class="bx bx-check"></i> <span>Portal for Owner</span></li>
                  <li><i class="bx bx-check"></i> <span>Portal for Tenant</span></li>
                  <li><i class="bx bx-check"></i> <span>Online Payment</span></li>
                  <li><i class="bx bx-check"></i> <span>Concierge Services</span></li>
                </ul>
                <a href="/register" class="buy-btn">Get Started</a>
              </div>
            </div> --}}
  
  
          </div>

      </div>
    </section><!-- End Pricing Section -->

    {{-- <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
           <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> 
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section --> --}}
{{-- 
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p></p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>Baguio City, Philippines, 2600</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>thepropertymanager2020@gmail.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>09752826318</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d15309.397476437753!2d120.58530152846114!3d16.407073518766374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e6!4m3!3m2!1d16.4102144!2d120.58623999999999!4m3!3m2!1d16.4071875!2d120.60170889999999!5e0!3m2!1sen!2sph!4v1598517619889!5m2!1sen!2sph" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="{{ url('send/inquiry') }}" method="post" role="form" class="php-email-form">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section --> --}}

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="footer-top">
      <div class="container">
        <div id="contact" class="row">

          <div class="col-lg-4 col-md-6 footer-contact">
            <h3>The PMO Co.</h3>
            <p>
            {{--   Baguio City <br>
              Philippines, 2600<br>
            <br>
              <strong>Phone:</strong> 09752826318<br> --}}
              <strong>Email:</strong> customercare@thepropertymanager.online<br>
            </p>
          </div>

           <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Features</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/terms-of-service">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/privacy-policy">Privacy policy</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="/acceptable-use-policy">Acceptable Use Policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Features</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Room Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Billing & Collection</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Expense Tracker</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Online Payment</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Job Order</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Landlord/Tenant Portal</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Concierge Service</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Get in touch with us:</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="https://www.facebook.com/onlinepropertymanager"  target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              {{-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a> --}}
  
            </div>
          </div> 

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; 2020 Copyright <strong><span>The PMO Co</span></strong>. All Rights Reserved
      </div>
      
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/arsha/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/arsha/assets/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/arsha/assets/js/main.js') }}"></script>

</body>

</html>