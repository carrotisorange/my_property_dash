<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>The Property Manager </title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <meta property="og:image" content="http://www.thepropertymanager.online/index/assets/img/logo.png"/>  
  <meta property="og:image" content="http://www.thepropertymanager.online/index/assets/img/favicon.ico"/> 
  <meta property="og:description" content="Simplifying Property Management - Online resource and tools for landlords and property managers."/> 
  <meta property="og:title" content="The Property Manager"/> 
  <meta property="og:url" content="http://www.thepropertymanager.online"/> 



    <!-- Favicons -->
    <link href="{{ asset('index/assets/img/d.ico') }}" rel="icon">
    <link href="{{ asset('index/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('index/assets/img/favicon.ico') }}" rel="icon">
    
  
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('index/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('index/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('index/assets/css/style.css') }}" rel="stylesheet">

  <!-- =========================================                 ==============
  * Template Name: Baker - v2.1.0
  * Template URL: https://bootstrapmade.com/baker-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
      {{-- <a href="index.html" class="logo mr-auto"><img src="{{ asset('index/assets/img/logo.png') }}" alt="" class="img-fluid"></a> --}}
      <h1 class="logo mr-auto"><a href="/"><img src="{{ asset('index/assets/img/logo.png') }}" alt="" class="img-fluid"> The Property Manager</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class=""><a class="" href="/">Home</a></li>
          <li class="drop-down"><a class="" href="">Resources</a>
            <ul>
              <li><a target="_blank" href="/resources#guidelines-during-covid-19">Guidelines During COVID-19</a></li>
              <li class="drop-down"><a href="#">Articles</a>
                <ul>
                  <li><a target="_blank" href="/resources/#being-customer-centric">Being Customer Centric</a></li>
                  <li><a target="_blank" href="/resources/#navigating-to-new-normal">Navigating to New Normal</a></li>
                  <li><a target="_blank" href="/resources/#is-property-management-right-for-me">Is Property Management right for me?</a></li>
                  <li><a target="_blank" href="/resources/#why-did-your-start-property-manager-online" href="#">Why did you start thepropertymanager.online?</a></li>
                  <!-- <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li> -->
                </ul>
              </li>
              <!-- <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li> -->
            </ul>
          </li>
          <li><a class="" href="#features">Features</a></li>    
          <li><a class="" href="#pricing">Pricing</a></li>
          <li><a class="" href="#contact">Contact</a></li>
          <li class="active"><a class="" target="_blank" href="/login">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container position-relative">
      <h1>Simplifying Property Management</h1>
      <h2>Online resource and tools for landlords and property managers. </h2>
      <a href="#pricing" class="btn-get-started scrollto">START YOUR FREE TRIAL NOW</a>
      {{-- <a target="_blank" href="/login" class="btn-get-started scrollto">LOGIN</a> --}}
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row counters">

          {{-- <div class="col-lg-2 col-6 text-center">
            <span data-toggle="counter-up">{{ number_format($clients,0) }}</span>
            <p>Clients</p>
          </div> --}}

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{ number_format($properties,0) }}</span>
            <p>Properties</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{ number_format($buildings,0) }}</span>
            <p>Buildings</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{ number_format($rooms,0) }}</span>
            <p>Rooms</p>
          </div>

           <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">{{ number_format($tenants,0) }}</span>
            <p>Active Tenants</p>
          </div> 

        </div>

      </div>
    </section><!-- End Counts Section -->

     <!-- ======= Clients Section ======= -->
     <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('index/assets/img/clients/client-1.png') }}" class="img" alt="">
          </div>

          <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('index/assets/img/clients/client-2.png') }}" class="img" alt="">
          </div>

          {{-- <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('index/assets/img/clients/client-3.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img ssrc="{{ asset('index/assets/img/clients/client-4.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('index/assets/img/clients/client-5.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('index/assets/img/clients/client-6.png') }}" class="img-fluid" alt="">
          </div> --}}

        </div>

      </div>
    </section><!-- End Clients Section -->

        <!-- ======= Services Section ======= -->
        <section id="" class="services">
          <div class="container">
    
            <div class="section-title">
              <h2>Quick Start Guide</h2>
              <p>Let us take care of your business process so you can focus on growing your business.</p>
            </div>
    
            <div class="row">
    
              <div class="col-lg-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="100">
                
                  <div class="icon-box iconbox-teal">
                    
                  <div class="icon">
                    <h2>1</h2>
                    
                  </div>
                  <h4><a href="">Register your property</a></h4>
                  <p> As a dorm, apartments, commercial spaces, residential units, or condominiums</p>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-6 d-flex mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box iconbox-teal ">
                  <div class="icon">
                    <h2>2</h2>
                  </div>
                  <h4><a href="">Add units, rooms, or beds</a></h4>
                  <p>Set up monthly rent, deposit requirements, room, features, and etc.</p>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-6 d-flex mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box iconbox-teal">
                  <div class="icon">
                   <h2>3</h2>
                  </div>
                  <h4><a href="">Add tenants</a></h4>
                  <p>Add tenant names, contact numbers, email, contract period, and other details. </p>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box iconbox-teal">
                  <div class="icon">
                    <h2>4</h2>
                  </div>
                  <h4><a href="">Manage your tenants</a></h4>
                 <p>Manager concerns, requests, create job orders, assign jobs, and monitor up to completion.</p>
                </div>
              </div>
    
              <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box iconbox-teal">
                  <div class="icon">
                   <h2>5</h2>
                  </div>
                  <h4><a href="">Bill & collect rent & utilities</a></h4>
                  <p>Bill rent, water, light, and other charges then email to tenant or print for distribution.</p>
                </div>
              </div>
    
            </div>
    
          </div>
        </section><!-- End Services Section -->

             <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="features" class="faq section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
          <p>We offer a full suite of property management tools to  rental property owners and landlords. Let us help you make your work simple so you can relax knowing your property is running smoothly.</p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Room Management </a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Billing & Collection <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>


            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Expense Tracker <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Online Payment <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Job Order <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Online Payment <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Landlord Portal <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Tenant Portal <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>

            <li data-aos="fade-up">
              <a data-toggle="collapse" class="collapse" href="#faq-list-1">Concierge <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse" data-parent=".faq-list">
                <p>
                 
                </p>
              </div>
            </li>
            
            
          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section --> 

    {{-- <!-- ======= Services Section ======= -->
    <section id="features" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
          <p>We offer a full suite of property management tools to  rental property owners and landlords. Let us help you make your work simple so you can relax knowing your property is running smoothly.</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex" data-aos="zoom-in" data-aos-delay="100">
            
              <div class="icon-box iconbox-teal">
              <div class="icon">
                <i class="bx bx-building-house"></i>
                
              </div>
              <h4><a href="">Room Management</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-orange ">
              <div class="icon">
                <i class="bx bx-file"></i>
              </div>
              <h4><a href="">Billing and Collection</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-pink">
              <div class="icon">
                <i class="bx bx-tachometer"></i>
              </div>
              <h4><a href="">Expense Tracker</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-yellow">
              <div class="icon">
                <i class="bx bx-credit-card"></i>
              </div>
              <h4><a href="">Online Payment</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-red">
              <div class="icon">
                <i class="bx bx-wrench"></i>
              </div>
              <h4><a href="">Job Order</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

           <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <i class="bx bx-user"></i>
              </div>
              <h4><a href="">Landlord Portal</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <i class="bx bx-user-circle"></i>
              </div>
              <h4><a href="">Tenant Portal</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <i class="bx bx-user-voice"></i>
              </div>
              <h4><a href="">Concierge</a></h4>
              <p hidden>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur. Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div> 

        </div>

      </div>
    </section><!-- End Services Section --> --}}

    <!-- ======= Cta Section ======= -->
   

     <!-- ======= Portfolio Section ======= -->

    <!-- ======= Team Section ======= -->
    {{-- <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Team</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="{{ asset('/index/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Pamela Tecson</h4>
                <span>CEO</span>
                <p>Pamela has experience with all types of property. From condos and apartments to vacation homes, she knows that your home is important to you. She's a jill-of-all-trades and can help you manage anything from maintenance and leasing to bookkeeping and legal compliance!

                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="{{ asset('/index/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>July Gotschall</h4>
                <span>Marketing Head</span>
                <p>
                  July has a passion for connecting with people. She loves accommodating people looking for a place to rent and knows all about what they need! Her top priority is making sure your property is rented out thru charteredrooms.com
                </p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="{{ asset('/index/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Landley Bernardo</h4>
                <span>CTO</span>
                <p>
                  Andy is our systems engineer.  This makes him the man to go to for all your property management system questions. From systems setup, adding tenants, billing, to move-out of tenants, Andy's calm, matter-of-fact attitude can handle all the work for you!
                </p>
              </div>
            </div>
          </div>

          {{-- <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <div class="member-img">
                <img src="{{ asset('/index/assets/img/team/team-4.jpg') }}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href=""><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
              </div>
            </div>
          </div> 

        </div>

      </div>
    </section><!-- End Team Section --> --}}

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing ">
      <div class="container">

        <div class="section-title">
          <h2>Pricing</h2>
          {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="box">
              <h3>Basic</h3>
              <h4><sup>₱</sup>450<span> / month</span></h4>
              <ul>
                {{-- <li>1 building </li> --}}
                <li>20 rooms</li>
                <li>1 user</li>
                {{-- <li>1 admin</li>
                <li>1 billing</li>
                <li>1 treasury</li> --}}
              </ul>
              <div class="btn-wrap">
                <a href="/register" class="btn-buy">TRY FOR FREE</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
            <div class="box featured">
              <h3>Medium</h3>
              <h4><sup>₱</sup>950<span> / month</span></h4>
              <ul>
                {{-- <li>2-3 buildings</li> --}}
                <li>50 rooms</li>
                <li>5 users</li>
                {{-- <li>1 admin</li>
                <li>1 billing</li>
                <li>1 treasury</li> --}}
              </ul>
              <div class="btn-wrap">
                <a href="/register" class="btn-buy">TRY FOR FREE</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <h3>Large</h3>
              <h4><sup>₱</sup>1800<span> / month</span></h4>
              <ul>
                {{-- <li>3-4 buildings</li> --}}
                <li>100 rooms</li>
                <li>10 users</li>
                {{-- <li>1 admin</li>
                <li>1 billing</li>
                <li>1 treasury</li> --}}
              </ul>
              <div class="btn-wrap">
                <a href="/register" class="btn-buy">TRY FOR FREE</a>
              </div>
            </div>
          </div>
        </div>
        
        <br>

        <div class="row">


          <div class="col-lg-6 col-md-6 mt-4 mt-lg-0">
            <div class="box">
          
              <h3>Enterprise</h3>
              <h4><sup>₱</sup>2400<span> / month</span></h4>
              <ul>
                {{-- <li>Unlimited buildings</li> --}}
                <li>200 rooms</li>
                <li>Unlimited users </li>
                {{-- <li>1 admin</li>
                <li>1 billing</li>
                <li>1 treasury</li> --}}
              </ul>
              <div class="btn-wrap">
                <a href="/register" class="btn-buy">TRY FOR FREE</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 mt-4 mt-lg-0">
            <div class="box">
              <span class="advanced">Advanced</span>
              <h3>Corporate</h3>
              <h4><sup>₱</sup>4800<span> / month</span></h4>
              <ul>
                {{-- <li>Unlimited buildings</li> --}}
                <li>500 rooms</li>
                <li>Unlimited users</li>
                {{-- <li>1 admin</li>
                <li>1 billing</li>
                <li>1 treasury</li> --}}
              </ul>
              <div class="btn-wrap">
                <a href="/register" class="btn-buy">TRY FOR FREE</a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" >
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
        </div>

        {{-- <div class="row">

          - <div class="col-lg-12">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                <p>Baguio City, PH, 2600</p> -
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>pamelatecson@thepropertymanager.online<br></p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                 <p>+1 5589 55488 55<br>+1 6678 254445 41</p> -
                </div>
              </div>
            </div>

          </div> --}}

         <div class="col-lg-12">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
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
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    {{-- <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-contact">
            <h3>The Property Manager</h3>
            <p>
               <br>
              Baguio City, 2600<br>
              Philippines <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

        <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div> 

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div> 

        </div>
      </div>
    </div> --}}

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>The PMO Co 2020</span></strong>. 
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/baker-free-onepage-bootstrap-theme/ -->
          <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        </div>
      </div>
      {{-- <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div> --}}
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('index/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/bootstrap/js/bootstrap.bundle.min.j') }}"></script>
  <script src="{{ asset('index/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('index/assets/vendor/venobox/venobox.min.js' )}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('index/assets/vendor/venobox/venobox.min.js') }}"></script>

</body>

</html>