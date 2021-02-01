@extends('guest-layouts.master')

@section('title', 'Careers')

@section('content')
	
	<div class="login-box">
		<div class="logo">
            <a href="javascript:void(0);">Psychologist Career </a>
            <small></small>
        </div>

        <div class="card">
        	<div class="body">
        		<div class="msg">Please Fill out this form</div>

        		<div class="form-group">
        			<div class="form-line">
        				<input type="text" name="fname" class="form-control" placeholder="Firstname">
        			</div>
        		</div>

                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="mname" class="form-control" placeholder="Middlename">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="lname" class="form-control" placeholder="Lastname">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input type="date" name="birthdate" class="form-control" placeholder="Birthdate">
                    </div>
                    <div class="help-info">Please enter your birthdate</div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="contact_number" class="form-control" placeholder="Contact Number">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control no-resize" rows="4" name="address" placeholder="Address"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-line">
                        <select class="form-control show-tick" name="license_type">
                            <option value="">-- Please select --</option>
                            <option value="10">License One</option>
                            <option value="20">License Two</option>
                            <option value="30">License Three</option>
                        </select>
                    </div>
                    <div class="help-info">Select the type of license you have</div>
                </div>
                <br>

        		<div class="row">
        			<div class="col-xs-6 pull-right">
        				<a href="#" class="btn btn-danger">Cancel</a>
        				<button class="btn btn-primary">Submit</button>
        			</div>
        		</div>

        	</div>
        </div>
	</div>

@endsection