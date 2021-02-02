@extends('guest-layouts.master')

@section('title', 'Careers')

@section('content')
	
	<div class="login-box">
		<div class="logo">
            <a href="javascript:void(0);">Careers</a>
            <small></small>
        </div>

        <div class="card">
        	<div class="body">
        		<div class="msg">Please Fill out this form</div>

                @include('alerts.message')

                <form class="form-horizontal" action="{{ route('careers.store') }}" method="POST">

                    @csrf
                    
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="first-name">Firstname</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="firstname" id="first-name" class="form-control" value="{{ old('firstname') }}" placeholder="Enter your firstname">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="middle-name">Middlename</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="middlename" id="middle-name" class="form-control" value="{{ old('middlename') }}" placeholder="Enter your middlename">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="last-name">Lastname</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="lastname" id="last-name" class="form-control" value="{{ old('lastname') }}" placeholder="Enter your lastname">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email address">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="birthdate">Birthdate</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate') }}" placeholder="Enter your birthdate">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="contact-number">Contact Number</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="contact_number" id="contact-number" value="{{ old('contact_number') }}" class="form-control" placeholder="Enter your contact number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="home-address">Home Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control no-resize" rows="4" name="home_address" value="{{ old('home_address') }}" id="home-address" placeholder="Enter your home address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="home-address">Resume / CV</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="resume" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <img src="{{ asset('admin-bsb/images/empty-image.png') }}" alt="Resume" class="img-responsive img-circle" height="150" width="150" style="display: block; margin-left: auto; margin-right: auto;width: 50%;">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="pull-right">
                                <a href="#" class="btn btn-danger btn-lg waves-effect">Cancel</a>
                                <button class="btn btn-primary btn-lg waves-effect">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>

        	</div>
        </div>
	</div>

@endsection