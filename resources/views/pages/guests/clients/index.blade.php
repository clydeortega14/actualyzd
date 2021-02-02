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

                @include('alerts.message')

                <form class="form-horizontal" action="{{ route('guest.clients.store') }}" method="POST">

                    @csrf

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="company-name">Company Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">

                                <div class="form-line @error('name') error @enderror ">
                                    <input type="text" name="name" id="company-name" class="form-control @error('name') error @enderror " value="{{ old('name') }}" placeholder="Enter your company name">
                                </div>

                                @error('name')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="company-email">Company Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('email') error @enderror">
                                    <input type="text" name="email" id="company-email" class="form-control @error('email') error @enderror" value="{{ old('email') }}" placeholder="Enter your company email">
                                </div>
                                @error('email')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="contact-number">Contact Number</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('contact_number') error @enderror">
                                    <input type="text" name="contact_number" id="contact-number" class="form-control @error('contact_number') error @enderror" value="{{ old('contact_number') }}" placeholder="Enter your contact number">
                                </div>
                                @error('contact_number')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="no-of-employees">No. of employees</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('no_of_employees') error @enderror">
                                    <input type="number" name="no_of_employees" id="no-of-employees" class="form-control @error('no_of_employees') error @enderror" value="{{ old('no_of_employees') }}" placeholder="How many employees you have ? ">
                                </div>
                                @error('no_of_employees')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="company-address">Company Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('address') error @enderror">
                                    <textarea class="form-control no-resize  @error('address') error @enderror" rows="4" name="address" id="company-address" placeholder="Enter your company address">{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <label class="error">{{ $message }}</label>
                                @enderror
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