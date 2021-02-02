@extends('guest-layouts.master')


@section('title', 'Client App Form')


@section('content')
	<div class="login-box">
		<div class="logo">
            <a href="javascript:void(0);">Client Application Form </a>
            <small></small>
        </div>

        <div class="card">
        	<div class="body">
        		<div class="msg">Please Fill out this form</div>

                <form class="form-horizontal">

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="company-name">Company Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="company_name" id="company-name" class="form-control" placeholder="Enter your company name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="company-email">Company Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="company_email" id="company-email" class="form-control" placeholder="Enter your company email">
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
                                    <input type="text" name="contact_number" id="contact-number" class="form-control" placeholder="Enter your contact number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="no-of-employees">No. of employees</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" name="number_of_employees" id="no-of-employees" class="form-control" placeholder="How many employees you have ? ">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="company-address">Company Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control no-resize" rows="4" name="company_address" id="company-address" placeholder="Enter your company address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pull-right">
                                <a href="#" class="btn btn-danger waves-effect btn-lg">Cancel</a>
                                <button class="btn btn-primary btn-lg waves-effect">Submit</button>
                            </div>
                        </div>
                    </div>

                </form>
        	</div>
        </div>
	</div>

@endsection