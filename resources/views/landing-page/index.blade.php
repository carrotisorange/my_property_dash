@extends('layouts.arsha.template')

@section('title', 'The Property Manager')

@section('nav-bar')
<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center">
      <h3 class="logo mr-auto"><img src="{{ asset('/arsha/assets/img/logo.png') }}" alt="" class=""><a href="/"></a></h3> 
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="/" class="logo mr-auto"></a> 
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#hero">Home</a></li>
          <li><a target="_blank" href="/blogs">Blogs</a></li>
          <li><a target="_blank" href="/listings">Listings</a></li>
          <li><a target="_blank" href="/pricing">Payment</a></li>
        </ul>
      </nav>
      <!-- .nav-menu -->
      <a href="/login"  target="_blank" class="get-started-btn scrollto">Login</a>
    </div>
</header>
@endsection
@section('front-screen')
<section id="hero" class="d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1>Simplifying Property Management</h1>
        <h2>Online resources and tools for landlords and property managers</h2>
        <div class="d-lg-flex">
          <a href="/register" class="btn-get-started scrollto">Get Started For Free</a>
          <a href="https://youtu.be/5wxvKBkhDqQ" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> Watch Demo <i class="icofont-play-alt-2"></i></a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="{{ asset('/arsha/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
      </div>
    </div>
  </div>

</section><!-- End Hero -->
@endsection

@section('content')

    <!-- ======= Cliens Section ======= -->
    <section id="clients" class="cliens section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-1.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{ asset('/arsha/assets/img/clients/client-2.png') }}" class="img-fluid" alt="">
          </div>
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
              <h3>How it works? </strong></h3>
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
  
          </div>

      </div>
    </section><!-- End Pricing Section -->

@endsection
@section('scripts')

@endsection



