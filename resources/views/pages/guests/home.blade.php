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
          <div class="site-logo mr-auto w-25"><a href="{{ route('guests.home') }}">Psychline EAP</a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#services-section" class="nav-link">Services</a></li>
                <li><a href="#about-section" class="nav-link">About Us</a></li>
                <li><a href="#benefits-section" class="nav-link">Benefits</a></li>
                <li><a href="#by-the-numbers" class="nav-link">By The Numbers</a></li>
              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="{{ url('/login') }}" class="nav-link">Sign In</a></li>
                <li><a href="{{ url('/register') }}" class="nav-link">Sign Up</a></li>
              </ul>
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
              <div class="col-sm-12">
                <div class="row align-items-center">
                  <div class="col-lg-6 mb-4">
                    <h1 data-aos="fade-up" data-aos-delay="0" style="font-size: 2.5rem;">BE FINE, WITH PSYCHLINE</h1>
                    <p class="mb-4 text-white"  data-aos="fade-up" data-aos-delay="200">Psychline EAP helps organizations and businesses empower their people and promote their mental health and holistic wellbeing.</p>
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
          <div class="col-md-7 col-md-6 col-sm-12 text-center" data-aos="fade-up" data-aos-delay="">
            <h1 data-aos="fade-up" data-aos-delay="0" class="section-title">Services</h1>
            <p class="mb-4 text-size-100">Psychline EAP is a tech-enabled mental health services provider company that provides an array of services to cater to our client's overall wellness and mental health</p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section courses-entry-wrap"  data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row justify-content-center">

          <div class="col-lg-4 col-sm-6 mb-3">
            <div class="card mb-3 h-100 shadow">
              <img src="/oneschool/images/mind.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Flexible Counseling and Wellness Coaching</a></h5>
                <p>This will help your employees deal with work or personal issues that may impact their performance.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3 ">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/pic2.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Group Counseling</a></h5>
                <p>This can serve to debrief a group struggling with a shared experience such as a traumatic event or loss.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/pic4.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Hotline Service</a></h5>
                <p>Our 24×7 phone hotline may be used by your employees to get immediate emotional support during times of distress or crisis.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3 ">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-02.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Learning Sessions</a></h5>
                <p>We provide fun and interactive educational sessions to increase your employees’ mental health awareness and to promote work and life management skills.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/pic5.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Services to Management</a></h5>
                <p>We assist you in planning the launch and implementation of your EAP, and assist you in promoting the service on an ongoing basis.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-01.jpg" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Managers and Supervisors Traning</a></h5>
                <p>We also give trainings to management and supervisors of the company to increase their efficiency in handling groups of people and ultimately improve and give them arsenal to deal with issues that usually come up in handling people.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3">
            <div class="card h-100 shadow">
              <img src="/oneschool/images/service-03.png" alt="image" class="mx-auto d-block card-img-top p-4" width="300" height="300">
              <div class="card-body text-center">
                <h5 class="text-center"><a href="#">Data Analytics</a></h5>
                <p>We provide real time reports with data gathered from our utilization, types of transaction and common issues shared by the individuals in the company.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6 mb-3">
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
        <div class="row justify-content-center">
          <div class="col-sm-12 col-md-6 col-lg-6 d-flex align-items-center">
            <img src="/oneschool/images/mind.png" alt="img" class="img-fluid">
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6">
            <h2 class="section-title">Reasons For Having a Mental Health Policy In Your Work Place.</h2>
            <p class="text-size-100">Reports say that 1 in 5 Filipino adults suffer from a form of mental illness. In 2012, the World Health Organization (WHO) reported that an average of 7 Filipinos died by suicide each day. These statistics are certainly alarming. But it is not all bad news because last Jun 21st 2018, President Duterte finally signed the Mental Health Law, providing Filipinos with affordable and accessible mental health services. But what does that mean for companies and employers?</p>

            <p>Chapter V, Sec. 25 of the Mental Health Law states that:</p>
            <p>
              “Employers shall develop appropriate policies and programs on mental health in the workplace designed to (1) raise awareness on mental health issues; (2) correct the stigma and discrimination associated with mental health conditions; (3) identify and provide support for individuals at risk; and (4) facilitate access of individuals with mental health conditions to treatment and psychosocial support.”
            </p>
            <p>
              The Mental Health Law does not only cover public mental health services, but it also covers the promotion of mental health and policies in the workplace.  It states that companies must have a mental health policy in place for their employees by February 26, 2020. If you don’t have a policy yet, don’t worry. Psychline EAP will help you set one up.
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

        <div class="row justify-content-center">
          <div class="col-sm-6 mb-3">
            <div class="card shadow h-100" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>
                    </span>
                  </div>
                  <div>
                    <h5>Flexible Employee Assistance Programs (EAP) to meet your specific needs.</h5>
                    <p>We provide a divers number of services that cater to solutions for small, medium and large size enterprises, organizations and businesses regarding their overall holistic and mental health.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow h-100" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-plus-square"></i>
                    </span>
                  </div>
                  <div>
                    <h5>Decreased in healthcare expenditures / sickleaves</h5>
                      <p>35% decrease in healthcare expenditures (less employees experiencing mental health concerns due to the preventive measures taken by Lifeline EAP, less chances of conditions worsening and leading to physical or mental illnesses)
                      33% less use of sick leave benefits (33% of sick leaves are usually taken not because someone is physically sick, but they are taken because someone is undergoing problems at work or with colleagues that leads to mental health issues, addressing these problems will address absenteeism in the company).
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow h-100" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-plus-square"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Lower EAP COST</h5>
                    <p>According to the Department of Labor, employers on average save P250 to P800 for every peso invested in an effective Employee Assistance Program.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow h-100" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-plus-square"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Retaining Top Talent</h5>
                    <p>an employee assistance program can have a major impact on how your employees behave towards one another. And in a survey conducted by Harris Interactive, 51% of respondents cited their co-workers as the reason for remaining with their existing employers.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 mb-3">
            <div class="card shadow h-100" data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="py-4 px-4">
                    <span style="color: mediumseagreen;">
                      <i class="fa fa-3x fa-users"></i>           
                    </span>
                  </div>
                  <div>
                    <h5>Manager and HR support by having experts provide services for employees</h5>
                    <p>A recent study by CareerBuilder.com shows that a whopping 58 percent of managers said they didn’t receive any management training. Digest that for a second. Most managers in the workforce were promoted because they were good at what they did, and not necessarily good at making the people around them better. This statistic obviously unveils a harsh reality. We have a bunch of leaders who aren’t trained on how to lead. We give services to the team leads, managers and supervisors of the company to give them the necessary skills and information to achieve efficiency and promote a good company wide culture</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- BY THE NUMBERS --}}
    <div class="site-section" id="by-the-numbers">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-12 mb-5 text-center"  data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">By The Numbers</h2>
            <ul class="text-justify">
              <li><p>900,000 persons commit suicide each year. Suicide is the 3rd leading cause of deathin the Philippines.</p></li>
              <li><p>1 in 6.8 people are experience mental health problems in the workplace (14.7%).</p></li>
              <li><p>Women in full-time employment are nearly twice as likely to have a common mental health problem as full-time employed men (19.8% vs 10.9%).2</p></li>
              <li><p>A 2019 survey by Mental Health America found that 66% of workers reported that workplace issues negatively affect their sleep. </p></li>
              <li><p>The same survey found that 50% of respondents engage in unhealthy behaviors to cope with workplace stress. </p></li>
              <li><p>55% of respondents said they were afraid to take a day off to tend to their mental health. </p></li>
              <li><p>People who reported that it was unsafe to discuss their workplace stress in their companies had poor outcomes for employee engagement and wellbeing, including</p>
                  <ul>
                    <li><p>Difficulty with sleep</p></li>
                    <li><p>Lower confidence in the workplace</p></li>
                    <li><p>Lower motivation</p></li>
                    <li><p>Lower presenteeism.</p></li>
                  </ul>
              </li>
              <li><p>The average age a first depressive episode occurs is in the mid-20s their prime working years, although the disorder strikes all age groups indiscriminately, from children to the elderly.</p></li>
            </ul>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-sm-12 col-md-6 mb-3">
            <div class="card h-100 shadow">
              <div class="card-body">
                <h5>The COVID-19 Pandemic has caused spike in anxiety and depression due to various stress factors:</h5>
                <ul class="text-justify">
                  <li><p>Fear of contracting the virues</p></li>
                  <li><p>Loss of lives and loved ones</p></li>
                  <li><p>Isolation</p></li>
                  <li><p>Changes in lifestyle and work</p></li>
                  <li><p>Financial Concerns and more...</p></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-6 mb-3">
            <div class="card h-100 shadow">
              <div class="card-body">
                <h5>Benefits of seeking professional help:</h5>
                <ul class="text-justify">
                  <li><p>Unbiased and Trust-worthy</p></li>
                  <li><p>Trained to provide calm and help you with your anxieties</p></li>
                  <li><p>Builds resilience</p></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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