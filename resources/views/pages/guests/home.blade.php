<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LifeLine EAP</title>

	<link rel="stylesheet" href="{{ asset('oneschool/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('oneschool/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('oneschool/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('oneschool/css/jquery.fancybox.min.css')  }}">

    <link rel="stylesheet" href="{{ asset('oneschool/css/bootstrap-datepicker.css')  }}">

    <link rel="stylesheet" href="{{ asset('oneschool/fonts/flaticon/font/flaticon.css')  }}">

    <link rel="stylesheet" href="{{ asset('oneschool/css/aos.css')  }}">

    <link rel="stylesheet" href="{{ asset('oneschool/css/style.css')  }}">

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="{{ route('home') }}">Lifelines EAP</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#about-section" class="nav-link">About Us</a></li>
                <li><a href="#services-section" class="nav-link">Benefits and Services</a></li>
                {{-- <li><a href="#teachers-section" class="nav-link">Teachers</a></li> --}}
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="intro-section single-cover" id="home-section">
      
      <div class="slide-1 " style="background-image: url('oneschool/images/img_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          	<div class="row align-items-center">
            <div class="col-12">
              <div class="row justify-content-center align-items-center text-center">
                <div class="col-lg-6">
                  <h1 data-aos="fade-up" data-aos-delay="0">BE FINE, WITH LIFELINE</h1>
                </div>

                
              </div>
            </div>
            
          	</div>
        </div>
      </div>
    </div>


    <div class="site-section" id="about-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">About Lifelines EAP</h2>
            <p>Lifelines EAP helps organizations and businesses empower their people and promote their mental health and holistic wellbeing.</p>
          </div>
        </div>
        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ asset('oneschool/images/undraw_youtube_tutorial.svg') }}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Reasons for having a Mental Health Policy in your work place</h2>
            <p class="mb-4">
            	Reports say that 1 in 5 Filipino adults suffer from a form of mental illness, In 2012, The World Health Organization (WHO) reported that an average of 7 Filipinos
            	died by suicide each day. These Statistics are certainly alarming. But it is not all bad news because last June 21 2018, President Duterte finally signed the Mental Health Law,
            	providing Filipinos with affordable and accessible mental health services. But what does this mean for companies and employers?
            	Chapter V, Sec 25 of the Mental Health Law states that: "Employees shall develop appropriate policies and programs on mental health in the workplace designed to (1) raise awareness on mental health issues; (2) correct the stigma and discrimination associated with mental health conditions; (3) identify and provide support for individuals at risk; and (4) facilitate access of individuals with mental health conditions to treatment and psychosocial support. "
            </p>

          </div>
        </div>

      </div>
    </div>

    <div class="site-section" id="services-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 mb-5 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Benefits and Services</h2>
            <p class="mb-5">We've created our own unique preventative measures designed to resolve and manage workplace conflicts, personal concerns and life challenges - most within out EAP services.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 align-self-start"  data-aos="fade-up" data-aos-delay="100">

            <div class="p-4 rounded bg-white why-choose-us-box">

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Flexible Employee Assistance Programs (EAP) to meet your specific needs</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Decreased behavioral healthcare insurance claims.</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Lower EAP costs</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Flexible number of face-to-face sessions aimed at resolving issues</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Robusts EAP portal offering valuable work/life content</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Broad selection of work/life services materials</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">High level of utilization ( double the national rate )</h3></div>
              </div>

              <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-settings"></span></span></div>
                <div><h3 class="m-0">Manager and HR support by having experts provide services for employees</h3></div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" id="contact-section">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-7">


            
            <h2 class="section-title mb-3">Contact Us</h2>
            <p class="mb-5">For any inquiries regarding the services, pricing, and how we would fit to your company, please contact us in this email hello@lifelineseap.com or you can message us</p>
          
            <form method="post" data-aos="fade">
              <div class="form-group row">
                <div class="col-md-6 mb-3 mb-lg-0">
                  <input type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Last name">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Subject">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" class="form-control" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" id="" cols="30" rows="10" placeholder="Write your message here."></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  
                  <input type="submit" class="btn btn-primary py-3 px-5 btn-block btn-pill" value="Send Message">
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    
     
    <footer class="footer-section bg-white">
      <div class="container">
        

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Lifeline EAP</a>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  
    
  </div> <!-- .site-wrap -->

  


  <script src="{{ asset('oneschool/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('oneschool/js/popper.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('oneschool/js/aos.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('oneschool/js/jquery.sticky.js') }}"></script>

  
  <script src="{{ asset('oneschool/js/main.js') }}"></script>
</body>
</html>