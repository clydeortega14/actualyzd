@extends('layouts.layout1.master')

@section('content')
	

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
			
@stop