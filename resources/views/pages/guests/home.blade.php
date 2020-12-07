@extends('layouts.layout1.master')

@section('content')

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
                <li><a href="#services-section" class="nav-link">Services</a></li>
                <li><a href="#about-section" class="nav-link">About Us</a></li>
                <li><a href="#benefits-section" class="nav-link">Benefits</a></li>
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
      
    </header>

    <div class="intro-section" id="home-section">
      
      <div class="slide-1">
        <div class="container">
            <div class="row align-items-center">
              <div class="col-12">
                <div class="row align-items-center">
                  <div class="col-lg-6 mb-4">
                    <h1 data-aos="fade-up" data-aos-delay="0" style="font-size: 3rem;">BE FINE, WITH LIFELINE</h1>
                    <p class="mb-4 text-white"  data-aos="fade-up" data-aos-delay="200">Lifelines EAP helps organizations and businesses empower their people and promote their mental health and holistic wellbeing.</p>
                    <p data-aos="fade-up" data-aos-delay="300"><a href="#services-section" class="btn btn-white btn-outline-white py-3 px-5 btn-pill">Learn More</a></p>
                  </div>

                  
                </div>
              </div>
              
            </div>
        </div>
      </div>

      <div class="custom-shape-divider-bottom-1607324809">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
      </div>
    </div>

    

    <div class="site-section courses-title" id="services-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 data-aos="fade-up" data-aos-delay="0" class="section-title">Services</h2>
            <p class="mb-4 text-size-150">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi incidunt aliquid veritatis quos nobis. Quisquam voluptate quos natus repellat, corrupti magnam nihil saepe tempora hic fuga est reprehenderit repudiandae iusto.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="/oneschool/images/pic3.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4 text-center">
                <h3><a href="#">Flexible Counseling and Wellness Coaching</a></h3>
                <p>This will help your employees deal with work or personal issues that may impact their performance </p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="oneschool/images/pic2.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text p-4">
                <h3><a href="#">Group Counseling</a></h3>
                <p>This can serve to debrief a group struggling with a shared experience such as a traumatic event or loss.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="/oneschool/images/pic4.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Hotline Service</a></h3>
                <p>Our 24×7 phone hotline may be used by your employees to get immediate emotional support during times of distress or crisis.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="oneschool/images/pic5.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Learning Sessions</a></h3>
                <p>We provide fun and interactive educational sessions to increase your employees’ mental health awareness and to promote work and life management skills.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="oneschool/images/img_4.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Services to Management</a></h3>
                <p>We assist you in planning the launch and implementation of your EAP, and assist you in promoting the service on an ongoing basis.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="oneschool/images/img_5.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Managers and Supervisors Traning</a></h3>
                <p>We also give trainings to management and supervisors of the company to increase their efficiency in handling groups of people and ultimately improve and give them arsenal to deal with issues that usually come up in handling people.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="oneschool/images/img_6.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Data Analytics</a></h3>
                <p>We provide real time reports with data gathered from our utilization, types of transaction and common issues shared by the individuals in the company.</p>
              </div>
            </div>

            <div class="course bg-white h-100 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="oneschool/images/pic1.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <h3><a href="#">Crisis and Trauma Management Support</a></h3>
                <p>When your people experience crisis, such as natural disasters, personal tragedies, accidents, assaults, suicide threats, and other traumatic events as an individual or group, our counselors / wellness coaches can help them recover and get back to normal</p>
              </div>
            </div>

          </div>

         

        </div>
        <div class="row justify-content-center">
          <div class="col-7 text-center">
            <button class="customPrevBtn btn btn-primary m-1">Prev</button>
            <button class="customNextBtn btn btn-primary m-1">Next</button>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section" id="about-section">
      <div class="container-fluid">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Reasons For Having a Mental Health Policy In Your Work Place</h2>
            <p style="font-size: 1.5rem;">Reports say that 1 in 5 Filipino adults suffer from a form of mental illness. In 2012, the World Health Organization (WHO) reported that an average of 7 Filipinos died by suicide each day. These statistics are certainly alarming. But it is not all bad news because last Jun 21st 2018, President Duterte finally signed the Mental Health Law, providing Filipinos with affordable and accessible mental health services. But what does that mean for companies and employers?
            Chapter V, Sec. 25 of the Mental Health Law states that:
            “Employers shall develop appropriate policies and programs on mental health in the workplace designed to (1) raise awareness on mental health issues; (2) correct the stigma and discrimination associated with mental health conditions; (3) identify and provide support for individuals at risk; and (4) facilitate access of individuals with mental health conditions to treatment and psychosocial support.”
            The Mental Health Law does not only cover public mental health services, but it also covers the promotion of mental health and policies in the workplace.  It states that companies must have a mental health policy in place for their employees by February 26, 2020. If you don’t have a policy yet, don’t worry. Lifeline will help you set one up.
            We .can help provide you the services to comply with the national Mental Health Act.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" id="benefits-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 mb-5 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Benefits</h2>
            <p class="mb-5 text-size-150">We've created our own unique preventative measures designed to resolve and manage workplace conflicts, personal concerns and life challenges - most within out EAP services.</p>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/pic6.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4">Flexible Employee Assistance Programs (EAP) to meet your specific needs.</h4>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/benefits_2.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4">Decreased behavioral healthcare insurance claims.</h4>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/benefits_3.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4 text-center">Lower EAP costs.</h4>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/benefits_4.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4">Flexible number of face-to-face sessions aimed at resolving issues.</h4>
          </div>
        </div>


        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/benefits_5.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4 text-center">Robusts EAP portal offering valuable work/life content.</h4>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/benefits_6.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4">Broad selection of work/life services materials.</h4>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/img_1.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4 text-center">High level of utilization ( double the national rate ).</h4>
          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="oneschool/images/benefits_7.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h4 class="text-gray mb-4">Manager and HR support by having experts provide services for employees.</h4>
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

@stop

@section('custom_js')
  
@endsection