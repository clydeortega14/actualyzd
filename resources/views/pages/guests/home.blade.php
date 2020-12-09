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
            <h1 data-aos="fade-up" data-aos-delay="0" class="section-title">Services</h1>
            <p class="mb-4 text-size-100">Lifelines EAP is a tech-enabled mental health services provider company that provides an array of services to cater to our client's overall wellness and mental health</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="col-sm-4 mb-3">
            <div class="card mb-3 h-100 shadow">
              <img src="/oneschool/images/mind.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Flexible Counseling and Wellness Coaching</a></h5>
                <p>This will help your employees deal with work or personal issues that may impact their performance.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3 ">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/pic2.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Group Counseling</a></h5>
                <p>This can serve to debrief a group struggling with a shared experience such as a traumatic event or loss.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/pic4.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Hotline Service</a></h5>
                <p>Our 24×7 phone hotline may be used by your employees to get immediate emotional support during times of distress or crisis.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3 ">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-02.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Learning Sessions</a></h5>
                <p>We provide fun and interactive educational sessions to increase your employees’ mental health awareness and to promote work and life management skills.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/pic5.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Services to Management</a></h5>
                <p>We assist you in planning the launch and implementation of your EAP, and assist you in promoting the service on an ongoing basis.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-01.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Managers and Supervisors Traning</a></h5>
                <p>We also give trainings to management and supervisors of the company to increase their efficiency in handling groups of people and ultimately improve and give them arsenal to deal with issues that usually come up in handling people.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-03.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Data Analytics</a></h5>
                <p>We provide real time reports with data gathered from our utilization, types of transaction and common issues shared by the individuals in the company.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-04.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Crisis and Trauma Management Support</a></h5>
                <p>When your people experience crisis, such as natural disasters, personal tragedies, accidents, assaults, suicide threats, and other traumatic events as an individual or group, our counselors / wellness coaches can help them recover and get back to normal</p>
              </div>
            </div>
          </div>
      </div>
    </div>


    <div class="site-section" id="about-section">
      <div class="container">
        <div class="d-flex justify-content-around">
          <div class="d-flex align-items-center">
            <img src="/oneschool/images/mind.png" alt="img" class="mx-auto d-block p-4">
          </div>
          <div>
            <h2 class="section-title">Reasons For Having a Mental Health Policy In Your Work Place.</h2>
            <p class="text-size-100">Reports say that 1 in 5 Filipino adults suffer from a form of mental illness. In 2012, the World Health Organization (WHO) reported that an average of 7 Filipinos died by suicide each day. These statistics are certainly alarming. But it is not all bad news because last Jun 21st 2018, President Duterte finally signed the Mental Health Law, providing Filipinos with affordable and accessible mental health services. But what does that mean for companies and employers?</p>

            <p>Chapter V, Sec. 25 of the Mental Health Law states that:</p>
            <p>
              “Employers shall develop appropriate policies and programs on mental health in the workplace designed to (1) raise awareness on mental health issues; (2) correct the stigma and discrimination associated with mental health conditions; (3) identify and provide support for individuals at risk; and (4) facilitate access of individuals with mental health conditions to treatment and psychosocial support.”
            </p>
            <p>
              The Mental Health Law does not only cover public mental health services, but it also covers the promotion of mental health and policies in the workplace.  It states that companies must have a mental health policy in place for their employees by February 26, 2020. If you don’t have a policy yet, don’t worry. Lifelines EAP will help you set one up.
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
            <p class="mb-5 text-size-100">We've created our own unique preventative measures designed to resolve and manage workplace conflicts, personal concerns and life challenges - most within out EAP services.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>
                    </span>
                  </div>
                  <div>
                    <h5>Flexible Employee Assistance Programs (EAP) to meet your specific needs.</h5>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae voluptatem debitis, doloremque sed quia possimus fugiat explicabo sit, aut impedit error dignissimos unde quas blanditiis deserunt, tenetur. Dolorem, ipsam, saepe?</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-plus-square"></i>
                    </span>
                  </div>
                  <div>
                    <h5>Decreased behavioral healthcare insurance claims.</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Consequuntur hic quidem nostrum, aut fuga exercitationem illum soluta. Veritatis, consectetur, quis mollitia hic consequuntur soluta praesentium? Similique, id sed in non?</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-plus-square"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Lower EAP Costs</h5>
                    <p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Et a pariatur, consectetur deleniti eum distinctio necessitatibus dignissimos repellat eaque. Rem ex nesciunt ab modi rerum laboriosam quisquam temporibus error doloribus.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Flexible number of face-to-face sessions aimed at resolving issues</h5>
                    <p>Lorem ipsum dolor, sit amet consectetur, adipisicing elit. Animi minus maxime amet fuga porro eveniet, temporibus rerum nostrum dolorum labore asperiores vel nesciunt vitae ea ab neque sapiente ipsam esse.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Robusts EAP portal offering valuable work/life content</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi explicabo, quos iste officiis libero asperiores incidunt autem temporibus, assumenda quia. Nulla illum facilis facere eveniet quidem illo in praesentium! Totam.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Broad selection of work/life services materials</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque quasi sapiente tempora facilis totam, rerum iusto similique modi. Omnis officia, asperiores ut accusamus, illo cumque suscipit labore rerum iusto. Nihil.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>High level of utilization ( double the national rate ).</h5>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit aliquid obcaecati vel repellendus itaque minima harum alias, corrupti animi id debitis laudantium? Accusantium, eveniet? Commodi ex explicabo necessitatibus iusto voluptate.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Manager and HR support by having experts provide services for employees</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit mollitia, facilis temporibus aspernatur a quaerat sunt, placeat ipsa. Assumenda vero dolor voluptatum impedit. Reprehenderit blanditiis nemo enim officia fuga quod?</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- BY THE NUMBERS --}}
    
    {{-- END BY THE NUMBERS --}}

    
    
     
    <footer class="footer-section bg-black-200">
        <div class="container">
          <div class="d-flex justify-content-between">
            <div class="text-green-800">
              <h1>Follow us on</h1>
  {{--             <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <i class="icon-heart" aria-hidden="true"></i> LifelinesEAP. <br>
                All rights reserved
                
              </p> --}}
              <a href="#" class="btn btn-white btn-outline-white btn-pill btn-sm">    
                <i class="fa fa-2x fa-facebook"></i>
              </a>

              <a href="#" class="btn btn-white btn-outline-white btn-pill btn-sm">    
                <i class="fa fa-2x fa-youtube"></i>
              </a>
              <a href="#" class="btn btn-white btn-outline-white btn-pill btn-sm">    
                <i class="fa fa-2x fa-instagram"></i>
              </a>

              <a href="#" class="btn btn-white btn-outline-white btn-pill btn-sm">    
                <i class="fa fa-2x fa-twitter"></i>
              </a>
              
            </div>

            <div class="d-flex align-items-center">
              <a href="{{ route('contact.us') }}" class="btn btn-outline-white btn-white btn-sm">
                <i class="fa fa-envelope"></i>
                <span class="text-green-800">Message Us</span>
              </a>
            </div>
          </div>
        </div>
    </footer>

  
    
  </div> <!-- .site-wrap -->

@stop