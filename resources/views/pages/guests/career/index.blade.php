@extends('layouts.app')

@section('title', 'Careers')

@section('content')

    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3 class="mb-5">Careers</h3>

                @include('alerts.message')

                <form class="form-horizontal" action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="first-name">Firstname</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('firstname') error @enderror">
                                    <input type="text" name="firstname" id="first-name" class="form-control" value="{{ old('firstname') }}" placeholder="Enter your firstname">
                                </div>

                                @error('firstname')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="middle-name">Middlename</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('middlename') error @enderror">
                                    <input type="text" name="middlename" id="middle-name" class="form-control" value="{{ old('middlename') }}" placeholder="Enter your middlename">
                                </div>
                                @error('middlename')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="last-name">Lastname</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('lastname') error @enderror">
                                    <input type="text" name="lastname" id="last-name" class="form-control" value="{{ old('lastname') }}" placeholder="Enter your lastname">
                                </div>
                                @error('lastname')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('email') error @enderror">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email address">
                                </div>
                                @error('email')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="birthdate">Birthdate</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('birthdate') error @enderror">
                                    <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate') }}" placeholder="Enter your birthdate">
                                </div>

                                @error('birthdate')
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
                                    <input type="text" name="contact_number" id="contact-number" value="{{ old('contact_number') }}" class="form-control" placeholder="Enter your contact number">
                                </div>

                                @error('contact_number')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="address">Home Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line @error('address') error @enderror">
                                    <textarea class="form-control no-resize" rows="4" name="address" id="address" placeholder="Enter your home address">{{ old('address') }}</textarea>
                                </div>

                                @error('address')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="home-address">Resume / CV</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="form-line @error('resume') error @enderror">
                                    <input type="file" name="resume" class="form-control">
                                </div>

                                @error('resume')
                                    <label class="error">{{ $message }}</label>
                                @enderror
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