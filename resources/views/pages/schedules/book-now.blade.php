@extends('admin-layouts.master')

@section('title', 'Schedules')

@section('content')
	
	<div class="container-fluid">
		<div class="block-header">
            <h2>Book A Schedule</h2>
        </div>

        <div class="row clearfix">
        	
        	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        		<div class="row clearfix">
        			<div class="col-xs-12 col-sm-3">
        				<div class="card profile-card">
	                        <div class="profile-header">&nbsp;</div>
	                        <div class="profile-body">
	                            <div class="image-area">
	                                <img src="{{ asset('admin-bsb/images/no-user.png') }}" alt="AdminBSB - Profile Image" height="150" width="150"/>
	                            </div>
	                            <div class="content-area">
	                                <h3>Jose Manalo</h3>
	                                <p>Psychologists</p>
	                                {{-- <p>Administrator</p> --}}
	                            </div>
	                        </div>
	                        <div class="profile-footer">
	                            <button class="btn btn-primary btn-lg waves-effect btn-block">SELECT</button>
	                            <a href="#" class="btn btn-info btn-lg waves-effect btn-block">View Details</a>
	                        </div>
	                    </div>
        			</div>

        			<div class="col-xs-12 col-sm-3">
        				<div class="card profile-card">
	                        <div class="profile-header">&nbsp;</div>
	                        <div class="profile-body">
	                            <div class="image-area">
	                                <img src="{{ asset('admin-bsb/images/no-user.png') }}" alt="AdminBSB - Profile Image" height="150" width="150"/>
	                            </div>
	                            <div class="content-area">
	                                <h3>Eduardo Bularyo</h3>
	                                <p>Psychologists</p>
	                                {{-- <p>Administrator</p> --}}
	                            </div>
	                        </div>
	                        <div class="profile-footer">
	                            <button class="btn btn-primary btn-lg waves-effect btn-block">SELECT</button>
	                            <a href="#" class="btn btn-info btn-lg waves-effect btn-block">View Details</a>
	                        </div>
	                    </div>
        			</div>

        			<div class="col-xs-12 col-sm-3">
        				<div class="card profile-card">
	                        <div class="profile-header">&nbsp;</div>
	                        <div class="profile-body">
	                            <div class="image-area">
	                                <img src="{{ asset('admin-bsb/images/no-user.png') }}" alt="AdminBSB - Profile Image" height="150" width="150" />
	                            </div>
	                            <div class="content-area">
	                                <h3>Victor</h3>
	                                <p>Psychologists</p>
	                                {{-- <p>Administrator</p> --}}
	                            </div>
	                        </div>
	                        <div class="profile-footer">
	                            <button class="btn btn-primary btn-lg waves-effect btn-block">SELECT</button>
	                            <a href="#" class="btn btn-info btn-lg waves-effect btn-block">View Details</a>
	                        </div>
	                    </div>
        			</div>

        			<div class="col-xs-12 col-sm-3">
        				<div class="card profile-card">
	                        <div class="profile-header">&nbsp;</div>
	                        <div class="profile-body">
	                            <div class="image-area">
	                                <img src="{{ asset('admin-bsb/images/no-user.png') }}" alt="AdminBSB - Profile Image" height="150" width="150"/>
	                            </div>
	                            <div class="content-area">
	                                <h3>Bonito</h3>
	                                <p>Psychologists</p>
	                                {{-- <p>Administrator</p> --}}
	                            </div>
	                        </div>
	                        <div class="profile-footer">
	                            <button class="btn btn-primary btn-lg waves-effect btn-block">SELECT</button>
	                            <a href="#" class="btn btn-info btn-lg waves-effect btn-block">View Details</a>
	                        </div>
	                    </div>
        			</div>

        		</div>

        	</div>

        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        		<div class="card">
        			<div class="header">
        				<h2>Counseling Details</h2>
        			</div>
        			<div class="body">
        				<div class="row clearfix">
        					<div class="col-sm-12">
        						<select class="form-control show-tick">
                                    <option value="">-- Please select time --</option>
                                    <option value="7:00 am - 8:00 am">7:00 am - 8:00 am</option>
                                    <option value="8:30 am - 9:30 am">8:30 am - 9:30 am</option>
                                </select>
        					</div>

        					<div class="col-sm-12">
        						<select class="form-control show-tick">
                                    <option value="">-- Types of Counseling --</option>
                                    <option value="Individual">Individual</option>
                                    <option value="Group">Group</option>
                                </select>
        					</div>

        					<div class="col-sm-12">
        						<div class="form-group">
	                                <div class="form-line">
	                                    <textarea rows="5" class="form-control no-resize auto-growth" placeholder="Reason / Purpose"></textarea>
	                                </div>
	                            </div>
        					</div>

        					<div class="col-sm-12">
        						<div class="pull-right">
        							<button class="btn btn-primary btn-lg">Submit</button>
        							<a href="#" class="btn btn-danger btn-lg">Cancel</a>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>

        </div>

	</div>
@endsection